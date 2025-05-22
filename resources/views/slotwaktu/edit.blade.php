<!DOCTYPE html>
<html>
<head>
    <title>Edit Slot Waktu</title>
</head>
<body>
<h1>Edit Slot Waktu</h1>
<form action="{{ route('slotwaktu.update', $slotwaktu->id) }}" method="POST">
    @csrf @method('PUT')
    <label>Nama lapangan:</label>
    <input type="text" name="nama_lapangan" value="{{ $slotwaktu->nama_lapangan }}" required><br>
    <label>Tanggal:</label>
    <input type="date" name="tanggal" value="{{ $slotwaktu->tanggal }}" required><br>
    <label>Jam Mulai:</label>
    <input type="time" name="jam_mulai" value="{{ $slotwaktu->jam_mulai }}" required><br>
    <label>Jam Selesai:</label>
    <input type="time" name="jam_selesai" value="{{ $slotwaktu->jam_selesai }}" required><br>
    <button type="submit">Update</button>
</form>
</body>
</html>
