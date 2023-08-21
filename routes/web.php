<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SiswaController;
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

Route::domain('admin.localhost')->group(function() {
    Route::get('/home', function() {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/college', function() {
        return view('admin.college');
    })->name('admin.college');

    Route::get('/', function() {
        return view('auth.loginView');
    })->name('auth.loginView');


    Route::get('/sign-up', function() {
        return view('auth.signupView');
    })->name('auth.signupView');
});

Route::domain('localhost')->group(function() {
    Route::get('{any}', function () {
        return view('vue-template');
    })->where('any','.*');
});