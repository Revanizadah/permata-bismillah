<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::all();

        return view('lapangan.index-admin', compact('lapangans'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_per_jam' => 'required|numeric|min:0',
            'harga_weekend_per_jam' => 'nullable|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('images/lapangan', 'public');
            $validated['gambar'] = basename($path);
        }

        Lapangan::create($validated);

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil ditambahkan');
    }




    public function destroy(Lapangan $lapangan)
    {
        // Hapus gambar terkait dari storage jika ada
        if ($lapangan->gambar) {
            Storage::disk('public')->delete('images/lapangan/' . $lapangan->gambar);
        }

        // Hapus data dari database
        $lapangan->delete();

        return redirect()->route('admin.lapangan.index')->with('success', 'Lapangan berhasil dihapus.');
    }
}
