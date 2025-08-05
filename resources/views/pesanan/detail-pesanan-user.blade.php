@extends('layouts.app-user')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container mx-auto py-16 px-4 pt-28">
    <div class="max-w-4xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-8">
            <a href="{{ route('user.riwayat.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                &larr; Kembali ke Riwayat Pesanan
            </a>
            <h2 class="text-4xl font-extrabold text-gray-900 mt-2">Detail Pesanan</h2>
            <p class="mt-1 text-sm text-gray-600">Kode Pembayaran: 
                <span class="font-semibold font-mono">{{ $pesanan->pembayaran->kode_pembayaran }}</span>
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            
            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Jadwal</h3>
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 flex items-center space-x-4">
                    <img class="h-24 w-24 rounded-lg object-cover" src="{{ $pesanan->lapangan->gambar ? asset('storage/images/lapangan/' . $pesanan->lapangan->gambar) : 'https://via.placeholder.com/150' }}" alt="Foto Lapangan">
                    <div>
                        <p class="font-bold text-lg text-gray-900">{{ $pesanan->lapangan->nama }}</p>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->isoFormat('dddd, D MMMM YYYY') }}</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($pesanan->detailPemesanan as $detail)
                                <span class="bg-gray-200 rounded-full px-2 py-1 text-xs font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($detail->slotWaktu->jam_mulai)->format('H:i') }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Rincian Biaya</h3>
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 space-y-4">
                    <div class="flex justify-between items-center text-gray-700">
                        <span>Harga Sewa ({{ $pesanan->detailPemesanan->count() }} jam)</span>
                        <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 my-2"></div>
                    <div class="flex justify-between items-center font-bold text-gray-900">
                        <span>Total Pembayaran</span>
                        <span class="text-indigo-600 text-xl">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Status</h3>
                <div class="p-4 rounded-lg 
                    {{ $pesanan->pembayaran->status_pembayaran == 'paid' ? 'bg-green-50 text-green-800' : '' }}
                    {{ $pesanan->pembayaran->status_pembayaran == 'unpaid' ? 'bg-yellow-50 text-yellow-800' : '' }}
                    {{ $pesanan->pembayaran->status_pembayaran == 'rejected' ? 'bg-orange-50 text-orange-800' : '' }}
                    {{ $pesanan->pembayaran->status_pembayaran == 'pending' ? 'bg-blue-50 text-blue-800' : '' }}
                    {{ $pesanan->pembayaran->status_pembayaran == 'expired' ? 'bg-red-50 text-red-800' : '' }}">
                    
                    <p class="font-bold">Status Pembayaran: {{ ucfirst(str_replace('_', ' ', $pesanan->pembayaran->status_pembayaran)) }}</p>

                    @if($pesanan->pembayaran->status_pembayaran == 'pending')
                        <p class="text-sm mt-1">Bukti pembayaran Anda sedang kami verifikasi. Mohon tunggu.</p>
                    @endif
                </div>
            </div>

            {{-- TOMBOL AKSI KONDISIONAL --}}
            <div class="pt-6 border-t border-gray-200 text-center">
                @if (in_array($pesanan->pembayaran->status_pembayaran, ['unpaid', 'rejected']) && now()->lessThan($pesanan->pembayaran->expired_at))
                    @if ($pesanan->pembayaran->status_pembayaran == 'rejected')
                        <p class="text-sm text-red-600 mb-4">Pembayaran Anda sebelumnya ditolak. Silakan unggah bukti baru.</p>
                    @endif
                    <a href="{{ route('user.pembayaran.show', $pesanan->pembayaran->id) }}" class="w-full md:w-auto inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 font-bold text-lg transition">
                        Lanjutkan Pembayaran
                    </a>
                @elseif($pesanan->pembayaran->status_pembayaran == 'pending')
                    <p class="text-blue-600 font-medium py-3">Menunggu konfirmasi dari Admin.</p>
                @elseif($pesanan->status == 'confirmed')
                    <p class="text-green-600 font-medium py-3">Pesanan Dikonfirmasi. Sampai jumpa di lapangan!</p>
                @else
                    <p class="text-red-600 font-medium py-3">Pesanan ini telah dibatalkan atau kedaluwarsa.</p>
                @endif
                
                @if ($pesanan->status == 'pending')
                    <form action="{{ route('user.riwayat.cancel', $pesanan->id) }}" method="POST" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" class="text-sm text-gray-500 hover:text-red-600 hover:underline">
                            Batalkan Pesanan
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection