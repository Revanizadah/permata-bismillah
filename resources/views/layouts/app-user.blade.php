<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- Judul akan diambil dari setiap halaman, dengan judul default --}}
    <title>@yield('title', 'Permata Futsal')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    {{-- Link ke Font Awesome jika diperlukan --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">

    {{-- Memanggil komponen navbar --}}
    <x-navbar />

    {{-- Konten utama dari setiap halaman akan ditampilkan di sini --}}
    <main>
        @yield('content')
    </main>

    {{-- Tempat untuk script khusus per halaman (jika ada) --}}
    @stack('scripts')
</body>
</html>