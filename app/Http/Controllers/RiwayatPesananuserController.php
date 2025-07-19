<?php

namespace App\Http\Controllers;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Lapangan;
use App\Models\SlotWaktu;
use Carbon\Carbon;  
use App\Models\User;

use Illuminate\Http\Request;

class RiwayatPesananuserController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $userId = Auth::id();
        $pesanans = Pesanan::where('user_id', $userId)
                           ->with(['lapangan', 'pembayaran'])
                           ->latest()
                           ->paginate(10);

        return view('pesanan.riwayat-user', compact('pesanans'));
    }
}
