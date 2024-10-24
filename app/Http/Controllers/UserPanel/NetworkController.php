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


    // public function TeamList()
    // {
    //     $user_data = User::where('id', auth()->id())->first();


    //     $users1 = User::where('referal_by', $user_data->referal_code)->get();
    //     $referal_code1 = $users1->pluck('referal_code');
    //     // $ids1 = $users1->pluck('id')->toArray();


    //     $users2 = User::wherein('referal_by', $referal_code1)->get();
    //     $referal_code2 = $users2->pluck('referal_code');

    //     $users3 = User::wherein('referal_by', $referal_code2)->get();
    //     $referal_code3 = $users3->pluck('referal_code');

    //     $users4 = User::wherein('referal_by', $referal_code3)->get();
    //     $referal_code4 = $users4->pluck('referal_code');

    //     $users5 = User::wherein('referal_by', $referal_code4)->get();
    //     $referal_code5 = $users5->pluck('referal_code');

    //     $users6 = User::wherein('referal_by', $referal_code5)->get();
    //     $referal_code6 = $users6->pluck('referal_code');

    //     $users7 = User::wherein('referal_by', $referal_code6)->get();
    //     $referal_code7 = $users7->pluck('referal_code');

    //     $users8 = User::wherein('referal_by', $referal_code7)->get();
    //     $referal_code8 = $users8->pluck('referal_code');

    //     $users9 = User::wherein('referal_by', $referal_code8)->get();
    //     $referal_code9 = $users9->pluck('referal_code');

    //     $users10 = User::wherein('referal_by', $referal_code9)->get();
    //     $referal_code10 = $users10->pluck('referal_code');

    //     $users11 = User::wherein('referal_by', $referal_code10)->get();
    //     $referal_code11 = $users11->pluck('referal_code');

    //     $users12 = User::wherein('referal_by', $referal_code11)->get();
    //     $referal_code12 = $users12->pluck('referal_code');

    //     $users13 = User::wherein('referal_by', $referal_code12)->get();
    //     $referal_code13 = $users13->pluck('referal_code');

    //     $users14 = User::wherein('referal_by', $referal_code13)->get();
    //     $referal_code14 = $users14->pluck('referal_code');

    //     $users15 = User::wherein('referal_by', $referal_code14)->get();
    //     $referal_code15 = $users15->pluck('referal_code');

    //     $users16 = User::wherein('referal_by', $referal_code15)->get();
    //     $referal_code16 = $users16->pluck('referal_code');

    //     $users17 = User::wherein('referal_by', $referal_code16)->get();
    //     $referal_code17 = $users17->pluck('referal_code');

    //     $users18 = User::wherein('referal_by', $referal_code17)->get();
    //     $referal_code18 = $users18->pluck('referal_code');

    //     $users19 = User::wherein('referal_by', $referal_code18)->get();
    //     $referal_code19 = $users19->pluck('referal_code');

    //     $users20 = User::wherein('referal_by', $referal_code19)->get();
    //     $referal_code20 = $users20->pluck('referal_code');

    //     return view('Pages.network.TeamList');
    // }

    public function TeamList(Request $request)
    {
        $user_data = User::where('id', auth()->id())->first();

        // Get the selected level from the request (default to 0 for 'All')
        $selectedLevel = $request->input('level', 0);

        // Initialize an array to store the users at each level
        $allUsers = collect();

        // Start with the current user's referral code
        $currentReferalCodes = collect([$user_data->referal_code]);

        // Loop for 20 levels deep
        for ($i = 1; $i <= 20; $i++) {
            $users = User::whereIn('referal_by', $currentReferalCodes)->get();

            if ($users->isEmpty()) {
                break; // Stop if no more users are found
            }

            // Add found users to the overall collection
            $allUsers = $allUsers->merge($users);

            // Prepare for the next level: get referral codes of the current level users
            $currentReferalCodes = $users->pluck('referal_code');

            // If a specific level is selected, only store and return that level's users
            if ($selectedLevel == $i) {
                return view('Pages.network.TeamList', [
                    'allUsers' => $users, // Only pass users at the selected level
                    'selectedLevel' => $selectedLevel // Pass the selected level to the view
                ]);
            }
        }

        // If 'All' is selected (level 0), pass all users
        return view('Pages.network.TeamList', [
            'allUsers' => $allUsers,
            'selectedLevel' => $selectedLevel // Pass the selected level to the view
        ]);
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
