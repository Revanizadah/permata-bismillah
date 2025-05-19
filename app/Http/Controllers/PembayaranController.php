<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    // Tampilkan semua pembayaran
    public function index()
    {
        $pembayarans = Pembayaran::all();
        return view('payment.index', compact('pembayarans'));
    }

    // Tampilkan form tambah pembayaran
    public function create()
    {
        return view('payment.create');
    }

    // Simpan pembayaran baru
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

    // Tampilkan detail pembayaran
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('payment.show', compact('pembayaran'));
    }

    // Tampilkan form edit pembayaran
    public function edit($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        return view('payment.edit', compact('pembayaran'));
    }

    // Update pembayaran
    public function update(Request $request, $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
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
        $pembayaran->update($validated);
        return redirect()->route('payment.index')->with('success', 'Pembayaran berhasil diupdate');
    }

    // Hapus pembayaran
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus');
    }
}
