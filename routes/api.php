<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PersonalInfoController;


Route::prefix('user')->group(function () {
    Route::post('create-account', [CreateAccountController::class, 'createAccount']);
    Route::post('login', [AuthController::class, 'login']); 
    
});

Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::post('verify-otp', [OtpController::class, 'verifyOtp']);
    Route::post('resend-otp', [OtpController::class, 'resendOtp']);
});

Route::prefix('user')->middleware(['auth:sanctum','sanctum.expiry', 'otp.verified'])->group(function () {
    Route::post('personal-info', [PersonalInfoController::class, 'savePersonalInfo']);
});