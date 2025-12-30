<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\OtpVerification;

class CreateAccountController extends Controller
{
    public function showCreateForm()
    {
        return view('auth.create-account');
    }

    public function createAccount(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|string',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'surname' => $request->surname,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'password' => Hash::make($request->password),
            'terms_cond' => true,
        ]);

        $otp = rand(100000, 999999);

        OtpVerification::create([
            'user_id' => $user->id,
            'otp_code' => $otp,
            'sent_at' => now(),
            'expires_at' => now()->addMinutes(5),
        ]);

        return response()->json([
            'message' => 'OTP sent',
            'user_id' => $user->id,
            'otp_code' => $otp
        ]);
    }
}
