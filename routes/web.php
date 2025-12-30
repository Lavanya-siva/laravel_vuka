<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\PersonalInfoController;

Route::prefix('user')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('create-account', [CreateAccountController::class, 'showCreateForm'])->name('user.showCreateForm');
    Route::post('create-account', [CreateAccountController::class, 'createAccount'])->name('user.create');
    Route::post('create-account/verify-otp', [OtpController::class, 'verifyOtp'])->name('user.verifyOtp');
    Route::get('personal-info', [PersonalInfoController::class, 'getPersonalInfo'])->name('user.personalInfo.get');
    Route::post('personal-info', [PersonalInfoController::class, 'savePersonalInfo'])->name('user.personalInfo.save');
});
