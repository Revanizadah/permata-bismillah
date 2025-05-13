<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;  // Correct namespace for Lapangan model
use Illuminate\Http\Request;

class LapanganController extends Controller
{
    // Display a listing of lapangan
    public function index()
    {
        // Get all lapangan records
        $lapangan = Lapangan::all();
        return view('lapangan.index', compact('lapangan'));
    }

    // Show the form for creating a new lapangan
    public function create()
    {
        return view('lapangan.create');
    }

    // Store a newly created lapangan in the database
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
