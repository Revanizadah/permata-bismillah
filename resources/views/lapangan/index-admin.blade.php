@extends('layouts.app')

@section('title', 'Kelola Lapangan')

@section('content')
<div class="container mx-auto my-10 p-6 md:p-8 bg-white shadow-xl rounded-2xl">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Kelola Lapangan</h2>
            <p class="text-sm text-gray-500 mt-1">Tambah, lihat, atau kelola jenis lapangan yang tersedia.</p>
        </div>
        <button onclick="openModal()" class="mt-4 md:mt-0 bg-blue-500 text-white font-bold py-2 px-5 rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
            + Tambah Lapangan
        </button>
    </div>

    {{-- TABEL LAPANGAN --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lapangan</th>
                    <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Per Jam</th>
                    <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Weekend Per Jam</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse($lapangans as $lapangan)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="py-4 px-6 whitespace-nowrap font-semibold">{{ $lapangan->nama }}</td>
                    <td class="py-4 px-6 text-right whitespace-nowrap">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</td>
                    <td class="py-4 px-6 text-right whitespace-nowrap">Rp {{ number_format($lapangan->harga_weekend_per_jam, 0, ',', '.') }}</td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                        <span class="text-gray-300 mx-1">|</span>
                        <a href="#" class="text-red-600 hover:text-red-900 font-medium">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-10 text-gray-500">
                        <p class="text-lg">Belum ada data lapangan yang ditambahkan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="lapanganModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div id="modalContent" class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 md:p-8 relative transform transition-all duration-300 opacity-0 scale-95">
        
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Tambah Lapangan Baru</h2>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Terjadi Kesalahan</p>
                <ul class="mt-1 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('lapangan.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Lapangan</label>
                    <input type="text" id="nama" name="nama" class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('nama') }}">
                </div>
                <div>
                    <label for="harga_per_jam" class="block text-gray-700 font-medium mb-2">Harga Per Jam (Weekday)</label>
                    <input type="number" id="harga_per_jam" name="harga_per_jam" class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('harga_per_jam') }}">
                </div>
                <div>
                    <label for="harga_weekend_per_jam" class="block text-gray-700 font-medium mb-2">Harga Per Jam (Weekend)</label>
                    <input type="number" id="harga_weekend_per_jam" name="harga_weekend_per_jam" class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('harga_weekend_per_jam') }}">
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-8">
                <button type="button" onclick="closeModal()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-medium">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal() {
        const modal = document.getElementById('lapanganModal');
        const content = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('opacity-0', 'scale-95');
        }, 10);
    }
    function closeModal() {
        const content = document.getElementById('modalContent');
        content.classList.add('opacity-0', 'scale-95');
        setTimeout(() => {
            document.getElementById('lapanganModal').classList.add('hidden');
        }, 300);
    }

    // Jika ada error validasi, buka kembali modalnya
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
            openModal();
        });
    @endif
</script>
@endpush