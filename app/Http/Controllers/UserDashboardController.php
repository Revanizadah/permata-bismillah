<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk pengguna biasa.
     */
    public function index()
    {
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Kirim data ke view
        return view('user.dashboard', compact('user'));
    }
}