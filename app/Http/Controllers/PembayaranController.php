<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::latest()->paginate(10); 

        return view('payment.index-admin', compact('pembayarans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pesanan' => 'required|string',
            'nama_pemesan' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'status_pembayaran' => 'required|string',
            'jumlah_pembayaran' => 'required|string',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'catatan' => 'nullable|string',
        ]);
        if ($request->hasFile('bukti_pembayaran')) {
            $validated['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }
        Pembayaran::create($validated);
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

   public function confirm(Pembayaran $pembayaran)
    {
        // Ubah status pembayaran & pesanan
        $pembayaran->update(['status_pembayaran' => 'paid']);
        $pembayaran->pesanan()->update(['status' => 'confirmed']);
        // Anda bisa menambahkan notifikasi email ke user di sini
        return back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function reject(Pembayaran $pembayaran)
    {
        if ($pembayaran->bukti_pembayaran) {
            Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
        }

        $pembayaran->update([
            'status_pembayaran' => 'rejected',
            'bukti_pembayaran' => null,
        ]);
        // Anda bisa menambahkan notifikasi email ke user di sini
        return back()->with('success', 'Bukti pembayaran telah ditolak.');
    }
}
