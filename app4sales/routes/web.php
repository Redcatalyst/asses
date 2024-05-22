<?php

use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('welcome');
});
Route::post('/', 'App\Http\Controllers\LoginController@authenticate');