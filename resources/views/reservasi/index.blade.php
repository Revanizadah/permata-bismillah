<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Online</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- You can link your CSS file here -->
</head>
<body>
    <header>
        <div class="navbar">
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="{{ route('reservasi') }}">Pesanan</a></li>
                    <li><a href="{{ route('profile') }}">Profile</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
            <section class="reservation">
                <h2>Pesanan Anda</h2>
                <table class="reservation-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lapangan</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Reservasi Online. All rights reserved.</p>
    </footer>
</body>
</html>
