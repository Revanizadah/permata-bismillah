@extends('layouts.app')

@section('title', 'Pembayaran Admin')

@section('content')
<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Pembayaran</h2>

    <div class="text-center mb-6">
        <button onclick="openModal()" class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200 inline-block">
            Tambah Pembayaran
        </button>
    </div>

    <div id="modalPembayaran" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div id="modalContent" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative transform transition-all duration-300 opacity-0 scale-95">

            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-center">Tambah Pembayaran</h2>

            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nomor Pesanan</label>
                    <input type="text" name="no_pesanan" class="w-full border rounded px-3 py-2" required value="{{ old('no_pesanan') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" class="w-full border rounded px-3 py-2" required value="{{ old('nama_pemesan') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Tanggal Pembayaran</label>
                    <input type="date" name="tanggal_pembayaran" class="w-full border rounded px-3 py-2" required value="{{ old('tanggal_pembayaran') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Jumlah Pembayaran</label>
                    <input type="number" name="jumlah_pembayaran" class="w-full border rounded px-3 py-2" required value="{{ old('jumlah_pembayaran') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" class="w-full border rounded px-3 py-2" required value="{{ old('metode_pembayaran') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="w-full border rounded px-3 py-2">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Status</label>
                    <input type="text" name="status_pembayaran" class="w-full border rounded px-3 py-2" required value="{{ old('status_pembayaran') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Catatan</label>
                    <textarea name="catatan" class="w-full border rounded px-3 py-2">{{ old('catatan') }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Batas Waktu</label>
                    <input type="datetime-local" name="batas_waktu" class="w-full border rounded px-3 py-2" required value="{{ old('batas_waktu') }}">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modalPembayaran');
            const content = document.getElementById('modalContent');
            modal.classList.remove('hidden');

            void content.offsetWidth;
            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        }
        function closeModal() {
            const modal = document.getElementById('modalPembayaran');
            const content = document.getElementById('modalContent');
            content.classList.remove('opacity-100', 'scale-100');
            content.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            openModal();
        });
        @endif
    </script>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-center">
            <thead>
                <tr class="bg-blue-200 text-gray-800">
                    <th class="px-4 py-3 border-b border-r">No</th>
                    <th class="px-4 py-3 border-b border-r">Nomor Pesanan</th>
                    <th class="px-4 py-3 border-b border-r">Nama Pemesan</th>
                    <th class="px-4 py-3 border-b border-r">Tanggal Pembayaran</th>
                    <th class="px-4 py-3 border-b border-r">Jumlah</th>
                    <th class="px-4 py-3 border-b border-r">Metode Pembayaran</th>
                    <th class="px-4 py-3 border-b border-r">Bukti</th>
                    <th class="px-4 py-3 border-b border-r">Status</th>
                    <th class="px-4 py-3 border-b border-r">Catatan</th>
                    <th class="px-4 py-3 border-b border-r">Batas Waktu</th>
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
                    <td class="px-4 py-2 border-b">
                        @if($pembayaran->batas_waktu)
                            {{ $pembayaran->batas_waktu->format('d-m-Y H:i') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
