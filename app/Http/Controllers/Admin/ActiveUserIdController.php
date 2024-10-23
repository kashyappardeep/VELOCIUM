<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;
use App\Models\User;
use App\Models\Config;
use App\Models\Level;
use App\Models\Reward;

class ActiveUserIdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $all_packages = Packages::get();
        // dd($all_packages);
        // $user = User::where('id', auth()->id())->first();
        // dd($all_packages);
        return view('Admin.admin_active_id.index', compact('all_packages'));
    }


    public function activation_user(Request $request)

    {
        DB::beginTransaction(); // Start transaction

        try {
            // Fetch the investment history
            $user_invest = Packages::where('id', $request->package_id)->first();

            $currentUser = User::where('referal_code', $request->user_id)->first();
            InvestmentHistory::create([
                'user_id' => $currentUser->id,
                'amount' => $user_invest->amount,
                'status' => 2,
                'type' => 2,
                'package_id' => $request->package_id,
            ]);
            $levels = Level::all();
            $rewards = Reward::all();
            $dirct_sponser = Config::first();
            $direct_referrer = User::where('referal_code', $currentUser->referal_by)
                ->where('status', 2)
                ->first();


            $direct = $user_invest->amount * $dirct_sponser->direct_sponser / 100;

            if ($direct_referrer) {


                $direct_referrer->direct_balance += $direct;
                $direct_referrer->save();
                TransactionHistory::create([
                    'to' => $direct_referrer->id,
                    'by' => $currentUser->id,
                    'amount' => $direct,
                    'type' => "5",
                ]);
            }

            // Loop through levels to calculate bonuses
            foreach ($levels as $level) {

                $referrer_count = User::where('referal_by', $currentUser->referal_by)
                    ->where('status', 2)
                    ->count();

                $referrer = User::where('referal_code', $currentUser->referal_by)
                    ->where('status', 2)
                    ->first();

                if ($referrer) {
                    // dd($referrer);
                    $referrer->team_business += $user_invest->amount;

                    $referrer->save();
                }
                // Log::info('Checking direct referrals', [
                //     'level_direct' => $level->direct,
                //     'referrer_count' => $referrer_count,
                // ]);

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


                            $referrer->level_balance += $bonusAmount;

                            $referrer->save();
                        }

                        // Calculate team business
                        $power_leg_business = User::where('referal_by', $referrer->referal_code)
                            ->where('status', 2)
                            ->pluck('team_business')
                            ->max();

                        $total_business = User::where('referal_by', $referrer->referal_code)
                            ->where('status', 2)
                            ->sum('team_business');
                        $other_team_business = $total_business - $power_leg_business;

                        // Create a transaction history record for rewards
                        foreach ($rewards as $reward) {
                            Log::info('Check rewards ', ['reward' => $reward->team_business]);
                            if ($power_leg_business >= $reward->team_business && $other_team_business >= $reward->team_business) {
                                $user_rewards = TransactionHistory::where('user_id', $referrer->id)
                                    ->where('reward_id', $reward->id)
                                    ->get();

                                $referrer->royalty_balance += $reward->reward;

                                $referrer->save();

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
                            'by' => $currentUser->id,
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function dummy_id(Request $request)
    {
        return view('Admin.admin_active_id.dummy_id');
    }
    public function active_dummy_id(Request $request)
    {
        try {
            // Check if the package exists
            $user_invest = Packages::where('id', $request->package_id)->first();
            if (!$user_invest) {
                return redirect()->back()->with('error', 'Invalid package selected.');
            }

            // Check if the user exists
            $currentUser = User::where('referal_code', $request->user_id)->first();
            if (!$currentUser) {
                return redirect()->back()->with('error', 'User with the provided referral code not found.');
            }

            $currentUser->status = 2;
            $currentUser->save();

            // Proceed with creating the InvestmentHistory
            InvestmentHistory::create([
                'user_id' => $currentUser->id,
                'amount' => $user_invest->amount,
                'status' => 2,
                'type' => 2,
                'package_id' => $request->package_id,
            ]);


            return redirect()->back()->with('success', 'Dummy User Id Activate successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Transaction failed: ', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred while processing the request.');
        }
    }
}
