<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('payment.index-admin', compact('pembayarans'));
    }

    public function create()
    {
        return view('payment.create');
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

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Sukses,Ditolak',
    ]);

    $pembayaran = Pembayaran::findOrFail($id);

    $pembayaran->status_pembayaran = $request->status;
    $pembayaran->save();

    return redirect()->back()->with('success', 'Status pembayaran berhasil diupdate!');
}
}
