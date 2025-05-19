<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Lapangan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Reservasi Lapangan</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                {{-- @auth --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('lapangan.index') }}">Lapangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('order.index') }}">Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payment.index') }}">Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                {{-- @endauth --}}
            </ul>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
