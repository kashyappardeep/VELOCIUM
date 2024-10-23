<?php

namespace App\Http\Controllers\UserPanel;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Packages;
use App\Models\InvestmentHistory;
use App\Models\TransactionHistory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_data = User::where('id', auth()->id())->first();
        // dd($user_data);
        $InvestmentHistoryCount = InvestmentHistory::where('user_id', auth()->id())
            ->where('status', 2)
            ->count();
        $total_investment = InvestmentHistory::where('user_id', auth()->id())
            ->where('status', 2)
            ->sum('amount');
        // dd($total_investment);

        $Active_Directs = User::where('referal_by', $user_data->referal_code)->where('status', 2)
            ->count();


        $pending_reward = TransactionHistory::where('user_id', auth()->id())->where('type', 3)
            ->where('status', 0)
            ->sum('amount');





        $power_leg_business = User::where('referal_by', $user_data->referal_code)
            ->where('status', 2)
            ->pluck('team_business')
            ->max();
        // dd($power_leg_business);
        $user_reward = TransactionHistory::where('user_id', auth()->id())
            ->where('status', 0)
            ->where('type', 3)
            ->get();
        //
        $total_business = $user_data->team_business;
        // dd($total_business);
        $other_team_business = $total_business - $power_leg_business;

        $user_investments = InvestmentHistory::with('package')
            ->where('user_id', auth()->id())
            ->where('status', 2)
            ->get();
        $witdrowal = TransactionHistory::where('user_id', auth()->id())->where('type', 1)
            ->where('status', 1)
            ->sum('amount');
        // dd($witdrowal);
        $total_daily_roi = 0;
        $Balance_Earning = 0 - $witdrowal;
        foreach ($user_investments as $investment) {
            // Ensure amount and daily_ear_per are numeric
            $daily_roi = floatval($investment->package->daily_ear_per); // Force to float
            $amount = floatval($investment->amount); // Force to float


            $one_day_roi = $amount * $daily_roi / 100;
            $amount_3x_earning = $amount * 3;
            $Balance_Earning += $amount_3x_earning;
            // Add the daily ROI of this investment to the total
            $total_daily_roi += $one_day_roi;
        }

        $daily_max_limit = Packages::get(); // Get all packages

        $max_amt = 0;
        $max_ear_per = 0;
        foreach ($daily_max_limit as $package) {
            $max_amt += $package->amount; // Sum the package amounts
            $max_ear_per += $package->daily_ear_per; // Sum the daily earnings percentages
        }
        $max_day_roi = $max_amt * $max_ear_per / 100;
        // dd($total_daily_roi);
        $referralLink = url('/register?referral=' . $user_data->referal_code);
        // dd($referralLink);
        return view('Pages.Dashboard', compact(
            'user_data',
            'Balance_Earning',
            'witdrowal',
            'max_day_roi',
            'total_daily_roi',
            'total_investment',
            'pending_reward',
            'power_leg_business',
            'total_business',
            'other_team_business',
            'user_reward',
            'InvestmentHistoryCount',
            'Active_Directs',
            'referralLink'
        ));
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
