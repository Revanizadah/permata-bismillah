@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pemesanan Lapangan</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Lapangan</th>
                <th>Jenis Lapangan</th>
                <th>Harga per Jam</th>
                <th>Jam Pemesanan</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->lapangan->nama_lapangan }}</td>
                    <td>{{ $order->lapangan->jenis_lapangan }}</td>
                    <td>Rp {{ number_format($order->lapangan->harga_per_jam, 0, ',', '.') }}</td>
                    <td>{{ $order->jam }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
