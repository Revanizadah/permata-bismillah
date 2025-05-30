<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Pembayaran</h2>
    <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">No Pesanan</label>
            <input type="text" name="no_pesanan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_pembayaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Pembayaran</label>
            <input type="text" name="jumlah_pembayaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <input type="text" name="status_pembayaran" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <input type="text" name="catatan" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Batas Waktu Pembayaran</label>
            <input type="datetime-local" name="batas_waktu_pembayaran" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
