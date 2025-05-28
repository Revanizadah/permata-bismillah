@extends('layouts.app')

@section('title', 'Pembayaran Admin')

@section('content')
<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Slot Waktu</h2>

            <!-- Button to add a new slot -->
            <div class="text-center mb-6">
                <button class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200">Tambah Slot</button>
            </div>

            <!-- Table for displaying slot times -->
            <table class="min-w-full table-auto border-collapse border border-gray-300" id="slotTable">
                <thead>
                    <tr class="bg-blue-200 text-black">
                        <th class="px-6 py-4 border-b">Nama Lapangan</th>
                        <th class="px-6 py-4 border-b">Tanggal</th>
                        <th class="px-6 py-4 border-b">Jam Mulai</th>
                        <th class="px-6 py-4 border-b">Jam Selesai</th>
                        <th class="px-6 py-4 border-b">status</th>
                        <th class="px-6 py-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slotWaktus as $slot)
                <tr>
                    <tr class="text-center">
                    <td>{{ $slot->nama_lapangan }}</td>
                    <td>{{ $slot->tanggal }}</td>
                    <td>{{ $slot->jam_mulai }}</td>
                    <td>{{ $slot->jam_selesai }}</td>
                    <td>{{ $slot->status }}</td>
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
                </tbody>
            </table>
    </div>
@endsection