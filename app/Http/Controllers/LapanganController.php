<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Lapangan;

class LapanganController extends Controller
{
    public function index() {
        $lapangans = Lapangan::all();

        return view('lapangan.index', compact('lapangans'));
    }


}
