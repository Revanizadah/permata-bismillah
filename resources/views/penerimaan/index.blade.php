@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Manajemen Penerimaan</h1>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>No Hp</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jenis Lapangan</th>
                    <th>Bukti Pembayaran</th>
                    <th>Aksi</th> <!-- Aksi untuk admin -->
                </tr>
            </thead>

        </table>
    </div>
@endsection
