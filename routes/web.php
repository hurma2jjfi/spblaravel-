<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\ExcursionInfoController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewReactionController;
use App\Http\Controllers\BookingController;

// Админка с проверкой в excursions чтоб не запутаться
Route::resource('excursions', ExcursionController::class);
Route::middleware('auth')->group(function () {
    Route::resource('excursions', ExcursionController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/excursions/{id}', [ExcursionController::class, 'show'])->name('excursions.show');
    Route::post('/excursions/{id}/apply', [ExcursionController::class, 'apply'])->name('excursions.apply');
    Route::get('/user/dashboard', [ExcursionInfoController::class, 'index'])->name('dashboard');
    Route::get('/user/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::delete('/applications/{id}/cancel', [ApplicationController::class, 'cancel'])->name('applications.cancel');
    Route::post('/applications/{id}/update-status', [ApplicationController::class, 'updateStatus'])
    ->name('applications.updateStatus');
    Route::delete('/applications/{id}', [ApplicationController::class, 'destroy']);
    Route::post('/excursions/{excursion}/react', [ExcursionController::class, 'react'])
    ->name('excursions.react')
    ->middleware('auth');


});


Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/user/dashboard/search', [ExcursionController::class, 'search'])->name('excursions.search');
Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');
Route::put('/user/update', [UserController::class, 'update'])->name('user.update');




Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/excursion-price/{id}', [ExcursionController::class, 'getPrice']);

Route::get('/', [ExcursionController::class, 'landing']);
