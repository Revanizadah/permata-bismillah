<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use VerifiesEmails;

    /**
     * Ke mana pengguna akan diarahkan setelah verifikasi berhasil.
     */
    protected $redirectTo = '/user/dashboard'; // Sesuaikan dengan route dashboard Anda

    /**
     * Buat instance controller baru.
     */
    public function __construct()
    {
        // Middleware ini akan kita definisikan di file route
    }

    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('auth.verify', [
                            'pageTitle' => 'Verifikasi Alamat Email Anda'
                        ]);
    }
}