<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('Admin.Login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Define credentials
        $credentials = $request->only('email', 'password');

        // Check if the user exists
        $user = Admin::where('email', $credentials['email'])->first();

        if ($user) {
            // Check if the entered password matches the hashed password
            if (Hash::check($request->password, $user->password)) {
                // Login the admin user with the 'admin' guard
                Auth::guard('admin')->login($user);

                // Redirect to admin dashboard
                return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully');
            } else {
                Log::info('Incorrect password for Admin', ['email' => $credentials['email']]);
                return redirect()->route('login')->with('error', 'Password is incorrect');
            }
        }

        // If the user is not found
        Log::info('Admin not found', ['email' => $credentials['email']]);
        return redirect()->route('login')->with('error', 'Login credentials are not valid');
    }

    public function dashboard()
    {
        return view('Admin.Dashboard');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
