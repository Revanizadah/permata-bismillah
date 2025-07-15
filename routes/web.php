<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlotWaktuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardAdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
});

    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/api/check-availability', [PesananController::class, 'checkAvailability']);

    Route::resource('lapangan', LapanganController::class);
    Route::get('lapangan/create', [LapanganController::class, 'create'])->name('lapangan.create');
    Route::post('lapangan', [LapanganController::class, 'store'])->name('lapangan.store');

    Route::resource('user', UserController::class);
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');


    Route::resource('user', UserController::class);
    Route::resource('slotwaktu', SlotWaktuController::class);

    // Route untuk Pembayaran (Resource + Custom Route)
    Route::patch('pembayaran/{id}/status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
    Route::resource('pembayaran', PembayaranController::class);

    // Route untuk Pesanan (Resource + Custom Route)
    Route::patch('pesanan-offline/{id}/status', [PesananController::class, 'updateStatus'])->name('pesanan-offline.updateStatus');
    Route::resource('pesanan-offline', PesananController::class);
    Route::get('pesanan-offline/create', [PesananController::class, 'create'])->name('pesanan-offline.create');

    Route::resource('manage-pesanan', PesananController::class);


    
