@extends('layouts.app')

@section('title', 'Pembayaran Admin')

@section('content')
<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Slot Waktu</h2>

    <!-- Button to add a new slot -->
    <div class="text-center mb-6">
        <button onclick="openModalSlot()" class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200">
            Tambah Slot
        </button>
    </div>

    <!-- Slot Waktu Modal (kode sama seperti sebelumnya, tidak diubah di sini) -->
    <div id="modalSlot" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div id="modalSlotContent" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative transform transition-all duration-300 opacity-0 scale-95">
            <!-- Tombol close -->
            <button onclick="closeModalSlot()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-center">Tambah Slot Waktu</h2>
            
            {{-- VALIDASI ERROR --}}
            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('slotwaktu.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama Lapangan</label>
                    <select name="lapangan_id" required class="w-full border rounded px-3 py-2">
                        @foreach($lapangans as $lapangan)
                            <option value="{{ $lapangan->id }}">{{ $lapangan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" class="w-full border rounded px-3 py-2" required value="{{ old('tanggal') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="w-full border rounded px-3 py-2" required value="{{ old('jam_mulai') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="w-full border rounded px-3 py-2" required value="{{ old('jam_selesai') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Status</label>
                    <input type="text" name="status" class="w-full border rounded px-3 py-2" required value="{{ old('status') }}">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModalSlot()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Modal Animasi Slot Waktu -->
    <script>
        function openModalSlot() {
            const modal = document.getElementById('modalSlot');
            const content = document.getElementById('modalSlotContent');
            modal.classList.remove('hidden');
            void content.offsetWidth;
            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        }
        function closeModalSlot() {
            const modal = document.getElementById('modalSlot');
            const content = document.getElementById('modalSlotContent');
            content.classList.remove('opacity-100', 'scale-100');
            content.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
        @if($errors->any())
        document.addEventListener('DOMContentLoaded', function() {
            openModalSlot();
        });
        @endif
    </script>

    <!-- Table for displaying slot times -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-center">
            <thead>
                <tr class="bg-blue-200 text-gray-800">
                    <th class="px-4 py-3 border-b border-r">No</th>
                    <th class="px-4 py-3 border-b border-r">Nama Lapangan</th>
                    <th class="px-4 py-3 border-b border-r">Tanggal</th>
                    <th class="px-4 py-3 border-b border-r">Jam Mulai</th>
                    <th class="px-4 py-3 border-b border-r">Jam Selesai</th>
                    <th class="px-4 py-3 border-b border-r">Status</th>
                    <th class="px-4 py-3 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($slotWaktus as $slot)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b border-r">{{ $loop->iteration }}</td>
                    {{-- <td class="px-4 py-2 border-b border-r">{{ $slot->lapangan->nama }}</td> --}}
                    {{-- <td class="px-4 py-2 border-b border-r">{{ $slot->tanggal }}</td> --}}
                    <td class="px-4 py-2 border-b border-r">{{ $slot->jam_mulai }}</td>
                    <td class="px-4 py-2 border-b border-r">{{ $slot->jam_selesai }}</td>
                    <td class="px-4 py-2 border-b border-r">
                        <span class="inline-block px-2 py-1 rounded
                            @if(strtolower($slot->status) == 'aktif') bg-green-200 text-green-800
                            @elseif(strtolower($slot->status) == 'tidak aktif') bg-red-200 text-red-800
                            @else bg-gray-200 text-gray-800 @endif">
                            {{ $slot->status }}
                        </span>
                    </td>
                    <td class="px-4 py-2 border-b space-x-1">
                        <form action="{{ route('slotwaktu.destroy', $slot->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')" class="inline-block bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection