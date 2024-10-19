<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\InvestmentHistory;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\TransactionHistory;

class ActivateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_packages = Packages::get();
        // dd($all_packages);
        return view('Pages.activation.ActivateMyID', compact('all_packages'));
    }

    public function invest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try {
            $Packages_detals = Packages::where('id', $request->package_id)->first();
            // dd($Packages_detals);
            $investmentHistory = InvestmentHistory::create([
                'user_id' => auth()->id(),
                'amount' => $Packages_detals->amount,
                'status' => 1,
                'package_id' => $request->package_id,
            ]);
            // dd(auth()->id());
            return redirect()->back()->with('success', 'Package activated successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction

            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    public function claimDaily()
    {
        $currentDate = Carbon::now();

        // Get all users with investments
        $users = User::whereHas('investmentHistory', function ($query) {
            $query->where('status', 2); // Only include users with active investments
        })->get();

        foreach ($users as $user) {
            // Get the last claim date for the user
            $lastClaimDate = $user->claimHistories()->latest()->first();

            // Check if the user has never claimed or if the last claim was more than 24 hours ago
            if (!$lastClaimDate || $lastClaimDate->created_at->diffInHours($currentDate) >= 24) {
                $user_investments = InvestmentHistory::with('package')
                    ->where('user_id', $user->id)
                    ->where('status', 2)
                    ->get();

                $balance = 0;
                $per_day_roi_rate = 0;

                foreach ($user_investments as $investment) {
                    $daily_roi = floatval($investment->package->daily_ear_per); // Force to float
                    $amount = floatval($investment->amount); // Force to float

                    // Calculate ROI
                    $one_day_roi = $amount * $daily_roi / 100;
                    $balance += $one_day_roi;
                    $per_day_roi_rate += $one_day_roi;
                }

                // Create a transaction record for the user
                TransactionHistory::create([
                    'user_id' => $user->id,
                    'amount' => $balance,
                    'type' => "4",
                    'claimed_at' => $currentDate,
                ]);

                // Update the user's balance
                $user->balance += number_format($balance, 2); // Format claim amount with 2 decimals
                $user->save();
            }
        }
    }









    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
