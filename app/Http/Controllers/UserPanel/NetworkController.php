<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TransactionHistory;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', auth()->id())->first();
        // Fetch direct income with pagination
        $DirectTeam = User::with('investmentHistory')
            ->where('referal_by', $user->referal_code)
            ->paginate(10); // Change the number 10 to your desired number of items per page

        return view('Pages.network.DirectTeam', compact('DirectTeam'));
    }


    public function TeamList()
    {
        return view('Pages.network.TeamList');
    }
    public function LevelTree()
    {
        return view('Pages.network.LevelTree');
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
