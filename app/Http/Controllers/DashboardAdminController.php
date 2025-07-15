<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lapangan;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalLapangan = Lapangan::count();
        $pesananPending = Pesanan::where('status', 'pending')->count();
        $pesananConfirmed = Pesanan::where('status', 'confirmed')->count();

        $pesananUntukKalender = Pesanan::where('status', 'confirmed')->with('lapangan')->get();
        $events = [];
        foreach ($pesananUntukKalender as $pesanan) {
            $events[] = [
                'title' => $pesanan->lapangan->nama,
                'start' => $pesanan->tanggal_pesan,
            ];
        }

        $pendapatanPerHari = Pesanan::select(
                DB::raw('DATE(created_at) as tanggal'),
                DB::raw('SUM(total_harga) as total')
            )
            ->where('status', 'confirmed')
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
        
        $semuaTanggal = [];
        for ($i = 6; $i >= 0; $i--) {
            $semuaTanggal[Carbon::now()->subDays($i)->format('Y-m-d')] = 0;
        }

        foreach ($pendapatanPerHari as $pendapatan) {
            if (isset($semuaTanggal[$pendapatan->tanggal])) {
                $semuaTanggal[$pendapatan->tanggal] = $pendapatan->total;
            }
        }
        
        $labels = array_map(function($tanggal) {
            return Carbon::parse($tanggal)->format('d M');
        }, array_keys($semuaTanggal));
        
        $dataPendapatan = array_values($semuaTanggal);

        return view('dashboard.dashboardAdmin', compact(
            // Data untuk kartu
            'totalUser',
            'totalLapangan',
            'pesananPending',
            'pesananConfirmed',
            'events',
            'labels',
            'dataPendapatan'
        ));
    }
}

