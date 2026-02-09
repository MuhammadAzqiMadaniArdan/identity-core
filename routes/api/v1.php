<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware(['auth:api','scopes:avera.read']);

Route::post('/oauth/token',[TokenController::class,'handle']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:api');
Route::apiResource('user',UserController::class)->middleware(['auth:api','scopes:avera.read']);