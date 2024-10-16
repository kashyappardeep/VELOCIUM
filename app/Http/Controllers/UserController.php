<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InvestmentHistory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.Login');
    }
    public function showRegisterForm()
    {
        return view('auth.Register');
    }
    public function register(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'prefix' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'referal_by' => 'required|string|max:50|nullable',
        ], [
            'name.required' => 'The name field is required.',
            'email.required' => 'Please enter a valid email address.',
            'phone.required' => 'Phone number is required.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Check if referral code exists
        if (!empty($request->referal_by)) {
            $referalUser = User::where('referal_code', $request->referal_by)->first();

            if (is_null($referalUser)) {
                return redirect()->back()->withErrors(['referal_by' => 'Referral code is invalid.']);
            }
        }
        try {
            DB::beginTransaction();

            // Create the user
            $user = User::create([
                'prefix' => $validated['prefix'],
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => "0",
                'password' => Hash::make($request->password),
                'referal_code' => "REF" . random_int(100000, 999999),
                'referal_by' => $request->referal_by, // Save referral user ID if available
            ]);
            // dd($user);

            DB::commit();
            // Log in the user after registration (optional)
            auth()->login($user);

            return redirect()->route('dashboard')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            // Optionally handle the exception
            DB::rollBack();
            return response()->json(['register' => 'Register failed', 'message' => $e->getMessage()], 500);
        }
    }



    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        // Attempt to log in the user with the provided credentials
        if ($user) {
            Auth::login($user);
            // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed; redirect to the intended page or dashboard
            return redirect()->route('dashboard');
        }

        // Authentication failed; return back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        return redirect('/login'); // Redirect to home or login page
    }
}
