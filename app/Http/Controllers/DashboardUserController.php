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

        $lapanganPopuler = Lapangan::select('lapangans.*', DB::raw('COUNT(pesanans.id) as total_pesanan'))
        ->join('pesanans', 'lapangans.id', '=', 'pesanans.lapangan_id')
        ->where('pesanans.status', 'confirmed') // Hanya hitung pesanan yang sudah dikonfirmasi
        ->groupBy('lapangans.id')
        ->orderByDesc('total_pesanan')
        ->take(1) // Ambil 4 teratas
        ->get();

        return view('dashboard.dashboardUser', compact('lapangans', 'lapanganPopuler'));
    }
}
