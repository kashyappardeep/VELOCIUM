<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;

use App\Models\User;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_details = User::where('id', auth()->id())->first();
        // dd($user_details);
        return view('Pages.transactions.WithdrawalRequest', compact('user_details'));
    }

    public function DepositHistory()
    {
        $invest_detail = InvestmentHistory::where('user_id', auth()->id())->get();
        // dd($invest_detail);
        return view('Pages.transactions.DepositHistory', compact('invest_detail'));
    }

    public function WithdrawalHistory()
    {
        $histroy = TransactionHistory::where('user_id', auth()->id())
            ->where('type', 1)->get();
        return view('Pages.transactions.WithdrawalHistory', compact('histroy'));
    }
    public function withdraw(Request $request)
    {
        $user = User::where('id', auth()->id())->first();
        $amount = $request->usdt_amount;
        if ($amount < 20) {
            // Redirect back with a success message
            return redirect()->back()->with('error', 'The minimum withdrawal amount is $20.');
        }
        if ($user->balance < $amount) {
            // Redirect back with an error message for insufficient balance
            return redirect()->back()->with('error', 'Insufficient balance for this withdrawal request.');
        }

        $TransactionHistory = TransactionHistory::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'type' => "1",
        ]);

        $user->balance -= $amount;
        $user->save();
        return redirect()->back()->with('success', 'Withdrawal request sent successfully!');
    }
    public function TransactionSummary()
    {
        return view('Pages.transactions.TransactionSummary');
    }

    public function addfund()
    {
        return view('Pages.transactions.AddFund');
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
