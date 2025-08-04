<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Illuminate\Support\Facades\Storage;

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
        
        return view('admin.Laporan.pendapatan', compact(
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

        public function exportExcel(Request $request)
    {
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth());
        $tanggalSelesai = $request->input('tanggal_selesai', Carbon::now()->endOfMonth());

        $pesanans = Pesanan::with(['user', 'lapangan'])
            ->where('status', 'confirmed')
            ->whereBetween('tanggal_pesan', [$tanggalMulai, $tanggalSelesai])
            ->latest()
            ->get();
        
        $dataUntukExport = $pesanans->map(function ($pesanan) {
            return [
                'ID Pesanan' => $pesanan->id,
                'Invoice' => $pesanan->pembayaran->kode_pembayaran ?? 'N/A',
                'Nama Pelanggan' => $pesanan->user->nama ?? 'N/A',
                'Email' => $pesanan->user->email ?? 'N/A',
                'Nama Lapangan' => $pesanan->lapangan->nama ?? 'N/A',
                'Tanggal Pesan' => Carbon::parse($pesanan->tanggal_pesan)->format('d-m-Y'),
                'Total Harga' => $pesanan->total_harga,
                'Status' => ucfirst($pesanan->status),
                'Dibuat Pada' => $pesanan->created_at->format('d-m-Y H:i'),
            ];
        });

        $tanggal = now()->format('d-m-Y');
        $fileName = "laporan-pendapatan-{$tanggal}.xlsx";
        $filePath = 'temp/' . $fileName;

        SimpleExcelWriter::create(Storage::path($filePath))
            ->addHeader([
                'ID Pesanan', 'Invoice', 'Nama Pelanggan', 'Email', 'Nama Lapangan',
                'Tanggal Pesan', 'Total Harga', 'Status', 'Dibuat Pada'
            ])
            ->addRows($dataUntukExport);

        return response()->download(Storage::path($filePath), $fileName)
                         ->deleteFileAfterSend(false);
    }
}
