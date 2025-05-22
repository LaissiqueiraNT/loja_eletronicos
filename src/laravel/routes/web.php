<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('client', ClientController::class);
    Route::resource('employee', ClientController::class);
    Route::resource('product', ClientController::class);
    Route::resource('sale', ClientController::class);
    Route::resource('request', ClientController::class);
});
