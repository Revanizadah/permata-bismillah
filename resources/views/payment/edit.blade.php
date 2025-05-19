<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Pembayaran</h2>
    <form action="{{ route('pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">No Pesanan</label>
            <input type="text" name="no_pesanan" class="form-control" value="{{ $pembayaran->no_pesanan }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" class="form-control" value="{{ $pembayaran->nama_pemesan }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Metode Pembayaran</label>
            <input type="text" name="metode_pembayaran" class="form-control" value="{{ $pembayaran->metode_pembayaran }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Status Pembayaran</label>
            <input type="text" name="status_pembayaran" class="form-control" value="{{ $pembayaran->status_pembayaran }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jumlah Pembayaran</label>
            <input type="text" name="jumlah_pembayaran" class="form-control" value="{{ $pembayaran->jumlah_pembayaran }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control">
            @if($pembayaran->bukti_pembayaran)
                <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank">Lihat Bukti</a>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <input type="text" name="catatan" class="form-control" value="{{ $pembayaran->catatan }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pembayaran.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
