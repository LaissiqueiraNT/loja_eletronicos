<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;


Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('client', ClientController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('product', ProductController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('request', RequestController::class);
    Route::resource('supplier', SupplierController::class); 
});
 Route::post('/employee/check-email', [EmployeeController::class, 'checkEmail'])->name('employee.checkEmail');