<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::post('/staff/login', [\App\Http\Controllers\StaffAuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/staff', [StaffController::class, 'index']);
    Route::get('/staff/{id}', [StaffController::class, 'show']);
    Route::post('/staff', [StaffController::class, 'store']);
    Route::put('/staff/{id}', [StaffController::class, 'update']);
    Route::delete('/staff/{id}', [StaffController::class, 'destroy']);
    Route::post('/staff/me', [\App\Http\Controllers\StaffAuthController::class, 'me']);
    Route::post('/staff/logout', [\App\Http\Controllers\StaffAuthController::class, 'logout']);
});

    
Route::apiResource('customer', \App\Http\Controllers\CustomerController::class);
