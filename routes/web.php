<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing-page');
})->middleware('preventAdminLanding');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // CRUD Lapangan
    Route::resource('lapangan', LapanganController::class);
    Route::get('lapangan', [LapanganController::class, 'index'])->name('admin.lapangan.index');
    Route::get('lapangan/create', [LapanganController::class, 'create'])->name('admin.lapangan.create');
    Route::post('lapangan', [LapanganController::class, 'store'])->name('admin.lapangan.store');
    Route::get('lapangan/{lapangan}', [LapanganController::class, 'show'])->name('admin.lapangan.show');
    Route::get('lapangan/{lapangan}/edit', [LapanganController::class, 'edit'])->name('admin.lapangan.edit');
    Route::put('lapangan/{lapangan}', [LapanganController::class, 'update'])->name('admin.lapangan.update');
    Route::delete('lapangan/{lapangan}', [LapanganController::class, 'destroy'])->name('admin.lapangan.destroy');

    // CRUD User
    Route::resource('user', UserController::class);
    Route::get('user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('user', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('user/{user}', [UserController::class, 'show'])->name('admin.user.show');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('user/{user}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    // Route pembayaran
    Route::get('pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::get('pembayaran/create', [PembayaranController::class, 'create'])->name('admin.pembayaran.create');
    Route::post('pembayaran', [PembayaranController::class, 'store'])->name('admin.pembayaran.store');
    Route::get('pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('admin.pembayaran.show');
    Route::get('pembayaran/{pembayaran}/edit', [PembayaranController::class, 'edit'])->name('admin.pembayaran.edit');
    Route::put('pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->name('admin.pembayaran.update');
    Route::delete('pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');
    Route::patch('pembayaran/{id}/status', [PembayaranController::class, 'updateStatus'])->name('admin.pembayaran.updateStatus');

    // Routes pesanan
    Route::get('pesanan', [\App\Http\Controllers\PesananController::class, 'index'])->name('admin.pesanan.index');
    Route::get('pesanan/create', [\App\Http\Controllers\PesananController::class, 'create'])->name('admin.pesanan.create');
    Route::post('pesanan', [\App\Http\Controllers\PesananController::class, 'store'])->name('admin.pesanan.store');
    Route::get('pesanan/{pesanan}', [\App\Http\Controllers\PesananController::class, 'show'])->name('admin.pesanan.show');
    Route::get('pesanan/{pesanan}/edit', [\App\Http\Controllers\PesananController::class, 'edit'])->name('admin.pesanan.edit');
    Route::put('pesanan/{pesanan}', [\App\Http\Controllers\PesananController::class, 'update'])->name('admin.pesanan.update');
    Route::delete('pesanan/{pesanan}', [\App\Http\Controllers\PesananController::class, 'destroy'])->name('admin.pesanan.destroy');
    Route::patch('pesanan/{id}/status', [App\Http\Controllers\PesananController::class, 'updateStatus'])->name('admin.pesanan.updateStatus');

    // Routes Slot Waktu
    Route::resource('slotwaktu', App\Http\Controllers\SlotWaktuController::class);
    Route::get('slotwaktu', [\App\Http\Controllers\SlotWaktuController::class, 'index'])->name('admin.slotwaktu.index');
    Route::get('slotwaktu/create', [\App\Http\Controllers\SlotWaktuController::class, 'create'])->name('admin.slotwaktu.create');
    Route::post('slotwaktu', [\App\Http\Controllers\SlotWaktuController::class, 'store'])->name('admin.slotwaktu.store');
    Route::get('slotwaktu/{slotwaktu}', [\App\Http\Controllers\SlotWaktuController::class, 'show'])->name('admin.slotwaktu.show');
    Route::get('slotwaktu/{slotwaktu}/edit', [\App\Http\Controllers\SlotWaktuController::class, 'edit'])->name('admin.slotwaktu.edit');
    Route::put('slotwaktu/{slotwaktu}', [\App\Http\Controllers\SlotWaktuController::class, 'update'])->name('admin.slotwaktu.update');
    Route::delete('slotwaktu/{slotwaktu}', [\App\Http\Controllers\SlotWaktuController::class, 'destroy'])->name('admin.slotwaktu.destroy');
});

require __DIR__.'/auth.php';