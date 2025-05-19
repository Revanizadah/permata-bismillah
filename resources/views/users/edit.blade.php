@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pengguna</h2>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" value="{{ $user->nama }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
            <input type="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="no_hp">Nomor Handphone</label>
            <input type="tel" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" value="{{ $user->role }}" required>
        </div>
        <button type="submit">Update</button>
    </form>
    <a href="{{ route('users.index') }}">Kembali</a>
</div>
@endsection
