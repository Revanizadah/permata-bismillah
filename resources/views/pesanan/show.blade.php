<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Detail Pesanan</h2>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nama Pemesan:</strong> {{ $pesanan->nama_pemesan }}</li>
        <li class="list-group-item"><strong>Jenis Lapangan:</strong> {{ $pesanan->jenis_lapangan }}</li>
        <li class="list-group-item"><strong>Tanggal Pesan:</strong> {{ $pesanan->tanggal_pesan }}</li>
        <li class="list-group-item"><strong>Jam Pesan:</strong> {{ $pesanan->jam_pesan }}</li>
        <li class="list-group-item"><strong>Jam Mulai:</strong> {{ $pesanan->jam_mulai }}</li>
        <li class="list-group-item"><strong>Jam Selesai:</strong> {{ $pesanan->jam_selesai }}</li>
        <li class="list-group-item"><strong>Jumlah Jam:</strong> {{ $pesanan->jumlah_jam }}</li>
        <li class="list-group-item"><strong>Total Harga:</strong> {{ $pesanan->total_harga }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $pesanan->status }}</li>
        <li class="list-group-item"><strong>Catatan:</strong> {{ $pesanan->catatan }}</li>
        <li class="list-group-item"><strong>Batas Waktu:</strong> {{ $pesanan->batas_waktu ? $pesanan->batas_waktu->format('d-m-Y H:i') : '-' }}</li>
    </ul>
    <a href="{{ route('pesanan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
</body>
</html>
