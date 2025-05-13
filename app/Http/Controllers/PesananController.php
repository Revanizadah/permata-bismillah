<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return view('pesanan.index');
    }

    public function create()
    {
        return view('pesanan.create');
    }

    public function store(Request $request)
    {
        // Logic to store the pesanan
        return redirect()->route('pesanan.index');
    }

    public function show($id)
    {
        return view('pesanan.show', compact('id'));
    }

    public function edit($id)
    {
        return view('pesanan.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update the pesanan
        return redirect()->route('pesanan.index');
    }

    public function destroy($id)
    {
        // Logic to delete the pesanan
        return redirect()->route('pesanan.index');
    }
}
