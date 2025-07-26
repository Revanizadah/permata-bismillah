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
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\PesananOnlineController;
use App\Http\Controllers\PembayaranUserController;
use App\Http\Controllers\RiwayatPesananuserController;
use App\Http\Controllers\FasilitasController;
use App\Mail\TestMail;

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

Route::resource('dashboard', DashboardUserController::class);
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
    Route::get('pesanan-offline/create', [PesananOfflineController::class, 'create'])->name('pesanan-offline.create');
    Route::patch('pesanan/{pesanan}/status', [PesananOfflineController::class, 'updateStatus'])->name('pesanan.updateStatus');

    
    Route::resource('lapangan', LapanganController::class);
    Route::resource('user', UserController::class);
    Route::resource('slotwaktu', SlotWaktuController::class);
    Route::resource('pembayaran', PembayaranController::class);
     Route::resource('fasilitas', FasilitasController::class);
    
    Route::patch('pembayaran/{pembayaran}/status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
});

Route::prefix('user')->name('user.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('dashboard');
    Route::resource('pesanan', PesananOnlineController::class)->only(['create', 'store', 'show']);
    Route::get('pesanan/history', [PesananOnlineController::class, 'history'])->name('pesanan.history');
    Route::resource('pembayaran', PembayaranUserController::class);
    Route::get('pembayaran/{pembayaran}/upload', [PembayaranUserController::class, 'show'])->name('pembayaran.show');
    Route::patch('pembayaran/{pembayaran}/upload', [PembayaranUserController::class, 'upload'])->name('pembayaran.upload');
    Route::get('/riwayat-pesanan', [RiwayatPesananuserController::class, 'index'])->name('riwayat.index');

});


Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');


 
