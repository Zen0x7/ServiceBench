<?php

use App\Http\Controllers\Api\Auth\VerifyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{param?}', function () {
    return view('index');
})->where('param', '[\/\w\.-]*');
