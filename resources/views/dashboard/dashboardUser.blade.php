@extends('layouts.app-user')

@section('title', 'Pilihan Venue Kami')

@section('content')
<div class="w-full max-w-screen-xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="pt-20">

        {{-- Hero Section --}}
        <div class="relative bg-gray-800 rounded-2xl shadow-xl overflow-hidden mb-16">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="{{ asset('images/hero.jpg') }}" alt="Background Futsal">
                <div class="absolute inset-0 bg-gray-900 opacity-70"></div>
            </div>
            <div class="relative max-w-4xl mx-auto px-6 py-24 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white">Temukan & Pesan Lapangan Terbaik</h1>
                <p class="mt-4 text-lg text-gray-200">Booking lapangan Futsal & Badminton favorit Anda hanya dengan beberapa klik.</p>
                {{-- PERUBAHAN WARNA: Tombol utama menjadi oranye --}}
                <a href="{{ route('user.pesanan.create') }}" class="mt-8 inline-block bg-red-800 text-white font-bold py-3 px-8 rounded-lg hover:bg-red-600 transition duration-300">
                    Pesan Sekarang
                </a>
            </div>
        </div>

        {{-- <div class="mb-16">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Venue Terpopuler</h2>
            <p class="text-center text-gray-500 mb-10">Pilihan favorit pelanggan kami.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-8">
                @forelse($lapanganPopuler as $lapangan)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group transform hover:-translate-y-2 transition-transform duration-300 relative">
                        <div class="absolute top-0 left-0 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-br-lg z-10">
                            <i class="fas fa-star text-yellow-300"></i> Populer
                        </div>
                        <a href="#">
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $lapangan->gambar_url ?? 'https://via.placeholder.com/400x300.png/E2E8F0/4A5568?text=Permata' }}" 
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
                                    <p class="text-xl font-bold text-orange-600">
                                        Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                @endforelse
            </div>
        </div> --}}

        <div>
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Semua Pilihan Venue</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($lapangans as $lapangan)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden group transform hover:-translate-y-2 transition-transform duration-300">
                        <a href="#">
                            <div class="h-48 overflow-hidden">
                                <img src="{{ $lapangan->gambar ? asset('storage/images/lapangan/' . $lapangan->gambar) : 'https://via.placeholder.com/400x300.png/E2E8F0/4A5568?text=Permata' }}"
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
                                    <p class="text-xl font-bold text-green-600">
                                        {{-- PERUBAHAN WARNA: Harga menjadi oranye --}}
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
            </div>
        </div>

        {{-- Mengapa Memilih Kami? --}}
        <div class="mt-20 py-16 bg-red-700 rounded-2xl shadow-lg">
            <h3 class="text-3xl font-bold text-center text-white mb-10">Mengapa Memilih Permata Futsal?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center px-10">
                <div>
                    <i class="fas fa-shield-alt text-4xl text-white mb-3"></i>
                    <h4 class="text-xl text-gray-300 font-semibold">Fasilitas Terbaik</h4>
                    <p class="text-white mt-1">Kamar ganti bersih, parkir luas, dan kantin yang nyaman.</p>
                </div>
                <div>
                    <i class="fas fa-dollar-sign text-4xl text-white mb-3"></i>
                    <h4 class="text-xl text-gray-300 font-semibold">Harga Terjangkau</h4>
                    <p class="text-white mt-1">Dapatkan harga terbaik tanpa biaya tersembunyi.</p>
                </div>
                <div>
                    <i class="fas fa-map-marked-alt text-4xl text-white mb-3"></i>
                    <h4 class="text-xl text-gray-300 font-semibold">Lokasi Strategis</h4>
                    <p class="text-white mt-1">Mudah diakses dari berbagai penjuru kota.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection