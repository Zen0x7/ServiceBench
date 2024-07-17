<?php

use App\Http\Controllers\Auth\VerifyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/verify/{token}', VerifyController::class)
    ->name('auth.verify');
