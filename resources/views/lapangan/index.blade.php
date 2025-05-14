<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>
    <h1>Users List</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama Lapangan</th>
                <th>harga perjam</th>
                <th>jenis lapangan</th>
                <th>status</th>
                <th>deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lapangans as $lapangan)
                <tr>
                    <td>{{ $lapangan->id }}</td>
                    <td>{{ $lapangan->nama_lapangan }}</td>
                    <td>{{ $lapangan->harga_per_jam }}</td>
                    <td>{{ $lapangan->jenis_lapangan }}</td>
                    <td>{{ $lapangan->status }}</td>
                    <td>{{ $lapangan->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>