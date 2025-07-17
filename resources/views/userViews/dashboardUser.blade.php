@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl p-8 space-y-6 bg-white rounded-2xl shadow-xl text-center">
        
        <h1 class="text-4xl font-bold text-gray-900">
            Selamat Datang, <span class="text-indigo-600">{{ $user->nama }}</span>!
        </h1>

        <p class="text-lg text-gray-600">
            Akun Anda telah berhasil dibuat dan diverifikasi.
        </p>

        <p class="text-gray-500">
            Ini adalah halaman dashboard sementara untuk pengguna. Anda bisa mulai memesan lapangan sekarang.
        </p>

        <div class="pt-6">
            <a href="#" class="px-8 py-3 font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700">
                Mulai Pesan Lapangan
            </a>
        </div>
        
        {{-- Tombol Logout --}}
        <div class="pt-4">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-600">
                    Keluar (Logout)
                </button>
            </form>
        </div>

    </div>
</div>
@endsection