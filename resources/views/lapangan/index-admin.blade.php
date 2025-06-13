@extends('layouts.app')

@section('title', 'Lapangan Admin')

@section('content')
<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Lapangan</h2>

    <div class="text-center mb-6">
        <button onclick="openModal()" class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200 inline-block">
            Tambah Lapangan
        </button>
    </div>

    <div id="modalLapangan" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
        <div id="modalContent" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative transform transition-all duration-300 opacity-0 scale-95">

            <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
            <h2 class="text-xl font-bold mb-4 text-center">Tambah Lapangan</h2>

            @if($errors->any())
                <div class="mb-4 text-red-600">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.lapangan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nama Lapangan</label>
                    <input type="text" name="nama_lapangan" class="w-full border rounded px-3 py-2" required value="{{ old('nama_lapangan') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Harga Perjam</label>
                    <input type="number" name="harga_perjam" class="w-full border rounded px-3 py-2" required value="{{ old('harga_perjam') }}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Harga Weekend Perjam</label>
                    <input type="number" name="harga_weekend_perjam" class="w-full border rounded px-3 py-2" required value="{{ old('harga_weekend_perjam') }}">
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modalLapangan');
            const content = document.getElementById('modalContent');
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.add('opacity-100', 'scale-100');
                content.classList.remove('opacity-0', 'scale-95');
            }, 10);
        }
        function closeModal() {
            const modal = document.getElementById('modalLapangan');
            const content = document.getElementById('modalContent');
            content.classList.remove('opacity-100', 'scale-100');
            content.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        @if($errors->any())
            openModal();
        @else
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('modalLapangan');
                if (modal) {
                    modal.classList.add('hidden');
                }
            });
        @endif
    </script>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-center">
            <thead>
                <tr class="bg-blue-200 text-gray-800">
                    <th class="px-4 py-3 border-b border-r">Nama Lapangan</th>
                    <th class="px-4 py-3 border-b border-r">Harga Perjam</th>
                    <th class="px-4 py-3 border-b border-r">Harga Weekend Perjam</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($lapangans as $lapangan)
                    <tr class="text-center">
                        <td class="px-4 py-2 border-b">{{ $lapangan->nama }}</td>
                        <td class="px-4 py-2 border-b">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border-b">Rp {{ number_format($lapangan->harga_weekend_per_jam, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
