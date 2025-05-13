<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Bootstrap -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('lapangan.index') }}">
                                <i class="fas fa-box-open"></i> Manajemen Pesanan
                            </a>
                        </li>

                        @auth
                            @if(auth()->user()->role == 'penyewa') <!-- Sidebar for Penyewa Lapangan -->
                                <!-- Lapangan Dropdown -->
                                <li class="nav-item">
                                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#lapanganDropdown" aria-expanded="false" aria-controls="lapanganDropdown">
                                        <i class="fas fa-calendar-check"></i> Lapangan
                                    </a>
                                    <div class="collapse" id="lapanganDropdown">
                                        <ul class="nav flex-column ms-3">
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('lapangan.futsal') }}">
                                                    <i class="fas fa-futbol"></i> Futsal
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('lapangan.badminton') }}">
                                                    <i class="fas fa-shuttlecock"></i> Badminton
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <!-- Laporan -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/laporan') }}">
                                        <i class="fas fa-history"></i> Laporan
                                    </a>
                                </li>
                            @endif
                        @endauth

                        <!-- Logout -->
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="nav-link text-danger btn btn-link">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
