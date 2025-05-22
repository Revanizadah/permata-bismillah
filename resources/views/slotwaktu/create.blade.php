<!DOCTYPE html>
<html>
<head>
    <title>Tambah Slot Waktu</title>
</head>
<body>
<h1>Tambah Slot Waktu</h1>
<form action="{{ route('slotwaktu.store') }}" method="POST">
    @csrf
    <label>Nama lapangan:</label>
    <input type="text" name="nama_lapangan" required><br>
    <label>Tanggal:</label>
    <input type="date" name="tanggal" required><br>
    <label>Jam Mulai:</label>
    <input type="time" name="jam_mulai" required><br>
    <label>Jam Selesai:</label>
    <input type="time" name="jam_selesai" required><br>
    <button type="submit">Simpan</button>
</form>
</body>
</html>
