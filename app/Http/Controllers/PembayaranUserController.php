<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pembayaran;

class PembayaranUserController extends Controller
{
    public function show(Pembayaran $pembayaran)
    {
        if (!$pembayaran->pesanan || $pembayaran->pesanan->user_id !== auth()->id()) {

            abort(403, 'Akses Ditolak');
        }

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Mengunggah dan memproses bukti pembayaran.
     */
    public function upload(Request $request, Pembayaran $pembayaran)
    {
        // ✅ PERBAIKAN: Terapkan pengecekan yang sama di sini
        if (!$pembayaran->pesanan || $pembayaran->pesanan->user_id !== auth()->id()) {
            abort(403, 'Akses Ditolak');
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        $pembayaran->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'paid',
        ]);
        
        $pembayaran->pesanan()->update(['status' => 'confirmed']);

        return redirect()->route('pembayaran.show', $pembayaran->id)
                         ->with('success', 'Bukti pembayaran berhasil diunggah! Pesanan Anda telah dikonfirmasi.');
    }
}
