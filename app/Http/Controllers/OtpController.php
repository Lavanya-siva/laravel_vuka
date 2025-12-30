<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

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

        // If OTP is invalid
        if (!$otpRecord) {
            // get latest OTP for this user
            $latestOtp = OtpVerification::where('user_id', $request->user_id)
                ->latest()
                ->first();
                
            if ($latestOtp) {
                $latestOtp->increment('attempts'); //increment otp
            }
            return response()->json(['message' => 'Invalid OTP'], 422);
        }
        if ($otpRecord->expires_at < now()) {
            return response()->json(['message' => 'OTP expired'], 422);
        }

        // Mark OTP as verified
        $otpRecord->verified = true;
        $otpRecord->attempts = 0; // reset attempts on success
        $otpRecord->save();

        // Update user registration status
        $otpRecord->user->registration_status = 'otp_verified';
        $otpRecord->user->save();

        return response()->json([
            'message' => 'OTP verified successfully'
        ]);
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }
        
        //already verified
        if ($user->registration_status === 'otp_verified') {
            return response()->json([
                'message' => 'OTP already verified'
            ], 400);
        }

        //generate new otp
        $otp = rand(100000, 999999);
        $otpRecord = OtpVerification::where('user_id', $request->user_id)
            ->first();

        //  save new otp in db
        $otpRecord->otp_code = $otp;
        $otpRecord->expires_at = now()->addMinutes(10);
        $otpRecord->save();

        // send otp
         Mail::send('emails.otp-verification', [
        'user' => $user,
        'otp' => $otp
        ], function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Your OTP Verification Code-Resend');
        });
        return response()->json([
            'message' => 'OTP resent successfully'
        ]);
    }
}
