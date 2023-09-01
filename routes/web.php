<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::domain('c6d1-103-127-169-22.ngrok-free.app')->group(function() {
    Route::get('{any}', function () {
        return view('admin');
    })->where('any','.*');
});

Route::domain('localhost')->group(function() {
    Route::get('{any}', function () {
        return view('user');
    })->where('any','.*');
});