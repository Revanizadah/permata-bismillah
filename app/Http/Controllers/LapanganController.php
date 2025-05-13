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

    public function futsal()
    {
        // Return the futsal view from the 'futsal' folder
        return view('futsal.index');  // views/futsal/index.blade.php
    }

    // Method to handle the Badminton page
    public function badminton()
    {
        // Return the badminton view from the 'badminton' folder
        return view('badminton.index');  // views/badminton/index.blade.php
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
