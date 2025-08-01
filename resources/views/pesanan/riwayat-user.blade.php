@extends('layouts.app-user')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
<div class="container mx-auto py-16 px-4 pt-28">
    <div class="max-w-4xl mx-auto">

        {{-- HEADER --}}
        <div class="text-center mb-10">
            <h2 class="text-4xl font-extrabold text-gray-900">Riwayat Pesanan Anda</h2>
            <p class="mt-2 text-sm text-gray-600">Lacak semua aktivitas pemesanan Anda di sini.</p>
        </div>

        {{-- DAFTAR KARTU PESANAN --}}
        <div class="space-y-6">
            @forelse($pesanans as $pesanan)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition hover:shadow-xl">
                    <div class="p-6 md:flex md:items-center md:justify-between">
                        {{-- Detail Lapangan dan Tanggal --}}
                        <div class="md:flex md:items-center">
                            <div class="md:flex-shrink-0">
                                <img class="h-20 w-20 rounded-lg object-cover" src="{{ $pesanan->lapangan->gambar ? asset('images/' . $pesanan->lapangan->gambar) : 'https://via.placeholder.com/150' }}" alt="Foto {{ $pesanan->lapangan->nama }}">
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6">
                                <p class="text-xl font-bold text-gray-900">{{ $pesanan->lapangan->nama ?? 'Lapangan Dihapus' }}</p>
                                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->isoFormat('dddd, D MMMM YYYY') }}</p>
                            </div>
                        </div>

                        {{-- Status dan Harga --}}
                        <div class="mt-5 md:mt-0 flex items-center justify-between">
                            <div class="text-center md:text-right space-y-2">
                                <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                                
                                <div>
                                    {{-- Badge Status Pesanan --}}
                                    <span class="px-3 py-1 font-semibold text-xs leading-tight rounded-full
                                        {{ $pesanan->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $pesanan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $pesanan->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($pesanan->status) }}
                                    </span>
                                    
                                    {{-- =============================================== --}}
                                    {{--     ✅ PENAMBAHAN STATUS PEMBAYARAN DI SINI      --}}
                                    {{-- =============================================== --}}
                                    <span class="px-3 py-1 font-semibold text-xs leading-tight rounded-full
                                        {{ $pesanan->pembayaran->status_pembayaran == 'paid' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $pesanan->pembayaran->status_pembayaran == 'unpaid' ? 'bg-orange-100 text-orange-800' : '' }}
                                        {{ $pesanan->pembayaran->status_pembayaran == 'pending' ? 'bg-red-50 text-yellow-800' : '' }}
                                        {{ $pesanan->pembayaran->status_pembayaran == 'expired' ? 'bg-gray-100 text-gray-800' : '' }}">
                                        {{ ucfirst($pesanan->pembayaran->status_pembayaran ?? 'N/A') }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('user.riwayat.show', $pesanan->id) }}" class="ml-6 text-indigo-600 hover:text-indigo-900 font-bold whitespace-nowrap">
                                Detail &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white p-12 rounded-2xl shadow-md text-center border-2 border-dashed">
                    <i class="fas fa-file-alt text-5xl text-gray-400 mb-4"></i>
                    <p class="text-lg font-medium text-gray-700">Anda belum memiliki riwayat pesanan.</p>
                    <p class="text-sm text-gray-500 mt-1">Mari mulai pesan lapangan pertama Anda!</p>
                    <a href="{{ route('user.pesanan.create') }}" class="mt-6 inline-block bg-indigo-500 text-white font-bold py-2 px-5 rounded-lg hover:bg-indigo-600 transition">
                        Pesan Sekarang
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Link Paginasi --}}
        <div class="mt-10">
            {{ $pesanans->links() }}
        </div>

    </div>
</div>
@endsection