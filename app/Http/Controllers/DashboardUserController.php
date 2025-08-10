<?php

namespace App\Http\Controllers;
use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardUserController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::all();

        $lapanganPopuler = Lapangan::select('lapangans.id', 'lapangans.nama', 'lapangans.gambar', 'lapangans.harga_per_jam', DB::raw('COUNT(pesanans.id) as total_pesanan'))
        ->join('pesanans', 'lapangans.id', '=', 'pesanans.lapangan_id')
        ->where('pesanans.status', 'confirmed')
        ->groupBy('lapangans.id', 'lapangans.nama', 'lapangans.gambar', 'lapangans.harga_per_jam')
        ->orderByDesc('total_pesanan')
        ->take(4)
        ->get();

        return view('dashboard.dashboardUser', compact('lapangans', 'lapanganPopuler'));
    }

    public function showLapangan(Lapangan $lapangan)
    {
               
        $fasilitasStatis = [];

        if (str_contains(strtolower($lapangan->nama), 'futsal')) {
            $fasilitasStatis = [
                (object)['nama' => 'Parkir Luas', 'ikon' => 'fas fa-parking'],
                (object)['nama' => 'Kantin', 'ikon' => 'fas fa-utensils'],
                (object)['nama' => 'Mushola', 'ikon' => 'fas fa-mosque'],
                (object)['nama' => 'Toilet Bersih', 'ikon' => 'fas fa-restroom'],
            ];
        } elseif (str_contains(strtolower($lapangan->nama), 'badminton')) {
            $fasilitasStatis = [
                (object)['nama' => 'Parkir Luas', 'ikon' => 'fas fa-parking'],
                (object)['nama' => 'Wi-Fi Gratis', 'ikon' => 'fas fa-wifi'],
                (object)['nama' => 'Kamar Ganti', 'ikon' => 'fas fa-shower'],
                (object)['nama' => 'Toilet Bersih', 'ikon' => 'fas fa-restroom'],
            ];
        }
        
        return view('lapangan.show', compact('lapangan', 'fasilitasStatis'));
    }
}
