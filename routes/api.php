<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

Route::post('/staff/login', [\App\Http\Controllers\StaffAuthController::class, 'login']);
Route::post('/customer/login', [\App\Http\Controllers\CustomerAuthController::class, 'login']);


Route::middleware('auth:staff')->group(function () {
    Route::get('/staff', [StaffController::class, 'index']);
    Route::get('/staff/{id}', [StaffController::class, 'show']);
    Route::post('/staff', [StaffController::class, 'store']);
    Route::put('/staff/{id}', [StaffController::class, 'update']);
    Route::delete('/staff/{id}', [StaffController::class, 'destroy']);
    Route::post('/staff/me', [\App\Http\Controllers\StaffAuthController::class, 'me']);
    Route::post('/staff/logout', [\App\Http\Controllers\StaffAuthController::class, 'logout']);
    Route::post('/category', [\App\Http\Controllers\StaffAuthController::class, 'store']);
    Route::put('/category/{category}', [\App\Http\Controllers\StaffAuthController::class, 'update']);
    Route::delete('/category/{category}', [\App\Http\Controllers\StaffAuthController::class, 'destroy']);
    Route::post('/book', [\App\Http\Controllers\StaffAuthController::class, 'store']);
    Route::put('/book/{book}', [\App\Http\Controllers\StaffAuthController::class, 'update']);
    Route::delete('/book/{book}', [\App\Http\Controllers\StaffAuthController::class, 'destroy']);
});


Route::middleware('auth:customer')->group(function () {
    Route::post('/customer/me', [\App\Http\Controllers\CustomerAuthController::class, 'me']);
    Route::post('/customer/logout', [\App\Http\Controllers\CustomerAuthController::class, 'logout']);
    Route::apiResource('customer', \App\Http\Controllers\CustomerController::class);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::get('/category/{category}', [\App\Http\Controllers\CategoryController::class, 'show']);
    Route::get('/book', [\App\Http\Controllers\BookController::class, 'index']);
    Route::get('/book/{book}', [\App\Http\Controllers\BookController::class, 'show']);
});

