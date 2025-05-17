<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Jika pengguna sudah login, arahkan ke dashboard
    return Auth::check() ? view('dashboard') : view('welcome');
});


// Halaman utama/dashboard hanya untuk pengguna yang sudah login
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
});

// Rute untuk lapangan
Route::resource('lapangan', LapanganController::class);

// Menggunakan middleware auth untuk memastikan hanya pengguna yang login yang bisa mengakses order dan payment
