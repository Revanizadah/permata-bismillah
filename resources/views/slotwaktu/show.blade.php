<!DOCTYPE html>
<html>
<head>
    <title>Detail Slot Waktu</title>
</head>
<body>
<h1>Detail Slot Waktu</h1>
<table border="1">
    <tr><th>Nama Lapangan</th><td>{{ $slotwaktu->nama_lapangan }}</td></tr>
    <tr><th>Tanggal</th><td>{{ $slotwaktu->tanggal }}</td></tr>
    <tr><th>Jam Mulai</th><td>{{ $slotwaktu->jam_mulai }}</td></tr>
    <tr><th>Jam Selesai</th><td>{{ $slotwaktu->jam_selesai }}</td></tr>
</table>
<a href="{{ route('slotwaktu.index') }}">Kembali ke Daftar</a>
</body>
</html>
