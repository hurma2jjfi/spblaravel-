<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\ExcursionInfoController;

// Resource routes for excursions
Route::resource('excursions', ExcursionController::class);

// Authentication routes
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route for dashboard
Route::get('/user/dashboard', [ExcursionInfoController::class, 'index'])->name('dashboard');

// Home route
Route::get('/', function () {
    return view('welcome');
});
