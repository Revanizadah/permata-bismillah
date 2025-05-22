<!DOCTYPE html>
<html>
<head>
    <title>Daftar Slot Waktu</title>
</head>
<body>
<h1>Daftar Slot Waktu</h1>
<a href="{{ route('slotwaktu.create') }}">Tambah Slot Waktu</a>
@if(session('success'))
    <div>{{ session('success') }}</div>
@endif
<table border="1">
    <tr>
        <th>Nama Lapangan</th>
        <th>Tanggal</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Aksi</th>
    </tr>
    @foreach($slotWaktus as $slot)
    <tr>
        <td>{{ $slot->nama_lapangan }}</td>
        <td>{{ $slot->tanggal }}</td>
        <td>{{ $slot->jam_mulai }}</td>
        <td>{{ $slot->jam_selesai }}</td>
        <td>
            <a href="{{ route('slotwaktu.show', $slot->id) }}">Detail</a> |
            <a href="{{ route('slotwaktu.edit', $slot->id) }}">Edit</a>
            <form action="{{ route('slotwaktu.destroy', $slot->id) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>
