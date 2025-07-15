<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lapangan;
use App\Models\Pesanan;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Ambil data dari database
        $totalUser = User::count();
        $totalLapangan = Lapangan::count();
        $pesananPending = Pesanan::where('status', 'pending')->count();
        $pesananConfirmed = Pesanan::where('status', 'confirmed')->count();

        $pesanans = Pesanan::where('status', 'confirmed')->with('lapangan')->get();

        // 2. Format data menjadi array 'events' untuk kalender
        $events = [];
        foreach ($pesanans as $pesanan) {
            $events[] = [
                'title' => $pesanan->lapangan->nama, // Teks yang akan muncul di event kalender
                'start' => $pesanan->tanggal_pesan,  // Tanggal event
            ];
        }

        // Kirim data ke view
        return view('dashboard.dashboardAdmin', compact(
            'totalUser',
            'totalLapangan',
            'pesananPending',
            'pesananConfirmed',
            'events'
        ));
    }
}

