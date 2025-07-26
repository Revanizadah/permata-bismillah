<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Pesanan;
use App\Models\SlotWaktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- WAJIB
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PesananOnlineController extends Controller
{
    /**
     * Menampilkan form untuk membuat pesanan baru oleh pengguna.
     */
    public function create()
    {
        $lapangans = Lapangan::orderBy('nama')->get();
        $slotWaktus = SlotWaktu::orderBy('jam_mulai')->get();
        $tanggalHariIni = Carbon::now()->toDateString();
        
        // Mengarahkan ke view khusus pengguna
        return view('pesanan.online-order', compact('lapangans', 'slotWaktus', 'tanggalHariIni'));
    }

    /**
     * Menyimpan pesanan baru yang dibuat oleh pengguna.
     */
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

        $lapangan = Lapangan::find($validated['field_id']);
        
        // --- MODIFIKASI DIMULAI DI SINI ---

        // 1. Ubah string tanggal menjadi objek Carbon yang "pintar"
        $tanggalPesan = Carbon::parse($validated['booking_date']);

        // 2. Tentukan harga per jam berdasarkan hari (weekend atau weekday)
        $hargaPerJam = $tanggalPesan->isWeekend() 
                       ? $lapangan->harga_weekend_per_jam 
                       : $lapangan->harga_per_jam;

        // 3. Hitung total harga menggunakan harga yang sudah benar
        $totalHarga = count($validated['slot_ids']) * $hargaPerJam;

        // --- AKHIR DARI MODIFIKASI ---

        $pesanan = Pesanan::create([
            'user_id' => Auth::id(), 
            'lapangan_id' => $lapangan->id,
            'tanggal_pesan' => $validated['booking_date'],
            'total_harga' => $totalHarga, // Menggunakan total harga yang sudah dinamis
            'status' => 'pending',
        ]);

        foreach ($validated['slot_ids'] as $slotId) {
            $pesanan->detailPemesanan()->create(['slot_waktu_id' => $slotId]);
        }

        $pembayaran = $pesanan->pembayaran()->create([
            'kode_pembayaran' => 'INV-' . time() . $pesanan->id,
            'metode_pembayaran' => 'transfer', // Anda bisa sesuaikan ini
            'status_pembayaran' => 'unpaid',
            'expired_at' => Carbon::now()->addMinutes(60), // Anda mengubah ini menjadi 1 menit
        ]);

        DB::commit();
        
        // Arahkan pengguna ke halaman detail pembayaran mereka
        return redirect()->route('pembayaran.show', $pembayaran->id)->with('success', 'Pesanan Anda berhasil dibuat!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
    }
}
}