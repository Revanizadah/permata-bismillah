@extends('layouts.user-layout')

@section('title', 'Tentang Lapangan Kami')

@section('content')
<div class="w-full max-w-screen-lg mx-auto px-4 pt-32 pb-10">
    <h2 class="text-4xl font-bold text-center text-gray-800 mb-8">Tentang Jenis-Jenis Lapangan</h2>

    {{-- Di sini, Anda bisa mengambil data lapangan dari database menggunakan @foreach --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <div class="bg-white shadow-lg rounded-lg p-6 text-center transition duration-300 transform hover:-translate-y-2">
            <img src="https://via.placeholder.com/300" alt="Lapangan Futsal Sintetis" class="w-full h-48 object-cover rounded-lg mb-4" />
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Lapangan Futsal Sintetis</h3>
            <p class="text-gray-600 mb-4">Lapangan futsal sintetis menggunakan rumput sintetis yang memberikan pengalaman bermain yang lebih nyaman.</p>
            <div class="text-gray-800 space-y-1">
                <p class="text-lg font-bold">Weekday Rp 70.000 / Jam</p>
                <p class="text-lg font-bold">Weekend Rp 100.000 / Jam</p>
            </div>
        </div>
    </div>
</div>
@endsection