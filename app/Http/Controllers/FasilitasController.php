<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fasilitas = Fasilitas::latest()->paginate(10);
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    /**
     * Menyimpan fasilitas baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:fasilitas',
            'ikon' => 'nullable|string|max:255',
        ]);

        Fasilitas::create($request->all());

        return redirect()->route('admin.fasilitas.index')
                         ->with('success', 'Fasilitas baru berhasil ditambahkan.');
    }
   public function show(Fasilitas $fasilitas)
    {
        return response()->json($fasilitas);
    }

    /**
     * Mengupdate data fasilitas yang ada.
     */
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $request->validate([
        'nama' => 'required|string|max:255,' . $fasilitas->id,
        'ikon' => 'nullable|string|max:255',
        ]);

        $fasilitas->update($request->all());

        return redirect()->route('admin.fasilitas.index')
                         ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Menghapus data fasilitas.
     */
    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();
        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
