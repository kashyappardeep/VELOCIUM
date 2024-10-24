<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\Config;
use App\Models\Level;
use App\Models\Reward;


class InvestmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Invest_req = InvestmentHistory::with('user')->where('status', 1)->get();
        // dd($Invest_req);

        return view('Admin.investment.index', compact('Invest_req'));
    }

    public function active()
    {
        $Invest_req = InvestmentHistory::with('user')->where('status', 2)->get();
        // dd($Invest_req);

        return view('Admin.investment.active', compact('Invest_req'));
    }
    public function reject()
    {
        $Invest_req = InvestmentHistory::with('user')->where('status', 3)->get();
        // dd($Invest_req);

        return view('Admin.investment.reject', compact('Invest_req'));
    }

    public function reject_request($id, Request $request)
    {
        // Find the investment by ID
        $investment = InvestmentHistory::findOrFail($id);
        $user = User::where('id', $investment->user_id)->first();
        dd($investment);
        // Update the investment status to 'rejected'
        $user->activation_balance += $investment->amount;
        $investment->status = 3; // Adjust based on your status field
        $investment->save();
        $user->save();

        return redirect()->route('invest_req.index')->with('success', 'Investment rejected successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
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


    // Active user packege
    public function update(Request $request, string $id)
    {
        DB::beginTransaction(); // Start transaction

        try {
            // Fetch the investment history
            $user_invest = InvestmentHistory::findOrFail($id);

            // Fetch the user associated with the investment
            $currentUser = User::findOrFail($user_invest->user_id);
            $levels = Level::all();
            $rewards = Reward::all();
            $dirct_sponser = Config::first();

            // Find the direct referrer (sponsor) of the current user
            $direct_referrer = User::where('referal_code', $currentUser->referal_by)
                ->where('status', 2)
                ->first();

            // Calculate the direct sponsor bonus
            $direct_bonus = $user_invest->amount * $dirct_sponser->direct_sponser / 100;

            if ($direct_referrer) {
                // Add the direct sponsor bonus to the referrer's balance
                $direct_referrer->direct_balance += $direct_bonus;
                $direct_referrer->save();

                // Create transaction history for the direct sponsor bonus
                TransactionHistory::create([
                    'to' => $direct_referrer->id,
                    'by' => $currentUser->id,
                    'amount' => $direct_bonus,
                    'type' => "5",
                ]);
            }


            // Traverse up the referral chain for all levels
            $referrer = $currentUser;
            Log::info('Total levels fetched', ['count' => $levels->count()]);

            foreach ($levels as $level) {
                Log::info('Processing level', ['level' => $level]);
                // Find the referrer of the current user in the chain
                $referrer = User::where('referal_code', $referrer->referal_by)
                    ->where('status', 2)
                    ->first();

                // If there is no referrer at this level, break out of the loop
                if (!$referrer) {
                    break;
                }

                // Get the count of direct referrals for the current referrer

                $referrer = User::where('referal_code', $currentUser->referal_by)
                    ->where('status', 2)
                    ->first();

                if ($referrer) {
                    $referrer->team_business += $user_invest->amount;

                    $referrer->save();
                }

                // Calculate team business for rewards
                $power_leg_business = User::where('referal_by', $referrer->referal_code)
                    ->where('status', 2)
                    ->pluck('team_business')
                    ->max();

                $total_leg_business = User::where('referal_by', $referrer->referal_code)
                    ->where('status', 2)
                    ->pluck('team_business')
                    ->sum();

                $total_business = $referrer->team_business + $total_leg_business;

                $other_team_business = $total_business - $power_leg_business;

                // Process rewards if the team business qualifies
                foreach ($rewards as $reward) {
                    if ((int) $power_leg_business >= (int) $reward->team_business && (int) $other_team_business >= (int) $reward->team_business) {
                        // Check if the referrer has already received the reward
                        $reward_already_received = TransactionHistory::where('user_id', $referrer->id)
                            ->where('reward_id', $reward->id)
                            ->exists();

                        if (!$reward_already_received) {
                            // Add the reward to the referrer's royalty balance


                            // Record the reward in the transaction history
                            TransactionHistory::create([
                                'user_id' => $referrer->id,
                                'amount' => $reward->reward,
                                'reward_id' => $reward->id,
                                'type' => "3",
                            ]);
                        }
                    }
                }
            }
            $currentUser->status = 2;
            $user_invest->status = 2;

            $user_invest->save();
            $currentUser->save();

            // Commit the transaction if all operations succeed
            DB::commit();

            return redirect()->back()->with('success', 'Investment request accepted successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollback();
            Log::error('Transaction failed: ', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
