<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\DashboardController;

// Basic routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', function () {
    return view('payment.index');
});

Route::get('/pesanan', function () {
    return view('pesanan.index');
});

Route::get('/lapangan', function () {
    return view('lapangan.index');
});

Route::get('/reservasi', function () {
    return view('reservasi.index');
});

// Resource routes
Route::resource('users', UserController::class);
Route::resource('payment', PembayaranController::class);
Route::resource('pesanan', PesananController::class);
Route::resource('lapangan', LapanganController::class);
