<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlotWaktu;

class SlotWaktuController extends Controller
{
    public function index()
    {
        $slotWaktus = SlotWaktu::all();
        return view('slotwaktu.index-admin', compact('slotWaktus'));
    }

    public function create()
    {
        return view('slotwaktu.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);
        SlotWaktu::create($validated);
        return redirect()->route('slotwaktu.index')->with('success', 'Slot waktu berhasil ditambahkan');
    }

    public function edit(SlotWaktu $slotwaktu)
    {
        return view('slotwaktu.edit', compact('slotwaktu'));
    }

    public function update(Request $request, SlotWaktu $slotwaktu)
    {
        $validated = $request->validate([
            'nama_lapangan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
        ]);
        $slotwaktu->update($validated);
        return redirect()->route('slotwaktu.index')->with('success', 'Slot waktu berhasil diupdate');
    }

    public function destroy(SlotWaktu $slotwaktu)
    {
        $slotwaktu->delete();
        return redirect()->route('slotwaktu.index')->with('success', 'Slot waktu berhasil dihapus');
    }

    public function show(SlotWaktu $slotwaktu)
    {
        return view('slotwaktu.show', compact('slotwaktu'));
    }
}
