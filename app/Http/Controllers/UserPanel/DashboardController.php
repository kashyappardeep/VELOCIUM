<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InvestmentHistory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_data = User::where('id', auth()->id())->first();
        $InvestmentHistoryCount = InvestmentHistory::where('user_id', auth()->id())
            ->where('status', 2)
            ->count();
        $Active_Directs = User::where('referal_by', $user_data->referal_code)->where('status', 2)
            ->count();
        $referralLink = url('/register?referral=' . $user_data->referal_code);
        // dd($referralLink);
        return view('Pages.Dashboard', compact('user_data', 'InvestmentHistoryCount', 'Active_Directs', 'referralLink'));
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
