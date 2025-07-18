@extends('layouts.app-user')

@section('title', 'Pilihan Venue Kami')

@section('content')
<div class="w-full max-w-screen-xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="pt-20">
        <div class="relative bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-12">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="{{ asset('images/hero.jpg') }}" alt="Background Futsal">
        <div class="absolute inset-0 bg-gray-800 opacity-60"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white">Temukan & Pesan Lapangan Terbaik</h1>
        <p class="mt-4 text-lg text-gray-200">Booking lapangan Futsal & Badminton favorit Anda hanya dengan beberapa klik.</p>
        <a href="" class="mt-8 inline-block bg-indigo-500 text-white font-bold py-3 px-8 rounded-lg hover:bg-indigo-600 transition duration-300">
            Pesan Sekarang
        </a>
    </div>
</div>
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Pilihan Venue Kami</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse($lapangans as $lapangan)
                <div class="bg-white rounded-lg shadow-md overflow-hidden group transform hover:-translate-y-2 transition-transform duration-300">
                    <a href="#">
                        <div class="h-48 overflow-hidden">
                             <img src="{{ $lapangan->gambar ? asset('images/' . $lapangan->gambar) : 'https://via.placeholder.com/400x300.png/E2E8F0/4A5568?text=Permata' }}"
                                 alt="Foto {{ $lapangan->nama }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-gray-800 truncate">{{ $lapangan->nama }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $lapangan->lokasi ?? 'Malang' }} • {{ $lapangan->jumlah ?? 1 }} Lapangan
                            </p>
                            <div class="mt-4">
                                <span class="text-sm text-gray-600">Harga mulai dari</span>
                                <p class="text-xl font-bold text-indigo-600">
                                    Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500">
                    Saat ini belum ada data lapangan yang tersedia.
                </p>
            @endforelse
            {{-- Akhir dari perulangan --}}

        </div>
        <div class="mt-20 py-16 bg-white rounded-2xl shadow-lg">
        <h3 class="text-3xl font-bold text-center text-gray-800 mb-10">Mengapa Memilih Permata Futsal?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center px-10">
            <div>
                <i class="fas fa-shield-alt text-4xl text-indigo-500 mb-3"></i>
                <h4 class="text-xl font-semibold">Fasilitas Terbaik</h4>
            <p class="text-gray-600 mt-1">Kamar ganti bersih, parkir luas, dan kantin yang nyaman.</p>
            </div>
            <div>
            <i class="fas fa-dollar-sign text-4xl text-indigo-500 mb-3"></i>
            <h4 class="text-xl font-semibold">Harga Terjangkau</h4>
            <p class="text-gray-600 mt-1">Dapatkan harga terbaik tanpa biaya tersembunyi.</p>
            </div>
            <div>
            <i class="fas fa-map-marked-alt text-4xl text-indigo-500 mb-3"></i>
            <h4 class="text-xl font-semibold">Lokasi Strategis</h4>
            <p class="text-gray-600 mt-1">Mudah diakses dari berbagai penjuru kota.</p>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection