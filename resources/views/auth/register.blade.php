<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name', 'Permata') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center min-h-screen py-12">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-xl">
        
        {{-- Header Form --}}
        <div class="text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto mb-4 w-20 h-20">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Buat Akun Baru
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Silakan isi data diri Anda untuk memulai.
            </p>
        </div>

        {{-- Form Registrasi --}}
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            
            {{-- Input Nama --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <div class="mt-1">
                    <input type="text" id="nama" name="nama" required value="{{ old('nama') }}"
                           class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                           placeholder="Nama Anda">
                    @error('nama')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Input Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                           class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                           placeholder="anda@email.com">
                    @error('email')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Input Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input type="password" id="password" name="password" required 
                           class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                           placeholder="********">
                    @error('password')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- Input Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <div class="mt-1">
                    <input type="password" id="password_confirmation" name="password_confirmation" required 
                           class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                           placeholder="********">
                </div>
            </div>

            {{-- Tombol Register --}}
            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform transform hover:scale-105">
                    Daftar
                </button>
            </div>
            
            {{-- Link ke Halaman Login --}}
            <div class="text-sm text-center">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

</body>
</html>