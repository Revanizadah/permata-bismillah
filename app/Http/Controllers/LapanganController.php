<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::all();

        return view('lapangan.index', compact('lapangans'));
    }
    public function create()
    {
        return view('lapangan.create');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'harga_per_jam' => 'required|numeric',
            'status' => 'required|string',
            'jenis_lapangan' => 'required|string',
            'deskripsi' => 'nullable|string',
        ]);

        // Create the lapangan record
        Lapangan::create($validated);

        // Redirect to the index page with a success message
        return redirect()->route('lapangan.index')->with('success', 'Lapangan berhasil ditambahkan');
    }
}
