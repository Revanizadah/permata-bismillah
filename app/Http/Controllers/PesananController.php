<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // app/Http/Controllers/PesananController.php

public function index(Request $request)
{
    // Mulai query dengan eager loading untuk performa yang baik
    $query = Pesanan::with(['user', 'lapangan', 'detailPemesanan.slotWaktu'])->latest();

    // Terapkan filter tanggal JIKA ada parameter di URL
    if ($request->has('tanggal') && $request->tanggal != '') {
        $query->whereDate('tanggal_pesan', $request->tanggal);
    }

    // SELALU panggil ->paginate() sebagai perintah terakhir untuk mendapatkan hasilnya.
    // Ini akan mengembalikan objek Paginator, bukan Collection.
    $pesanans = $query->paginate(10);
    
    // Kirim objek Paginator ke view
    return view('pesanan.index-admin', compact('pesanans'));
}
}
