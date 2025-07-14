<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Lapangan;
use App\Models\SlotWaktu;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::all();
        $slotWaktus = SlotWaktu::all();
        return view('pesanan.offline-order', compact( 'lapangans', 'slotWaktus'));
    }

    public function indexUser()
    {
        $pesanans = Pesanan::all();
        return view('pesanan.index-user', compact('pesanans'));
    }

    public function checkAvailability(Request $request)
    {
        // 1. Validasi Input dari request AJAX
        $validated = $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id', // Pastikan 'lapangans' adalah nama tabel lapangan Anda
            'tanggal' => 'required|date_format:Y-m-d',
        ]);

        $lapanganId = $validated['lapangan_id'];
        $tanggal = $validated['tanggal'];

        $bookedSlotIds = DB::table('bookings')
            ->join('booking_details', 'bookings.id', '=', 'booking_details.booking_id')
            ->where('bookings.lapangan_id', $lapanganId)
            ->whereDate('bookings.tanggal', $tanggal)
            // Hanya cek pesanan yang statusnya masih aktif (bukan yang sudah batal)
            ->whereIn('bookings.status', ['confirmed', 'pending'])
            ->pluck('booking_details.slot_waktu_id'); // Ambil hanya ID slot-nya saja

        return response()->json([
            'booked_slot_ids' => $bookedSlotIds
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'jenis_lapangan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tanggal_pesan' => 'required|date',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'jumlah_jam' => 'required|integer',
            'status' => 'required|string',
            'total_harga' => 'required|integer',
            'catatan' => 'nullable|string',
        ]);
        Pesanan::create($validated);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function show(Pesanan $pesanan)
    {
        return view('pesanan.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        return view('pesanan.edit', compact('pesanan'));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'jenis_lapangan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'tanggal_pesan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'jumlah_jam' => 'required|integer',
            'status' => 'required|string',
            'total_harga' => 'required|integer',
            'catatan' => 'nullable|string',
        ]);
        $pesanan->update($validated);
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dihapus');
    }
    public function updateStatus(Request $request, $id)
{
    $status = $request->status ?? $request->query('status');

    if (!in_array($status, ['Sukses', 'Ditolak'])) {
        return redirect()->back()->with('error', 'Status tidak valid.');
    }
    
    $pesanan = Pesanan::findOrFail($id);
    $pesanan->status = $status;
    $pesanan->save();

    return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
}
}
