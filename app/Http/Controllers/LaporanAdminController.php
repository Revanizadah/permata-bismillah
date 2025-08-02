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

        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', Carbon::now()->endOfMonth()->toDateString());

        $laporanPesanans = Pesanan::with(['user', 'lapangan'])
                                ->where('status', 'confirmed')
                                ->whereBetween('tanggal_pesan', [$tanggalMulai, $tanggalSelesai])
                                ->latest()
                                ->paginate(15)
                                ->withQueryString();

        $totalPendapatan = $laporanPesanans->sum('total_harga');
        $jumlahTransaksi = $laporanPesanans->total();
        $rataRataTransaksi = ($jumlahTransaksi > 0) ? $totalPendapatan / $jumlahTransaksi : 0;

        $kontribusiLapangan = Pesanan::select('lapangan_id', DB::raw('SUM(total_harga) as total'))
                                    ->where('status', 'confirmed')
                                    ->whereBetween('tanggal_pesan', [$tanggalMulai, $tanggalSelesai])
                                    ->groupBy('lapangan_id')
                                    ->with('lapangan')
                                    ->get();
        
        $labelsKontribusi = $kontribusiLapangan->pluck('lapangan.nama');
        $dataKontribusi = $kontribusiLapangan->pluck('total');
        
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
