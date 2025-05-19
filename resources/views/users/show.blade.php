{{-- @extends('layouts.app')

@section('content') --}}

{{-- @endsection --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <h2>Detail Pengguna</h2>
    <ul>
        <li><strong>Nama:</strong> {{ $user->nama }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>No HP:</strong> {{ $user->no_hp }}</li>
        <li><strong>Role:</strong> {{ $user->role }}</li>
    </ul>
    <a href="{{ route('users.index') }}">Kembali</a>
</div>

</body>
</html>
