@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-5">
        <h1 class="text-3xl font-bold mb-5">Pemesanan Lapangan Futsal</h1>

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

        <!-- Tombol Pemesanan -->
        <button class="btn btn-primary">Pesan Lapangan</button>

    </div>
    @endsection
