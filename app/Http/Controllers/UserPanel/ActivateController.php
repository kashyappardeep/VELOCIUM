<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\InvestmentHistory;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Level;
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
        $user = User::where('id', auth()->id())->first();
        // dd($user);
        return view('Pages.activation.ActivateMyID', compact('all_packages', 'user'));
    }

    public function invest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'package_id' => 'required|exists:packages,id',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user = User::where('id', auth()->id())->first();

        // dd($user);

        try {
            $Packages_detals = Packages::where('id', $request->package_id)->first();

            if ($user->activation_balance < $Packages_detals->amount) {
                return redirect()->back()->with('error', 'Insufficient balance!');
            }

            $investmentHistory = InvestmentHistory::create([
                'user_id' => auth()->id(),
                'amount' => $Packages_detals->amount,
                'status' => 1,
                'type' => 1,
                'package_id' => $request->package_id,
            ]);
            // dd(auth()->id());

            $user->activation_balance -= $Packages_detals;
            $user->save();
            return redirect()->back()->with('success', 'Package activated successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction

            return response()->json(['success' => false, 'message' => 'Error occurred: ' . $e->getMessage()]);
        }
    }

    public function claimDaily()
    {
        $currentDate = Carbon::now();

        $users = User::whereHas('investmentHistory', function ($query) {
            $query->where('status', 2); // Only include users with active investments
        })->get();

        foreach ($users as $user) {
            $lastClaim = TransactionHistory::where('user_id', $user->id)
                ->where('type', 4)
                ->latest()
                ->first();

            // Determine last claim date
            if ($lastClaim === null) {
                $lastClaimDate = $user->created_at; // Use the user's created date if no claims
            } else {
                $lastClaimDate = $lastClaim->created_at;
            }

            // Calculate the number of hours since the last claim
            $hoursSinceLastClaim = $lastClaimDate->diffInHours($currentDate);
            if ($hoursSinceLastClaim >= 24) {
                $user_investments = InvestmentHistory::with('package')
                    ->where('user_id', $user->id)
                    ->where('status', 2)
                    ->get();

                $totalBalance = 0;

                // Calculate total ROI for the number of days since the last claim
                foreach ($user_investments as $investment) {
                    $daily_roi = floatval($investment->package->daily_ear_per); // ROI percentage
                    $amount = floatval($investment->amount); // Investment amount

                    // Calculate daily ROI for the number of days since the last claim
                    $one_day_roi = $amount * $daily_roi / 100;
                    $totalBalance += $one_day_roi * ($hoursSinceLastClaim / 24);
                }

                if ($totalBalance > 0) {
                    // Create a transaction record for the user
                    TransactionHistory::create([
                        'user_id' => $user->id,
                        'amount' => $totalBalance,
                        'type' => "4",
                        'claimed_at' => $currentDate, // Capture the claim time
                    ]);

                    // Update the user's balance
                    $user->staking_balance += $totalBalance; // Directly add the total balance
                    $user->save();
                }
            } else {
                echo "user id " . $user->id . "already credited with today roi income";
            }
        }
        echo "successfull executed";
    }

    public function level_income()
    {
        // Get today's date to prevent double payouts
        $today = now()->format('Y-m-d');

        // Get all users from the database
        $allUsers = User::all();

        // Define level income percentages or amounts for each level
        $levelstat = Level::get();

        // Iterate over each user in the system
        foreach ($allUsers as $user) {

            Log::info("User: {$user}");
            // Get the user's referrer
            $referrer = $user->referal_by;
            $currentLevel = 1;

            // Loop through up to 20 levels to distribute income
            while ($referrer && $currentLevel <= 20) {
                // Get the referrer's user data
                $referrerUser = User::where('referal_code', $referrer)
                    ->where('status', 2)->first();

                if ($referrerUser) {
                    // Check if the referrer meets the direct referral condition
                    $referrerUserCount = User::where('referal_by', $referrerUser->referal_code)
                        ->where('status', 2)->count();
                    Log::info("currentLevel: {$currentLevel}");
                    Log::info("referrerUserCount: {$referrerUserCount}");
                    Log::info("levelstat currentLevel]->direct: {$levelstat[$currentLevel]->direct}");


                    if ($referrerUserCount >= $levelstat[$currentLevel]->direct) {
                        Log::info("referrerUser: {$referrerUser}");

                        // If the referrer has not received income today
                        if (!$this->hasReceivedIncome($referrerUser->id, $user->id, $currentLevel, $today)) {

                            // Calculate income based on user's total investment and level
                            $incomeAmount = (($user->total_investment) * ($levelstat[$currentLevel]->level_per)) / 3000;

                            // Save the income log to prevent multiple payouts on the same day
                            $this->logIncome($referrerUser->id, $user->id, $incomeAmount, $currentLevel, $today);

                            // Optionally: Add this income to referrer's account (you can store it in a `wallet` or `balance` column)
                            $referrerUser->increment('level_balance', $incomeAmount);

                            // Move to the next level and update referrer
                            $referrer = $referrerUser->referal_by;
                            $currentLevel++;
                        } else {
                            // If the referrer already received income today, break the loop
                            Log::info("User {$referrerUser->id} already received income at level {$currentLevel}.");
                            break;
                        }
                    } else {
                        // If the direct condition is not fulfilled, log it and break the loop
                        Log::info("Direct condition not fulfilled for user: {$referrerUser->id}");
                        break;
                    }
                } else {
                    // If no referrer is found, break the loop
                    Log::info("No referrer found for referral code: {$referrer}");
                    break;
                }
            }
        }
    }

    /**
     * Check if the user already received income from the given user at the given level today.
     */
    private function hasReceivedIncome($referrerId, $userId, $level, $date)
    {
        return TransactionHistory::where('by', $userId)
            ->where('to', $referrerId)
            ->where('level', $level)
            ->where('cred_date', $date)
            ->where('type', 2)
            ->exists();
    }

    /**
     * Log the income payment in the database to prevent multiple payouts.
     */
    private function logIncome($referrerId, $userId, $amount, $level, $date)
    {


        TransactionHistory::create([
            'to' => $referrerId,
            'by' => $userId,
            'amount' => $amount,
            'level' => $level,
            'cred_date' => $date,
            'type' => 2

        ]);
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
