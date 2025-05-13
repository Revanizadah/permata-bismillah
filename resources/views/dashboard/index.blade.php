<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Online</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- Link your CSS file here -->
</head>
<body>

    <main>
        <div class="container">
            <section class="welcome-message">
                <h1>Selamat Datang di Permata Futsal dan Badminton</h1>
                <p>{{ Auth::user()->name }}</p>
            </section>

            <section class="choose-reservation">
                <h2>Pilih Reservasi</h2>
                <div class="reservation-options">
                    <!-- Futsal Section -->
                    <div class="reservation-option">
                        <a href="{{ route('reservasiFutsal') }}">
                            <img src="{{ asset('images/futsal.jpg') }}" alt="Futsal">
                            <p>Futsal</p>
                        </a>
                    </div>

                    <!-- Badminton Section -->
                    <div class="reservation-option">
                        <a href="{{ route('reservasiBadminton') }}">
                            <img src="{{ asset('images/badminton.jpg') }}" alt="Badminton">
                            <p>Badminton</p>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Reservasi Online. All rights reserved.</p>
    </footer>
</body>
</html>
