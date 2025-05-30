<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Pesanan</h2>
    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Jam</label>
            <input type="number" name="jumlah_jam" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <input type="number" name="total_harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="pending" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <input type="text" name="catatan" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Batas Waktu</label>
            <input type="datetime-local" name="batas_waktu" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
