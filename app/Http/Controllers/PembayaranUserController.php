<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PembayaranUserController extends Controller
{
    public function show(Pembayaran $pembayaran)
    {
        if (!$pembayaran->pesanan || !$pembayaran->pesanan->user || $pembayaran->pesanan->user->id !== Auth::id()) {

            abort(403, 'Akses Ditolak');
        }

        return view('payment.pembayaran-user', compact('pembayaran'));
    }

    public function upload(Request $request, Pembayaran $pembayaran)
    {
        if (!$pembayaran->pesanan || $pembayaran->pesanan->user_id !== Auth::id()) {
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
            'status_pembayaran' => 'pending',
        ]);

        return redirect()->route('user.riwayat.index', $pembayaran->id)
                         ->with('success', 'Bukti pembayaran berhasil diunggah! Pesanan Anda telah dikonfirmasi.');
    }
}
