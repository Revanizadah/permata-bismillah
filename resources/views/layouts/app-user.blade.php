<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Permata Futsal')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    {{-- Navbar akan selalu berada di atas --}}
    <x-navbar />

    {{-- KONTEN UTAMA HALAMAN --}}
    {{-- PERUBAHAN: Tidak ada lagi div "flex", hanya main content biasa --}}
    <main>
        {{-- @yield('content-user') diubah menjadi @yield('content') agar konsisten --}}
        @yield('content')
    </main>

    {{-- Footer akan selalu berada di bawah --}}
    <x-footer />

    @stack('scripts')
</body>
</html>