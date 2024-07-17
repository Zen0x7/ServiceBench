<?php

use App\Http\Controllers\Api\Auth\AttemptController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\RevokeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/auth/attempt', AttemptController::class);
Route::post('/auth/register', RegisterController::class);
Route::post('/auth/revoke', RevokeController::class)
    ->middleware('auth:sanctum');
