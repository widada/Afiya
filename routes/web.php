<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
// Route::get('/', function () {
//     return view('welcome');
// });
