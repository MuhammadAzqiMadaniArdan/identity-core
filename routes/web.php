<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/login',[AuthController::class,'loginView'])->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::prefix('/auth')->name('auth.')->group(function () {
    Route::get('/google',[SocialAuthController::class,'redirectGoogle'])->name('google');
    Route::get('/google/callback',[SocialAuthController::class,'callbackGoogle'])->name('google.callback');
    Route::get('/github',[SocialAuthController::class,'redirectGithub'])->name('github');
    Route::get('/github/callback',[SocialAuthController::class,'callbackGithub'])->name('github.callback');

    Route::post('/request-otp',[OtpController::class,'request'])->name('otp.request');
    Route::post('/verify-otp',[OtpController::class,'verify'])->name('otp.verify');
})->middleware(''); // 10 req max dalam 10 menit