<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pembayaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Daftar Pembayaran</h2>
    <a href="{{ route('pembayaran.create') }}" class="btn btn-primary mb-3">Tambah Pembayaran</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>No Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Jumlah</th>
                <th>Bukti</th>
                <th>Catatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $pembayaran)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pembayaran->no_pesanan }}</td>
                <td>{{ $pembayaran->nama_pemesan }}</td>
                <td>{{ $pembayaran->metode_pembayaran }}</td>
                <td>{{ $pembayaran->status_pembayaran }}</td>
                <td>{{ $pembayaran->jumlah_pembayaran }}</td>
                <td>
                    @if($pembayaran->bukti_pembayaran)
                        <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank">Lihat</a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $pembayaran->catatan }}</td>
                <td>
                    <a href="{{ route('pembayaran.show', $pembayaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                    <a href="{{ route('pembayaran.edit', $pembayaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pembayaran.destroy', $pembayaran->id) }}" method="POST" style="display:inline-block">
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
