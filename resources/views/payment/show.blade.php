<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Detail Pembayaran</h2>
    <ul class="list-group">
        <li class="list-group-item"><strong>No Pesanan:</strong> {{ $pembayaran->no_pesanan }}</li>
        <li class="list-group-item"><strong>Tanggal Pembayaran:</strong> {{ $pembayaran->tanggal_pembayaran }}</li>
        <li class="list-group-item"><strong>Jumlah Pembayaran:</strong> {{ $pembayaran->jumlah_pembayaran }}</li>
        <li class="list-group-item"><strong>Metode Pembayaran:</strong> {{ $pembayaran->metode_pembayaran }}</li>
        <li class="list-group-item"><strong>Bukti Pembayaran:</strong>
            @if($pembayaran->bukti_pembayaran)
                <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
            @else
                -
            @endif
        </li>
        <li class="list-group-item"><strong>Status Pembayaran:</strong> {{ $pembayaran->status_pembayaran }}</li>
        <li class="list-group-item"><strong>Catatan:</strong> {{ $pembayaran->catatan }}</li>
        <li class="list-group-item"><strong>Batas Waktu Pembayaran:</strong>
            {{ $pembayaran->batas_waktu_pembayaran ? $pembayaran->batas_waktu_pembayaran->format('d-m-Y H:i') : '-' }}
        </li>
    </ul>
    <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</body>
</html>
