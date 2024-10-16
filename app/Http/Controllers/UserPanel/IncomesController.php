<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionHistory;

class IncomesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.Incomes.ReportROI');
    }
    public function DirectIncome()
    {
        $direct_income = TransactionHistory::with('user.investmentHistory')->where('to', auth()->id())
            ->where('type', 2)->get();
        // dd($direct_income);
        return view('Pages.Incomes.DirectIncome', compact('direct_income'));
    }
    public function ReportSponsorLevelIncome()
    {
        return view('Pages.Incomes.ReportSponsorLevelIncome');
    }
    public function ReportROILevelIncome()
    {
        return view('Pages.Incomes.ReportROILevelIncome');
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
