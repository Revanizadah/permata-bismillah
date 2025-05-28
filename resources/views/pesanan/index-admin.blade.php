@extends('layouts.app')

@section('title', 'Pembayaran Admin')

@section('content')
    <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Pesanan</h2>

            <div class="text-center mb-6">
                <a href="{{ route('pesanan.create') }}" class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200 inline-block">Tambah Pesanan</a>
            </div>

            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-blue-200 text-gray-800">
                        <th class="px-6 py-4 border-b">No</th>
                        <th class="px-6 py-4 border-b">Nama Pemesan</th>
                        <th class="px-6 py-4 border-b">Jenis Lapangan</th>
                        <th class="px-6 py-4 border-b">No HP</th>
                        <th class="px-6 py-4 border-b">Tanggal</th>
                        <th class="px-6 py-4 border-b">Jam Mulai</th>
                        <th class="px-6 py-4 border-b">Jam Selesai</th>
                        <th class="px-6 py-4 border-b">Jumlah Jam</th>
                        <th class="px-6 py-4 border-b">Total Harga</th>
                        <th class="px-6 py-4 border-b">Status</th>
                        <th class="px-6 py-4 border-b">Catatan</th>
                        <th class="px-6 py-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pesanans as $pesanan)
                    <tr class="text-center">
                        <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->nama_pemesan }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->jenis_lapangan }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->no_hp }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->tanggal_pesan }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->jam_mulai }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->jam_selesai }}</td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->jumlah_jam }}</td>
                        <td class="px-4 py-2 border-b">Rp {{ number_format($pesanan->total_harga,0,',','.') }}</td>
                        <td class="px-4 py-2 border-b">
                            <span class="px-2 py-1 rounded 
                                @if($pesanan->status == 'Pending') bg-yellow-200 text-yellow-800
                                @elseif($pesanan->status == 'Sukses') bg-green-200 text-green-800
                                @elseif($pesanan->status == 'Ditolak') bg-red-200 text-red-800
                                @else bg-gray-200 text-gray-800
                                @endif">
                                {{ $pesanan->status }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border-b">{{ $pesanan->catatan ?? '-' }}</td>
                        <td class="px-4 py-2 border-b space-x-1">
                            <form action="{{ route('pesanan.updateStatus', [$pesanan->id, 'status' => 'Sukses']) }}" method="POST" class="inline-block" style="display:inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600"
                                    @if($pesanan->status == 'Sukses') disabled class="opacity-50 cursor-not-allowed" @endif>
                                    Terima
                                </button>
                            </form>
                            <form action="{{ route('pesanan.updateStatus', [$pesanan->id, 'status' => 'Ditolak']) }}" method="POST" class="inline-block" style="display:inline-block">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600"
                                    @if($pesanan->status == 'Ditolak') disabled class="opacity-50 cursor-not-allowed" @endif>
                                    Ditolak
                                </button>
                            </form>
                            <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-gray-500 text-white px-2 py-1 rounded text-xs hover:bg-gray-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection