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
}
