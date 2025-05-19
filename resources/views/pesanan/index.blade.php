<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Pesanan</h2>
    <a href="{{ route('pesanan.create') }}" class="btn btn-primary mb-3">Tambah Pesanan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pemesan</th>
                <th>Jenis Lapangan</th>
                <th>No HP</th>
                <th>Tanggal Pesan</th>
                <th>Jam Pesan</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Jumlah Jam</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pesanan->nama_pemesan }}</td>
                <td>{{ $pesanan->jenis_lapangan }}</td>
                <td>{{ $pesanan->no_hp }}</td>
                <td>{{ $pesanan->tanggal_pesan }}</td>
                <td>{{ $pesanan->jam_pesan }}</td>
                <td>{{ $pesanan->jam_mulai }}</td>
                <td>{{ $pesanan->jam_selesai }}</td>
                <td>{{ $pesanan->jumlah_jam }}</td>
                <td>{{ $pesanan->total_harga }}</td>
                <td>{{ $pesanan->status }}</td>
                <td>{{ $pesanan->catatan }}</td>
                <td>
                    <a href="{{ route('pesanan.show', $pesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
