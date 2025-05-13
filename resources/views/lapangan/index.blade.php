<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Admin - Futsal</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Add your CSS file link here -->
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Permata Futsal & Badminton">
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Manajemen</a></li>
                    <li><a href="{{ route('lapangan.futsal') }}" class="active">Lapangan</a></li>
                    <li><a href="{{ route('lapangan.badminton') }}">Badminton</a></li>
                    <li><a href="{{ route('admin.report') }}">Laporan</a></li>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <section class="reservation-management">
                <h1>Pemesanan Lapangan Futsal</h1>

                <!-- Date and Court Selection -->
                <div class="court-selection">
                    <h2>Lapangan Futsal</h2>
                    <select name="tanggal" id="tanggal" class="form-control">
                        <option value="">Pilih Tanggal</option>
                        <!-- Dynamic date options (you can populate from your backend) -->
                        <option value="2025-01-01">01-01-2025</option>
                        <option value="2025-01-02">02-01-2025</option>
                        <option value="2025-01-03">03-01-2025</option>
                    </select>
                </div>

                <!-- Court Selection with Availability Status -->
                <div class="court-options">
                    <button class="court-btn available">Lapangan 1 Sintetis</button>
                    <button class="court-btn unavailable">Lapangan 2 Multicourt</button>
                </div>

                <!-- Time Slot Availability -->
                <div class="time-slots">
                    <h3>Jam</h3>
                    <div class="time-slot-grid">
                        <!-- Available slots: Create a grid of buttons for time slots -->
                        @foreach (range(7, 22) as $hour)
                            <div class="time-slot">
                                <button class="slot-btn {{ $hour == 8 ? 'unavailable' : 'available' }}" data-time="{{ sprintf('%02d', $hour) }}:00">
                                    {{ sprintf('%02d', $hour) }}:00
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Simpan Pesanan button -->
                <div class="off-btn">
                    <button class="btn-off">Simpan Pesanan</button>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
