@extends('layouts.app') {{-- Ganti dengan layout polos Anda jika perlu --}}
@section('title', 'Verifikasi Email')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-lg p-8 space-y-6 bg-white rounded-2xl shadow-xl text-center">
        
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100">
            <i class="fas fa-envelope-open-text text-3xl text-yellow-500"></i>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-900">
            Verifikasi Alamat Email Anda
        </h2>

        @if (session('resent'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p class="font-bold">Link verifikasi baru telah dikirim ke alamat email Anda.</p>
            </div>
        @endif

        <p class="text-gray-600">
            Sebelum melanjutkan, silakan periksa email Anda untuk menemukan link verifikasi. Jika Anda tidak menerima email,
        </p>
        
        <form class="inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="font-bold text-indigo-600 hover:text-indigo-800 focus:outline-none">
                klik di sini untuk meminta lagi
            </button>.
        </form>
    </div>
</div>
@endsection