<?php

namespace App\Http\Controllers;

use App\Models\Lapangan;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('lapangan')->get();
        return view('order.index', compact('orders'));
    }

    public function create()
    {
        $lapangans = Lapangan::all();
        return view('order.create', compact('lapangans'));
    }

    public function store(Request $request)
    {
        // Validasi dan penyimpanan order
        $request->validate([
            'lapangan_id' => 'required|exists:lapangans,id',
            'jam' => 'required|numeric|min:1',
            'notes' => 'nullable|string',
        ]);

        $lapangan = Lapangan::find($request->lapangan_id);
        $totalHarga = $lapangan->harga_per_jam * $request->jam;

        Order::create([
            'user_id' => auth()->id(),
            'lapangan_id' => $request->lapangan_id,
            'total_harga' => $totalHarga,
            'jam' => $request->jam,
            'notes' => $request->notes,
            'status' => 'Pending',
        ]);

        return redirect()->route('order.index');
    }
}

