@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Pemesanan Lapangan Futsal Admin</h1>

        <!-- Pilihan Tanggal -->
        <div class="mb-5">
            <label for="tanggal" class="font-semibold">Tanggal</label>
            <input type="date" id="tanggal" class="form-control mt-2 w-48" required />
        </div>

        <!-- Pilihan Lapangan -->
        <div class="mb-5">
            <label for="lapangan" class="font-semibold">Lapangan</label>
            <div class="d-flex mt-2">
                <button class="btn btn-success mr-2" id="lapangan-sintetis" onclick="toggleLapangan('sintetis')">Lapangan Sintetis</button>
                <button class="btn btn-warning mr-2" id="lapangan-multicort" onclick="toggleLapangan('multicort')">Lapangan Multicort</button>
            </div>
        </div>

        <!-- Tampilan Lapangan Sintetis -->
        <div id="lapanganSintetisDiv" class="lapangan-info hidden">
            <h4>Lapangan Sintetis</h4>
            <p>Lapangan Sintetis menggunakan rumput sintetis yang memberikan permukaan lebih empuk dan mengurangi risiko cedera.</p>
        </div>

        <!-- Tampilan Lapangan Multicort -->
        <div id="lapanganMulticortDiv" class="lapangan-info hidden">
            <h4>Lapangan Multicort</h4>
            <p>Lapangan Multicort biasanya terbuat dari campuran karet dan vinyl yang memberikan permukaan yang lebih keras dan licin.</p>
        </div>

        <!-- Pilihan Jam -->
        <div class="mb-5" id="jam-section" class="hidden">
            <label class="font-semibold">Jam</label>
            <div class="d-flex flex-wrap mt-2">
                @foreach(['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00'] as $jam)
                    <button class="btn btn-light m-1" onclick="selectJam('{{ $jam }}')">{{ $jam }}</button>
                @endforeach
            </div>
        </div>

        <!-- Form Pemesanan -->
        <form action="{{ route('admin.storeBooking') }}" method="POST" id="form-pemesan" class="hidden">
            @csrf
            <label for="nama_pemesan" class="font-semibold">Nama Pemesan</label>
            <input type="text" id="nama_pemesan" name="nama_pemesan" class="form-control mt-2 w-48" required/>

            <label for="no_hp" class="font-semibold mt-3">Nomor HP Pemesan</label>
            <input type="text" id="no_hp" name="no_hp" class="form-control mt-2 w-48" required/>

            <label for="lapangan" class="font-semibold mt-3">Lapangan</label>
            <input type="text" name="lapangan" id="lapangan" class="form-control mt-2 w-48" required readonly/>

            <label for="jam" class="font-semibold mt-3">Jam</label>
            <input type="text" id="jam" name="jam" class="form-control mt-2 w-48" required readonly/>

        </form>

        <!-- Tombol Pemesanan -->
        <button class="btn btn-primary">Pesan Lapangan</button>

    </div>
    @endsection
