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

            // Get the current user making the investment
            $currentUser = User::where('referal_code', $request->user_id)->first();

            // Record the investment in the InvestmentHistory table
            InvestmentHistory::create([
                'user_id' => $currentUser->id,
                'amount' => $user_invest->amount,
                'status' => 2,
                'type' => 2,
                'package_id' => $request->package_id,
            ]);

            // Get levels and rewards
            $levels = Level::all();
            $rewards = Reward::all();
            if ($levels->isEmpty()) {
                Log::warning('No levels found.');
                return; // Exit if no levels
            }
            // Get direct sponsor configuration
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


                $referrer_direct_count = User::where('referal_by', $referrer->referal_code)
                    ->where('status', 2)
                    ->count();



                // Check if the referrer qualifies for this level
                if ($referrer_direct_count >= $level->direct) {

                    // Calculate the level bonus
                    $level_bonus = $user_invest->amount * $level->level_per / 100;

                    // Add the level bonus to the referrer's balance
                    $referrer->level_balance += $level_bonus;
                    $referrer->save();

                    // Record the transaction history for the level bonus
                    TransactionHistory::create([
                        'amount' => $level_bonus,
                        'level' => $level->level_name,
                        'type' => "2",
                        'to' => $referrer->id,
                        'by' => $currentUser->id,
                    ]);

                    // Calculate team business for rewards
                    $power_leg_business = User::where('referal_by', $referrer->referal_code)
                        ->where('status', 2)
                        ->max('team_business');

                    $total_business = User::where('referal_by', $referrer->referal_code)
                        ->where('status', 2)
                        ->sum('team_business');

                    $other_team_business = $total_business - $power_leg_business;

                    // Process rewards if the team business qualifies
                    foreach ($rewards as $reward) {
                        if ($power_leg_business >= $reward->team_business && $other_team_business >= $reward->team_business) {
                            // Check if the referrer has already received the reward
                            $reward_already_received = TransactionHistory::where('user_id', $referrer->id)
                                ->where('reward_id', $reward->id)
                                ->exists();

                            if (!$reward_already_received) {
                                // Add the reward to the referrer's royalty balance
                                $referrer->royalty_balance += $reward->reward;
                                $referrer->save();

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
            }

            // Update the user's status to active
            $currentUser->status = 2;
            $user_invest->save();
            $currentUser->save();

            // Commit the transaction if everything is successful
            DB::commit();

            return redirect()->back()->with('success', 'Investment request accepted successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
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
