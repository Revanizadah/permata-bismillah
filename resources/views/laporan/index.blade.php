@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Laporan Pesanan</h1>

        <!-- Pilih Tanggal -->
    <div class="mb-4">
                <label for="tanggal" class="font-semibold">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control w-25" value="{{ request()->tanggal }}" />
    </div>
            <button type="submit" class="btn btn-primary mb-4">Filter</button>

          <!-- Tabel Laporan -->
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Nomor HP</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Jenis Lapangan</th>
                <th>Bukti Pembayaran</th>
                <th>Status</th>
            </tr>
        </thead>
    </table>
    </div>

@endsection
