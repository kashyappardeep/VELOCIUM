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


class InvestmentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Invest_req = InvestmentHistory::where('status', 1)->get();
        // dd($Invest_req);

        return view('Admin.investment.index', compact('Invest_req'));
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
            $user_invest = InvestmentHistory::where('id', $id)->first();
            $user = User::findOrFail($user_invest->user_id);
            $levels = Level::all();
            // dd($levels);
            $currentUser = $user;

            Log::info('Initial user data:', ['currentUser' => $currentUser->toArray()]);

            foreach ($levels as $level) {
                if ($currentUser && $currentUser->referal_by) {
                    $referrer = User::where('referal_code', $currentUser->referal_by)->first();
                    if (!$referrer) {
                        Log::warning('Referrer not found', ['referal_by' => $currentUser->referal_by]);
                        break;
                    }

                    $bonusAmount = $user_invest->amount * $level->level_per / 100;
                    Log::info('Bonus Amount Calculated', ['bonusAmount' => $bonusAmount]);

                    // Update the referrer's wallet
                    $referrer->balance += $bonusAmount;
                    $referrer->save();

                    // Create a transaction history record
                    $TransactionHistory = TransactionHistory::create([

                        'amount' => $bonusAmount,
                        'level' => $level->level_name,
                        'type' => "2",
                        'to' => $referrer->id,
                        'by' => $user->id,
                    ]);
                    // dd($investmentHistory);
                    Log::info('Transaction History Created', ['TransactionHistory' => $TransactionHistory->toArray()]);

                    // Move up to the next referrer (if any)
                    $currentUser = $referrer;
                } else {
                    Log::warning('Referrer not found or currentUser is invalid', ['currentUser' => $currentUser]);
                    break;
                }
            }

            // Update the status of the user and the investment
            $user->status = 2;
            $user_invest->status = 2;
            $user_invest->save();
            $user->save();

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
