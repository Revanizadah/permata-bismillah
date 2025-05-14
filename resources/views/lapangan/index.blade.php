@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Lapangan</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Lapangan</th>
                <th>Jenis Lapangan</th>
                <th>Harga per Jam</th>
                <th>Status</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lapangans as $lapangan)
                <tr>
                    <td>{{ $lapangan->nama_lapangan }}</td>
                    <td>{{ $lapangan->jenis_lapangan }}</td>
                    <td>Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</td>
                    <td>{{ $lapangan->status }}</td>
                    <td>{{ $lapangan->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
