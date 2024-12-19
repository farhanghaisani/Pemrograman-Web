<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk mendapatkan data user yang terautentikasi
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware(Authenticate::using('sanctum'));

//users
Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);

//rumah
Route::apiResource('/rumahs', App\Http\Controllers\Api\RumahController::class);

//ratings
Route::apiResource('/ratings', App\Http\Controllers\Api\RatingController::class);

//reviews
Route::apiResource('/reviews', App\Http\Controllers\Api\ReviewController::class);
