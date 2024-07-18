<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/{param?}', function () {
    return view('index');
})->where('param', '[\/\w\.-]*');
