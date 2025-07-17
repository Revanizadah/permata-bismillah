<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Judul akan diambil dari setiap halaman, dengan judul default 'Permata' --}}
    <title>@yield('title') - {{ config('app.name', 'Permata') }}</title>
    
    {{-- Memuat Tailwind CSS & Font Awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
    <div class="w-full max-w-lg p-8 space-y-6 bg-white rounded-2xl shadow-xl text-center">
        
        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100">
            <i class="fas fa-envelope-open-text text-3xl text-yellow-500"></i>
        </div>

        <h2 class="text-3xl font-extrabold text-gray-900">Verifikasi Email Anda</h2>

        @if (session('resent'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-md" role="alert">
                <p class="font-bold">Link verifikasi baru telah dikirim ke alamat email Anda.</p>
            </div>
        @endif

        <p class="text-gray-600">
            Sebelum melanjutkan, silakan periksa email Anda untuk menemukan link verifikasi.
        </p>
        
        <form class="inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="font-bold text-indigo-600 hover:text-indigo-800 focus:outline-none">
                Tidak menerima email? Klik untuk kirim ulang.
            </button>
        </form>

    </div>
</div>
</body>
</html>