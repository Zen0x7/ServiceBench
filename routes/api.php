<?php

use App\Http\Controllers\Api\Auth\AttemptController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\RevokeController;
use App\Http\Controllers\Api\Auth\VerifyController;
use App\Http\Controllers\Api\Users\IndexController;
use App\Http\Controllers\Api\Users\ReceiveController;
use App\Http\Controllers\Api\Users\SendController;
use App\Http\Controllers\Api\Users\ShowController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', IndexController::class)->middleware('auth:sanctum');
Route::get('/users/{user}', ShowController::class)->middleware('auth:sanctum');
Route::post('/users/{user}/send', SendController::class)->middleware('auth:sanctum');
Route::get('/users/{user}/receive', ReceiveController::class)->middleware('auth:sanctum');

Route::post('/auth/attempt', AttemptController::class)
    ->middleware([HandlePrecognitiveRequests::class]);

Route::post('/auth/register', RegisterController::class)
    ->middleware([HandlePrecognitiveRequests::class]);

Route::post('/auth/revoke', RevokeController::class)
    ->middleware('auth:sanctum');

Route::post('/auth/verify', VerifyController::class)
    ->name('auth.verify');
