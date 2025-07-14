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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:lapangans,id',
            'booking_date' => 'required|date',
            'slot_ids' => 'required|array|min:1',
            'slot_ids.*' => 'exists:slot_waktus,id', // PERBAIKI: Rujuk ke tabel 'slot_waktus'
        ]);

        try {
            DB::beginTransaction();
            $lapangan = Lapangan::findOrFail($validated['field_id']);
            $totalHarga = count($validated['slot_ids']) * $lapangan->harga_per_jam;

            $pesanan = Pesanan::create([
                'user_id' => 1, // Ganti dengan Auth::id() jika sudah ada login
                'lapangan_id' => $lapangan->id,
                'tanggal_pesan' => $validated['booking_date'],
                'total_harga' => $totalHarga,
                'status' => 'pending',
            ]);

            foreach ($validated['slot_ids'] as $slotId) {
                $pesanan->detailPemesanan()->create(['slot_waktu_id' => $slotId]);
            }

            $pembayaran = $pesanan->pembayaran()->create([
                'kode_pembayaran' => 'INV-' . time() . $pesanan->id,
                'status_pembayaran' => 'unpaid',
                'expired_at' => Carbon::now()->addMinutes(60),
            ]);

            DB::commit();
            return redirect()->route('pembayaran.index')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    // Method API
    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:lapangans,id',
            'date' => 'required|date_format:Y-m-d',
        ]);
        
        // PERBAIKI: Join ke tabel 'detail_pesanans' sesuai migrasi Anda
        $bookedSlotIds = Pesanan::join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.pesanan_id')
            ->where('pesanans.lapangan_id', $validated['field_id'])
            ->whereDate('pesanans.tanggal_pesan', $validated['date'])
            ->whereIn('pesanans.status', ['pending', 'confirmed'])
            ->pluck('detail_pesanans.slot_waktu_id');

        return response()->json(['booked_slot_ids' => $bookedSlotIds]);
    }

}