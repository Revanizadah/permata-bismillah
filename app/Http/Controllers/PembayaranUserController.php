<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pembayaran;

class PembayaranUserController extends Controller
{
        public function show(Pembayaran $pembayaran)
    {
        // Pastikan pengguna hanya bisa melihat pembayaran miliknya
        if ($pembayaran->pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Mengunggah dan memproses bukti pembayaran.
     */
    public function upload(Request $request, Pembayaran $pembayaran)
    {

        if ($pembayaran->pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Hapus bukti lama jika ada
        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        // Simpan file baru
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Update database
        $pembayaran->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'paid', // Langsung ubah status menjadi paid
        ]);
        
        // Update status pesanan juga
        $pembayaran->pesanan()->update(['status' => 'confirmed']);

        return redirect()->route('pembayaran.show', $pembayaran->id)
                         ->with('success', 'Bukti pembayaran berhasil diunggah! Pesanan Anda telah dikonfirmasi.');
    }
}
