@extends('layouts.app-user')

@section('title', 'Pilihan Venue Kami')

@section('content')
<div class="container mx-auto py-16 px-4">
    {{-- Anda perlu padding atas di sini untuk memberi ruang bagi navbar fixed Anda --}}
    <div class="pt-20">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Pilihan Venue Kami</h2>

        {{-- ========================================================== --}}
        {{--         PERBAIKAN UTAMA ADA DI PEMBUNGKUS INI          --}}
        {{-- ========================================================== --}}
        {{-- Div ini bertugas mengatur layout dan jarak antar kartu --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($lapangans as $lapangan)
                <div class="bg-white rounded-lg shadow-md overflow-hidden group transform hover:-translate-y-2 transition-transform duration-300">
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
    </div>
</div>
@endsection