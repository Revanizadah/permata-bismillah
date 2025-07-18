@extends('layouts.app-user')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container mx-auto py-16 px-4 pt-28">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8">

        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Selesaikan Pembayaran Anda</h2>
            <p class="text-gray-500 mt-2">Satu langkah lagi untuk mengamankan jadwal Anda.</p>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-r-lg" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Detail Pesanan & Total Harga --}}
        <div class="bg-gray-50 p-6 rounded-lg mb-6 border border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Kode Pembayaran</p>
                    <p class="text-lg font-mono font-semibold text-gray-800">{{ $pembayaran->kode_pembayaran }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 text-right">Total yang harus dibayar</p>
                    <p class="text-3xl font-bold text-indigo-600">
                        Rp {{ number_format($pembayaran->pesanan->total_harga, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            <div class="text-xs text-center text-red-600 mt-4">
                Batas waktu pembayaran: <span class="font-bold">{{ \Carbon\Carbon::parse($pembayaran->expired_at)->isoFormat('dddd, D MMMM YYYY, HH:mm') }}</span>
            </div>
        </div>

        {{-- Rekening Tujuan --}}
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Rekening Tujuan Pembayaran</h3>
            <div class="border border-gray-200 rounded-lg p-4">
                <p class="font-medium text-gray-700">Bank Central Asia (BCA)</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">123 456 7890</p>
                <p class="text-sm text-gray-600 mt-1">a.n. PT Permata Futsal Sejahtera</p>
            </div>
            <div class="border border-gray-200 rounded-lg p-4 mt-3">
                <p class="font-medium text-gray-700">Bank Mandiri</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">098 765 4321</p>
                <p class="text-sm text-gray-600 mt-1">a.n. PT Permata Futsal Sejahtera</p>
            </div>
        </div>

        {{-- Form Upload Bukti Pembayaran --}}
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-3">Unggah Bukti Pembayaran</h3>
            <form action="{{ route('pembayaran.upload', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-500 transition">
                    <label for="bukti_pembayaran" class="cursor-pointer">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                        <p class="mt-2 text-sm text-gray-600">
                            <span class="font-semibold text-indigo-600">Klik untuk memilih file</span> atau seret file ke sini.
                        </p>
                        <p class="text-xs text-gray-500 mt-1">PNG, JPG, atau PDF (Maks. 2MB)</p>
                    </label>
                    <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only" required>
                </div>
                @error('bukti_pembayaran')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <div class="mt-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 font-bold text-lg transition">
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection