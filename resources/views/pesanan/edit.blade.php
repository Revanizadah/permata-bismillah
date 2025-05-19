<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Pesanan</h2>
    <form action="{{ route('pesanan.update', $pesanan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control" value="{{ $pesanan->nama_pemesan }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Lapangan</label>
            <input type="text" name="jenis_lapangan" class="form-control" value="{{ $pesanan->jenis_lapangan }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pesanan->no_hp }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" class="form-control" value="{{ $pesanan->tanggal_pesan }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" value="{{ $pesanan->jam_mulai }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" value="{{ $pesanan->jam_selesai }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Jam</label>
            <input type="number" name="jumlah_jam" class="form-control" value="{{ $pesanan->jumlah_jam }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Total Harga</label>
            <input type="number" name="total_harga" class="form-control" value="{{ $pesanan->total_harga }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text" name="status" class="form-control" value="{{ $pesanan->status }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <input type="text" name="catatan" class="form-control" value="{{ $pesanan->catatan }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pesanan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
