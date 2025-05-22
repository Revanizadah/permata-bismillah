<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     // Jika pengguna sudah login, arahkan ke dashboard
//     return Auth::check() ? view('dashboard') : view('welcome');
// });


// Halaman utama/dashboard hanya untuk pengguna yang sudah login
// Route::middleware(['auth'])->get('/dashboard', function () {
//     return view('dashboard');
// });

Route::resource('lapangan', LapanganController::class);

// CRUD User
Route::resource('users', UserController::class);

// Route pembayaran
Route::get('pembayaran', [\App\Http\Controllers\PembayaranController::class, 'index'])->name('pembayaran.index');
Route::get('pembayaran/create', [\App\Http\Controllers\PembayaranController::class, 'create'])->name('pembayaran.create');
Route::post('pembayaran', [\App\Http\Controllers\PembayaranController::class, 'store'])->name('pembayaran.store');
Route::get('pembayaran/{pembayaran}', [\App\Http\Controllers\PembayaranController::class, 'show'])->name('pembayaran.show');
Route::get('pembayaran/{pembayaran}/edit', [\App\Http\Controllers\PembayaranController::class, 'edit'])->name('pembayaran.edit');
Route::put('pembayaran/{pembayaran}', [\App\Http\Controllers\PembayaranController::class, 'update'])->name('pembayaran.update');
Route::delete('pembayaran/{pembayaran}', [\App\Http\Controllers\PembayaranController::class, 'destroy'])->name('pembayaran.destroy');

// Routes pesanan
Route::get('pesanan', [\App\Http\Controllers\PesananController::class, 'index'])->name('pesanan.index');
Route::get('pesanan/create', [\App\Http\Controllers\PesananController::class, 'create'])->name('pesanan.create');
Route::post('pesanan', [\App\Http\Controllers\PesananController::class, 'store'])->name('pesanan.store');
Route::get('pesanan/{pesanan}', [\App\Http\Controllers\PesananController::class, 'show'])->name('pesanan.show');
Route::get('pesanan/{pesanan}/edit', [\App\Http\Controllers\PesananController::class, 'edit'])->name('pesanan.edit');
Route::put('pesanan/{pesanan}', [\App\Http\Controllers\PesananController::class, 'update'])->name('pesanan.update');
Route::delete('pesanan/{pesanan}', [\App\Http\Controllers\PesananController::class, 'destroy'])->name('pesanan.destroy');

// Routes Slot Waktu
Route::resource('slotwaktu', App\Http\Controllers\SlotWaktuController::class);
// Route Slot Waktu manual
Route::get('slotwaktu', [\App\Http\Controllers\SlotWaktuController::class, 'index'])->name('slotwaktu.index');
Route::get('slotwaktu/create', [\App\Http\Controllers\SlotWaktuController::class, 'create'])->name('slotwaktu.create');
Route::post('slotwaktu', [\App\Http\Controllers\SlotWaktuController::class, 'store'])->name('slotwaktu.store');
Route::get('slotwaktu/{slotwaktu}', [\App\Http\Controllers\SlotWaktuController::class, 'show'])->name('slotwaktu.show');
Route::get('slotwaktu/{slotwaktu}/edit', [\App\Http\Controllers\SlotWaktuController::class, 'edit'])->name('slotwaktu.edit');
Route::put('slotwaktu/{slotwaktu}', [\App\Http\Controllers\SlotWaktuController::class, 'update'])->name('slotwaktu.update');
Route::delete('slotwaktu/{slotwaktu}', [\App\Http\Controllers\SlotWaktuController::class, 'destroy'])->name('slotwaktu.destroy');
