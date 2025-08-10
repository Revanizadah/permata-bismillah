@extends('layouts.app-user')

@section('title', $lapangan->nama)

@section('content')
<div class="container mx-auto py-16 px-4 pt-28">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-4">
            <a href="{{ url()->previous() }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                &larr; Kembali ke Daftar
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="h-80 bg-gray-200">
                <img src="{{ $lapangan->gambar ? asset('storage/images/lapangan/' . $lapangan->gambar) : 'https://via.placeholder.com/800x400.png/E2E8F0/4A5568?text=Permata' }}"
                     alt="Foto {{ $lapangan->nama }}"
                     class="w-full h-full object-cover">
            </div>

            <div class="p-8">
                <div class="flex flex-col md:flex-row justify-between items-start">
                    <div>
                        <h1 class="text-4xl font-extrabold text-gray-900">{{ $lapangan->nama }}</h1>
                        <p class="text-md text-gray-500 mt-1">{{ $lapangan->lokasi ?? 'Malang' }}</p>
                    </div>
                    <div class="mt-4 md:mt-0 text-left md:text-right">
                        <span class="text-sm text-gray-600">Mulai dari</span>
                        <p class="text-3xl font-bold text-indigo-600">
                            Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} <span class="text-lg font-medium text-gray-500">/jam</span>
                        </p>
                    </div>
                </div>

                <div class="mt-8 border-t pt-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Fasilitas Tersedia</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @forelse($fasilitasStatis as $fasilitas)
                            <div class="flex items-center text-gray-700">
                                <i class="{{ $fasilitas->ikon ?? 'fas fa-check-circle' }} text-green-500 mr-3"></i>
                                <span>{{ $fasilitas->nama }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-full">Informasi fasilitas tidak tersedia.</p>
                        @endforelse
                    </div>
                </div>
                <div class="mt-10 text-center">
                    <a href="{{ route('user.pesanan.create') }}" class="w-full md:w-auto inline-block bg-indigo-600 text-white px-10 py-3 rounded-lg hover:bg-indigo-700 font-bold text-lg transition">
                        Pesan Lapangan Ini Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection