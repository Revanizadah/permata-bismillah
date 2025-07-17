<?php


use App\Http\Controllers\LapanganController;
use App\Http\Controllers\PembayaranController;;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlotWaktuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PesananOfflineController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\LaporanAdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Mail\TestMail;

Route::get('/dashboard', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'verified']) // Lindungi dengan auth & verifikasi
    ->name('user.dashboard');

Route::get('/', function () {
    return view('landing-page');
});

Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/resend', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

Route::get('/api/check-availability', [PesananOfflineController::class, 'checkAvailability']);


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::get('/laporan/pendapatan', [LaporanAdminController::class, 'pendapatan'])->name('laporan.pendapatan');
    Route::resource('pesanan-offline', PesananOfflineController::class);
    Route::resource('lapangan', LapanganController::class);
    Route::resource('user', UserController::class);
    Route::resource('slotwaktu', SlotWaktuController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::resource('pesanan', PesananController::class);
    Route::resource('manage-pesanan', PesananController::class);
    Route::patch('pembayaran/{pembayaran}/status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
    Route::patch('pesanan/{pesanan}/status', [PesananController::class, 'updateStatus'])->name('pesanan.updateStatus');

});

Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');


 
