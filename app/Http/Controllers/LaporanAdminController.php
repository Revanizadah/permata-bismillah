<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanAdminController extends Controller
{
        public function pendapatan(Request $request)
    {
        // Tentukan tanggal default: awal hingga akhir bulan ini
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', Carbon::now()->endOfMonth()->toDateString());

        // ======== DATA UNTUK TABEL & STATISTIK ========
        // Ambil data pesanan yang sudah dikonfirmasi dalam rentang tanggal yang dipilih
        $laporanPesanans = Pesanan::with(['user', 'lapangan'])
                                ->where('status', 'confirmed')
                                ->whereBetween('tanggal_pesan', [$tanggalMulai, $tanggalSelesai])
                                ->latest()
                                ->paginate(15)
                                ->withQueryString(); // Agar filter tetap ada saat pindah halaman

        // ======== DATA UNTUK KARTU STATISTIK ========
        $totalPendapatan = $laporanPesanans->sum('total_harga');
        $jumlahTransaksi = $laporanPesanans->total(); // Menggunakan total dari paginator
        $rataRataTransaksi = ($jumlahTransaksi > 0) ? $totalPendapatan / $jumlahTransaksi : 0;

        // ======== DATA UNTUK GRAFIK KONTRIBUSI LAPANGAN ========
        $kontribusiLapangan = Pesanan::select('lapangan_id', DB::raw('SUM(total_harga) as total'))
                                    ->where('status', 'confirmed')
                                    ->whereBetween('tanggal_pesan', [$tanggalMulai, $tanggalSelesai])
                                    ->groupBy('lapangan_id')
                                    ->with('lapangan')
                                    ->get();
        
        $labelsKontribusi = $kontribusiLapangan->pluck('lapangan.nama');
        $dataKontribusi = $kontribusiLapangan->pluck('total');
        
        // Kirim semua data ke view
        return view('admin.laporan.pendapatan', compact(
            'laporanPesanans',
            'totalPendapatan',
            'jumlahTransaksi',
            'rataRataTransaksi',
            'labelsKontribusi',
            'dataKontribusi',
            'tanggalMulai',
            'tanggalSelesai'
        ));
    }
}
