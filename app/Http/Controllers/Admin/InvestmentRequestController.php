<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\User;
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
    // public function reject($id)
    // {
    //     try {
    //         // Find the investment request by ID
    //         $investment = InvestmentHistory::with('user')->findOrFail($id);
    //         dd($investment);
    //         if ($investment->status == 3) {
    //             return redirect()->back()->with('warning', 'This investment request has already been rejected.');
    //         }

    //         $investment->status = 3; // Assuming 3 is the 'rejected' status
    //         $investment->save();

    //         return redirect()->back()->with('success', 'Investment request rejected successfully!');
    //     } catch (\Exception $e) {
    //         // Log the error if something goes wrong
    //         Log::error('Error rejecting investment request', ['error' => $e->getMessage()]);

    //         // Redirect back with error message
    //         return redirect()->back()->with('error', 'An error occurred while rejecting the investment request.');
    //     }
    // }




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
            $user_invest = InvestmentHistory::where('id', $id)->first();

            // Check if investment history exists
            if (!$user_invest) {
                Log::error('Investment history not found', ['id' => $id]);
                return redirect()->back()->with('error', 'Investment history not found.');
            }

            // Fetch the user associated with the investment
            $currentUser = User::findOrFail($user_invest->user_id);
            $levels = Level::all();
            $rewards = Reward::all();
            Log::info('Initial user data:', ['currentUser' => $currentUser->toArray()]);

            // Loop through levels to calculate bonuses

            foreach ($levels as $level) {
                $referrer_count = User::where('referal_code', $currentUser->referal_by)
                    ->where('status', 2)
                    ->count();
                Log::info('Checking direct referrals', [
                    'level_direct' => $level->direct,
                    'referrer_count' => $referrer_count,
                ]);
                if ($level->direct <= $referrer_count) {


                    if ($currentUser && $currentUser->referal_by) {
                        // Find the referrer

                        $referrer = User::where('referal_code', $currentUser->referal_by)
                            ->where('status', 2)
                            ->first();



                        // Check if the referrer exists
                        if (!$referrer) {
                            Log::warning('Referrer not found', ['referal_by' => $currentUser->referal_by]);
                            break; // Exit the loop if referrer is not found
                        }

                        // Calculate the bonus amount
                        $bonusAmount = $user_invest->amount * $level->level_per / 100;
                        Log::info('Bonus Amount Calculated', ['bonusAmount' => $bonusAmount]);

                        // Update the referrer's wallet if their status is active
                        if ($referrer->status == 2) {
                            $referrer->balance += $bonusAmount;
                            $referrer->team_business += $user_invest->amount;
                            $referrer->save();
                        }

                        $power_leg_business = User::where('referal_by', $referrer->referal_code)
                            ->where('status', 2)
                            ->pluck('team_business')
                            ->max();

                        // Calculate total business and other team business
                        $total_business = User::where('referal_by', $referrer->referal_code)
                            ->where('status', 2)
                            ->sum('team_business');
                        $other_team_business = $total_business - $power_leg_business;


                        // Create a transaction history record
                        foreach ($rewards as $reward) {
                            // Get the max team business safely
                            Log::info('Check rewards ', ['reward' => $reward->team_business]);
                            // Check if the reward criteria are met
                            if ($power_leg_business >= $reward->team_business && $other_team_business >= $reward->team_business) {
                                $user_rewards = TransactionHistory::where('user_id', $referrer->id)
                                    ->where('reward_id', $reward->id)
                                    ->get();

                                // Uncomment for debugging



                                if ($user_rewards->isEmpty()) {
                                    TransactionHistory::create([
                                        'user_id' => $referrer->id,
                                        'amount' => $reward->reward,
                                        'reward_id' => $reward->id,
                                        'type' => "3",
                                    ]);
                                }
                            }
                        }

                        // Create the transaction history record
                        TransactionHistory::create([
                            'amount' => $bonusAmount,
                            'level' => $level->level_name,
                            'type' => "2",
                            'to' => $referrer->id,
                            'by' => $currentUser->id, // Make sure this is the correct user
                        ]);

                        Log::info('Transaction History Created', ['referrer_id' => $referrer->id, 'bonusAmount' => $bonusAmount]);

                        // Move up to the next referrer (if any)
                        $currentUser = $referrer;
                    }
                } else {
                    Log::warning('Referrer not found or currentUser is invalid', ['currentUser' => $currentUser]);
                    break;
                }
            }

            // Update the status of the user and the investment
            $currentUser->status = 2;
            $user_invest->status = 2;

            $user_invest->save();
            $currentUser->save();

            // Commit the transaction if all the above operations succeed
            DB::commit();

            return redirect()->back()->with('success', 'Investment request accepted successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollback();

            // Log the error message
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
