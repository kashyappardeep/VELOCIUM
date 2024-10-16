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
        $user = User::where('id', auth()->id())->first();

        $user_investments = InvestmentHistory::with('package')
            ->where('user_id', $user->id)
            ->where('status', 2)
            ->get();

        $balance = 0;
        $per_day_roi_rate = 0;

        foreach ($user_investments as $investment) {
            // Ensure amount and daily_ear_per are numeric
            $daily_roi = floatval($investment->package->daily_ear_per); // Force to float
            $amount = floatval($investment->amount); // Force to float
            $lastClaimDate = $investment->created_at;

            // Use Carbon directly for created_at comparison
            $differenceInSeconds = $lastClaimDate->diffInSeconds($currentDate);

            // Ensure valid calculation
            $one_day_roi = $amount * $daily_roi / 100;

            if ($one_day_roi > 0 && $differenceInSeconds > 0) {
                $investment_claim_amount = ($one_day_roi / 86400) * $differenceInSeconds; // 86400 seconds in a day
                $balance += $investment_claim_amount;
                $per_day_roi_rate += $one_day_roi;
            }
        }

        // Update the user's balance
        $user->balance = number_format($balance, 2); // Format claim amount with 2 decimals
        $user->save();
        return $user;
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
