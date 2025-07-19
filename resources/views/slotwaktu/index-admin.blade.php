@extends('layouts.app')

@section('title', 'Kelola Slot Waktu')

@section('content')
<div class="container mx-auto my-10 p-6 md:p-8 bg-white shadow-xl rounded-2xl">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Kelola Slot Waktu</h2>
            <p class="text-sm text-gray-500 mt-1">Atur jam operasional yang tersedia untuk pemesanan.</p>
        </div>
        <button onclick="openModal()" class="mt-4 md:mt-0 bg-blue-500 text-white font-bold py-2 px-5 rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
            + Tambah Slot Baru
        </button>
    </div>

    {{-- TABEL SLOT WAKTU --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Mulai</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam Selesai</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse($slotWaktus as $slot)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="py-4 px-6 whitespace-nowrap font-mono">{{ \Carbon\Carbon::parse($slot->jam_mulai)->format('H:i') }}</td>
                    <td class="py-4 px-6 whitespace-nowrap font-mono">{{ \Carbon\Carbon::parse($slot->jam_selesai)->format('H:i') }}</td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">
                        <form action="{{ route('admin.slotwaktu.destroy', $slot->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white text-xs font-bold py-1 px-3 rounded-full hover:bg-red-600 transition duration-300"onclick="return confirm('Apakah Anda yakin ingin menghapus slot ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-10 text-gray-500">
                        <p class="text-lg">Belum ada slot waktu yang ditambahkan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH SLOT --}}
<div id="slotModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div id="modalContent" class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 md:p-8 relative transform transition-all duration-300 opacity-0 scale-95">
        
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Tambah Slot Waktu Baru</h2>

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

        <form action="" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="jam_mulai" class="block text-gray-700 font-medium mb-2">Jam Mulai</label>
                    <input type="time" id="jam_mulai" name="jam_mulai" class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('jam_mulai') }}">
                </div>
                <div>
                    <label for="jam_selesai" class="block text-gray-700 font-medium mb-2">Jam Selesai</label>
                    <input type="time" id="jam_selesai" name="jam_selesai" class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('jam_selesai') }}">
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
        const modal = document.getElementById('slotModal');
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
            document.getElementById('slotModal').classList.add('hidden');
        }, 300);
    }
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
            openModal();
        });
    @endif
</script>
@endpush