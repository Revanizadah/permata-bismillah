@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')
<div class="container mx-auto my-10 p-6 md:p-8 bg-white shadow-xl rounded-2xl">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Kelola Pengguna</h2>
            <p class="text-sm text-gray-500 mt-1">Tambah, lihat, atau kelola pengguna sistem.</p>
        </div>
        <button onclick="openModal()" class="mt-4 md:mt-0 bg-blue-500 text-white font-bold py-2 px-5 rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
            + Tambah Pengguna
        </button>
    </div>

    {{-- TABEL PENGGUNA --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No. HP</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="py-4 px-6 whitespace-nowrap">{{ $user->nama }}</td>
                    <td class="py-4 px-6 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">{{ $user->no_hp ?? '-' }}</td>
                    <td class="py-4 px-6 text-center">
                        <span class="px-3 py-1 font-semibold text-xs leading-tight rounded-full
                            {{ $user->role == 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                        <span class="text-gray-300 mx-1">|</span>
                        <a href="#" class="text-red-600 hover:text-red-900 font-medium">Hapus</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-10 text-gray-500">
                        <p class="text-lg">Tidak ada data pengguna yang ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL TAMBAH PENGGUNA --}}
<div id="userModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div id="modalContent" class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 md:p-8 relative transform transition-all duration-300 opacity-0 scale-95">
        
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Tambah Pengguna Baru</h2>

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

        <form action="{{ route('admin.user.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama</label>
                    {{-- PERBAIKAN: Mengganti border-gray-300 menjadi border-gray-400 --}}
                    <input type="text" id="nama" name="nama" class="w-full border border-black rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('nama') }}">
                </div>
                <div class="mb-4">
                    <label for="no_hp" class="block text-gray-700 font-medium mb-2">No. HP</label>
                    {{-- PERBAIKAN: Mengganti border-gray-300 menjadi border-gray-400 --}}
                    <input type="text" id="no_hp" name="no_hp" class="w-full border border-black rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('no_hp') }}">
                </div>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                {{-- PERBAIKAN: Mengganti border-gray-300 menjadi border-gray-400 --}}
                <input type="email" id="email" name="email" class="w-full border border-black rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                {{-- PERBAIKAN: Mengganti border-gray-300 menjadi border-gray-400 --}}
                <input type="password" id="password" name="password" class="w-full border border-black rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition" required>
            </div>
            <div class="mb-6">
                <label for="role" class="block text-gray-700 font-medium mb-2">Role</label>
                {{-- PERBAIKAN: Mengganti border-gray-300 menjadi border-gray-400 --}}
                <select name="role" id="role" class="w-full border border-black rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition">
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="flex justify-end space-x-4">
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
        const modal = document.getElementById('userModal');
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
            document.getElementById('userModal').classList.add('hidden');
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