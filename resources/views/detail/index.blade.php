<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <main>
        <div class="container">
            <section class="payment-detail">
                <h1>Detail Pembayaran</h1>

                <table class="payment-details-table">
                    <tr>
                        <th>User ID</th>
                        <td>{{ $payment->user_id }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Lapangan</th>
                        <td>{{ $payment->jenis_lapangan }}</td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>{{ $payment->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Pesanan ID</th>
                        <td>{{ $payment->pesanan_id }}</td>
                    </tr>
                    <tr>
                        <th>Bukti Pembayaran</th>
                        <td>
                            @if($payment->bukti_pembayaran)
                                <a href="{{ asset('storage/' . $payment->bukti_pembayaran) }}" target="_blank">Lihat Bukti Pembayaran</a>
                            @else
                                Belum ada bukti pembayaran
                            @endif
                        </td>
                    </tr>
                </table>

                <a href="{{ route('admin.dashboard') }}" class="btn-back">Kembali ke Dashboard</a>
            </section>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Reservasi Online. All rights reserved.</p>
    </footer>
</body>
</html>
