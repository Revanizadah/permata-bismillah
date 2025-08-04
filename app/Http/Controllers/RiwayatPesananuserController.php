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

    public function show(Pesanan $pesanan)
    {
        if ($pesanan->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }

        $pesanan->load(['user', 'lapangan', 'pembayaran', 'detailPemesanan.slotWaktu']);

        return view('pesanan.detail-pesanan-user', compact('pesanan'));
    }
    
    public function cancel(Pesanan $pesanan)
    {
        if ($pesanan->user_id !== Auth::id()) {
            abort(403, 'AKSES DITOLAK');
        }
        if ($pesanan->status !== 'pending') {
            return redirect()->route('riwayat.show', $pesanan->id)
                             ->with('error', 'Pesanan yang sudah dikonfirmasi atau dibatalkan tidak bisa diubah.');
        }
        $pesanan->status = 'cancelled';
        // $pesanan->status_pembayaran = "canceled";
        $pesanan->save();
        return redirect()->route('user.riwayat.index')->with('success', 'Pesanan Anda berhasil dibatalkan.');
    }
}
