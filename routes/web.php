<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\DashboardController;

// Resource routes
Route::resource('users', UserController::class);
Route::resource('payment', PembayaranController::class);
Route::resource('pesanan', PesananController::class);
Route::resource('lapangans', LapanganController::class);
