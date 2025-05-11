@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Pemesanan Lapangan Badminton Admin</h1>

        <!-- Form Pemesanan -->
        <div class="mb-5">
            <label for="nama_pemesan" class="font-semibold">Nama Pemesan</label>
            <input type="text" id="nama_pemesan" class="form-control mt-2 w-48" required/>
        </div>

        <div class="mb-5">
            <label for="no_hp" class="font-semibold">Nomor HP Pemesan</label>
            <input type="text" id="no_hp" class="form-control mt-2 w-48" required/>
        </div>

        <!-- Pilihan Tanggal -->
        <div class="mb-5">
            <label for="tanggal" class="font-semibold">Tanggal</label>
            <input type="date" id="tanggal" class="form-control mt-2 w-48" />
        </div>

        <!-- Pilihan Jam -->
        <div class="mb-5">
            <label class="font-semibold">Jam</label>
            <div class="d-flex flex-wrap mt-2">
                @foreach(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $jam)
                    <button class="btn btn-light m-1" data-jam="{{ $jam }}" onclick="selectJam(this)">{{ $jam }}</button>
                @endforeach
            </div>
        </div>

        <!-- Tombol Pemesanan -->
        <button class="btn btn-primary">Pesan Lapangan</button>
    </div>
    @endsection
