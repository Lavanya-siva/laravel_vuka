<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtpVerification;

class OtpController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'otp_code' => 'required|digits:6',
        ]);

        $otpRecord = OtpVerification::where('user_id', $request->user_id)
            ->where('otp_code', $request->otp_code)
            ->first();

        if (!$otpRecord) {
            return response()->json(['message' => 'Invalid OTP'], 422);
        }

        if ($otpRecord->expires_at < now()) {
            return response()->json(['message' => 'OTP expired'], 422);
        }

        $otpRecord->verified = true;
        $otpRecord->save();

        $user = $otpRecord->user;
        $user->registration_status = 'otp_verified';
        $user->save();

        return response()->json([
            'message' => 'OTP verified successfully'
        ]);
    }
}
