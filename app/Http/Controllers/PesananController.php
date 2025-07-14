<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Lapangan;
use App\Models\SlotWaktu;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function index()
    {
        $lapangans = Lapangan::orderBy('nama')->get();
        $slotWaktus = SlotWaktu::orderBy('jam_mulai')->get();

        return view('pesanan.offline-order', compact('lapangans', 'slotWaktus'));
    }

    public function indexUser()
    {
        $pesanans = Pesanan::all();
        return view('pesanan.index-user', compact('pesanans'));
    }

// di PesananController.php

public function checkAvailability(Request $request)
{
    $validated = $request->validate([
        'field_id' => 'required|exists:lapangans,id',
        'date' => 'required|date_format:Y-m-d',
    ]);

    // PERUBAHAN NAMA TABEL PADA JOIN
    $bookedSlotIds = Pesanan::join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.pesanan_id')
        ->where('pesanans.lapangan_id', $validated['field_id'])
        ->whereDate('pesanans.tanggal_pesan', $validated['date'])
        ->whereIn('pesanans.status', ['pending', 'confirmed'])
        ->pluck('detail_pesanans.slot_waktu_id');

    return response()->json([
        'booked_slot_ids' => $bookedSlotIds
    ]);
}
    // use Carbon\Carbon; // Jangan lupa import Carbon (sudah di-import di atas)

    public function store(Request $request)
    {
    $validated = $request->validate([
        'field_id' => 'required|exists:lapangans,id',
        'booking_date' => 'required|date',
        'slot_ids' => 'required|array|min:1',
        'slot_ids.*' => 'exists:slot_waktu,id',
    ]);

    try {
        DB::beginTransaction();

        $lapangan = Lapangan::findOrFail($validated['field_id']);
        $totalHarga = count($validated['slot_ids']) * $lapangan->harga_per_jam;

        // 1. Buat data pesanan utama
        $pesanan = Pesanan::create([
            'user_id' => 1,
            'lapangan_id' => $lapangan->id,
            'tanggal_pesan' => $validated['booking_date'],
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        // 2. Buat data detail slot yang dipesan
        foreach ($validated['slot_ids'] as $slotId) {
            $pesanan->detailPemesanan()->create(['slot_waktu_id' => $slotId]);
        }

        // 3. Buat data pembayaran
        $pesanan->pembayaran()->create([
            'kode_pembayaran' => 'INV-' . time() . $pesanan->id, // Contoh kode unik
            'status_pembayaran' => 'unpaid',
            'expired_at' => Carbon::now()->addMinutes(30), // Contoh: batas bayar 30 menit
        ]);

        DB::commit();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibuat! Segera lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
