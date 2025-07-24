<?php

namespace App\Http\Controllers\UserPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Otp;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;

class WalletAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Pages.profile.UploadDocument');
    }

    public function requestOtp(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['message' => 'User not authenticated.'], 401);
        }

        // Generate OTP code and set expiry time
        $otpCode = rand(100000, 999999); // Generate a random 6-digit OTP
        $expiresAt = Carbon::now()->addMinutes(5); // Set expiration time

        // Check and update or create OTP in the database
        $user_otp = Otp::where('user_id', $user->id)->first();
        if ($user_otp) {
            $user_otp->otp = $otpCode;
            $user_otp->expires_at = $expiresAt;
            $user_otp->save();
        } else {
            Otp::create([
                'user_id' => $user->id,
                'otp' => $otpCode,
                'expires_at' => $expiresAt,
            ]);
        }

        // Send OTP to user's email
        $to = $user->email;

        if (empty($to) || empty($otpCode)) {
            return response()->json(['message' => 'Failed to send email: Missing email or OTP.'], 500);
        }

        try {
            Log::info('Sending OTP Email', ['to' => $to, 'otp' => $otpCode]);
            Mail::to($to)->send(new OtpMail($otpCode)); // Pass the OTP code directly
            Log::info('OTP Email sent successfully.');
        } catch (\Exception $e) {
            Log::error('Email sending failed:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to send email: ' . $e->getMessage()], 500);
        }

        return response()->json(['message' => 'OTP sent to your email.']);
    }


   public function validateOtp(Request $request)
        {
            $user = auth()->user(); // Ensure the user is authenticated
            if (!$user) {
                return response()->json(['message' => 'User not authenticated.'], 401);
            }

            // Validate the OTP
            $otp = Otp::where('user_id', $user->id)
                ->where('otp', $request->otp)
                ->where('expires_at', '>', Carbon::now())
                ->first();

            if (!$otp) {
                return response()->json(['message' => 'Invalid or expired OTP.', 'success' => false], 400);
            }

            // Optional: Basic validation (you can make it stricter)
            $request->validate([
                'wallet_address' => 'required|string',
                'txtAccountName' => 'required|string',
                'txtAccountNumber' => 'required|string',
                'txtIFSC' => 'required|string',
            ]);

            // Update user details
            $user = User::findOrFail($user->id);
            $user->wallet_address = $request->wallet_address;
            $user->account_name = $request->txtAccountName;
            $user->account_number = $request->txtAccountNumber;
            $user->ifsc_code = $request->txtIFSC;
            $user->save();

            return response()->json(['message' => 'OTP validated and account details updated successfully.', 'success' => true]);
        }



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
