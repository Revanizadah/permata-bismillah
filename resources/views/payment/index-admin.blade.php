@extends('layouts.app')

@section('title', 'Pembayaran Admin')

@section('content')
<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Pembayaran</h2>

    <div class="text-center mb-6">
        <a href="{{ route('pembayaran.create') }}" class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200 inline-block">Tambah Pembayaran</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-center">
            <thead>
                <tr class="bg-blue-200 text-gray-800">
                    <th class="px-4 py-3 border-b border-r">No</th>
                    <th class="px-4 py-3 border-b border-r">Nomor Pesanan</th>
                    <th class="px-4 py-3 border-b border-r">Nama Pemesan</th>
                    <th class="px-4 py-3 border-b border-r">Metode Pembayaran</th>
                    <th class="px-4 py-3 border-b border-r">Status</th>
                    <th class="px-4 py-3 border-b border-r">Jumlah</th>
                    <th class="px-4 py-3 border-b border-r">Bukti</th>
                    <th class="px-4 py-3 border-b border-r">Catatan</th>
                    <th class="px-4 py-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($pembayarans as $pembayaran)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b border-r">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 border-b border-r">{{ $pembayaran->no_pesanan }}</td>
                    <td class="px-4 py-2 border-b border-r">{{ $pembayaran->nama_pemesan }}</td>
                    <td class="px-4 py-2 border-b border-r">{{ $pembayaran->metode_pembayaran }}</td>
                    <td class="px-4 py-2 border-b border-r">
                        <span class="inline-block px-2 py-1 rounded
                            @if($pembayaran->status_pembayaran == 'Sukses') bg-green-200 text-green-800 
                            @elseif($pembayaran->status_pembayaran == 'Pending') bg-yellow-200 text-yellow-800 
                            @elseif($pembayaran->status_pembayaran == 'Ditolak') bg-red-200 text-red-800 
                            @else bg-gray-200 text-gray-800 @endif">
                            {{ $pembayaran->status_pembayaran }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b border-r">Rp{{ number_format($pembayaran->jumlah_pembayaran, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 border-b border-r">
                        @if($pembayaran->bukti_pembayaran)
                            <a href="{{ asset('storage/'.$pembayaran->bukti_pembayaran) }}" target="_blank" class="text-blue-600 underline">Lihat</a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-b border-r">{{ $pembayaran->catatan }}</td>
                    <td class="px-4 py-2 border-b space-x-1">
                        <form action="{{ route('pembayaran.updateStatus', [$pembayaran->id, 'status' => 'Sukses']) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-block bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-1 rounded transition"
                                @if($pembayaran->status_pembayaran == 'Sukses') disabled class="opacity-50 cursor-not-allowed" @endif
                            >Terima</button>
                        </form>
                        <form action="{{ route('pembayaran.updateStatus', [$pembayaran->id, 'status' => 'Ditolak']) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-block bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition"
                                @if($pembayaran->status_pembayaran == 'Ditolak') disabled class="opacity-50 cursor-not-allowed" @endif
                            >Tolak</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection