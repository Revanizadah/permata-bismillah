<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('payment.index');
    }

    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request)
    {
        // Logic to store the pembayaran
        return redirect()->route('payment.index');
    }

    public function show($id)
    {
        return view('payment.show', compact('id'));
    }

    public function edit($id)
    {
        return view('payment.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the pembayaran
        return redirect()->route('payment.index');
    }

    public function destroy($id)
    {
        // Logic to delete the pembayaran
        return redirect()->route('payment.index');
    }
}
