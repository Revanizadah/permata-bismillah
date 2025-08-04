<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Lapangan;
use App\Models\SlotWaktu;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PesananOfflineController extends Controller
{

    public function index(Request $request)
    {
    $query = Pesanan::with(['user', 'lapangan', 'detailPemesanan.slotWaktu'])->latest();

    if ($request->has('tanggal') && $request->tanggal != '') {
        $query->whereDate('tanggal_pesan', $request->tanggal);
    }

    $pesanans = $query->paginate(10);
    return view('pesanan.index-admin', compact('pesanans'));
    }

    public function create()
    {
        $lapangans = Lapangan::orderBy('nama')->get();
        $slotWaktus = SlotWaktu::orderBy('jam_mulai')->get();
        $tanggalHariIni = Carbon::now()->toDateString();

        return view('pesanan.offline-order', compact('lapangans', 'slotWaktus', 'tanggalHariIni'));
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
        'field_id' => 'required|exists:lapangans,id',
        'booking_date' => 'required|date|after_or_equal:today',
        'slot_ids' => 'required|array|min:1',
        'slot_ids.*' => 'exists:slot_waktus,id',
    ]);

        try {
            DB::beginTransaction();
            $lapangan = Lapangan::findOrFail($validated['field_id']);
            $totalHarga = count($validated['slot_ids']) * $lapangan->harga_per_jam;

            $pesanan = Pesanan::create([
                'user_id' => 1,
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
                'metode_pembayaran' => 'cash/ditempat',
                'expired_at' => Carbon::now()->addMinutes(60),
            ]);

            DB::commit();
            return redirect()->route('admin.pembayaran.index')->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:lapangans,id',
            'date' => 'required|date_format:Y-m-d',
        ]);
        

        $bookedSlotIds = Pesanan::join('detail_pesanans', 'pesanans.id', '=', 'detail_pesanans.pesanan_id')
            ->where('pesanans.lapangan_id', $validated['field_id'])
            ->whereDate('pesanans.tanggal_pesan', $validated['date'])
            ->whereIn('pesanans.status', ['pending', 'confirmed'])
            ->pluck('detail_pesanans.slot_waktu_id');

        return response()->json(['booked_slot_ids' => $bookedSlotIds]);
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'status' => 'required|in:confirmed,cancelled', 
        ]);
        
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->route('admin.pesanan-offline.index')->with('success', 'Status pesanan berhasil diperbarui.');
    }

}