@extends('layouts.app')

@section('title', 'Kelola Fasilitas')

@section('content')
<div class="container mx-auto my-10 p-6 md:p-8 bg-white shadow-xl rounded-2xl">
    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Kelola Fasilitas</h2>
            <p class="text-sm text-gray-500 mt-1">Tambah atau kelola semua fasilitas yang tersedia.</p>
        </div>
        <button onclick="openCreateModal()" class="mt-4 md:mt-0 bg-blue-500 text-white font-bold py-2 px-5 rounded-lg hover:bg-blue-600">
            + Tambah Fasilitas
        </button>
    </div>

    {{-- TABEL FASILITAS --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-center w-16 text-xs font-medium text-gray-500 uppercase tracking-wider">Ikon</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Fasilitas</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse($fasilitas as $item)
                <tr class="hover:bg-gray-50">
                    <td class="py-4 px-6 text-center">
                        @if($item->ikon) <i class="{{ $item->ikon }} text-xl text-gray-600"></i> @endif
                    </td>
                    <td class="py-4 px-6 font-medium">{{ $item->nama }}</td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">
                        {{-- Mengirim seluruh objek $item ke fungsi JavaScript --}}
                        <button onclick='openEditModal({{ $item->toJson() }})' class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</button>
                        <span class="text-gray-300 mx-1">|</span>
                        <form action="{{ route('admin.fasilitas.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center py-10 text-gray-500"><p class="text-lg">Belum ada data fasilitas.</p></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $fasilitas->links() }}</div>
</div>

{{-- MODAL UNTUK TAMBAH & EDIT --}}
<div id="fasilitasModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative">
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
        <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-center text-gray-800"></h2>
        
        {{-- Menampilkan error validasi di dalam modal --}}
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Terjadi Kesalahan</p>
                <ul class="mt-1 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="fasilitasForm" action="" method="POST">
            @csrf
            <div id="method-field"></div> 
            
            <div class="space-y-6">
                <div>
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Fasilitas</label>
                    <input type="text" id="nama" name="nama" class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label for="ikon" class="block text-gray-700 font-medium mb-2">Kelas Ikon (Font Awesome)</label>
                    <input type="text" id="ikon" name="ikon" class="w-full border border-gray-400 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: fas fa-parking">
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-8">
                <button type="button" onclick="closeModal()" class="px-6 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const modal = document.getElementById('fasilitasModal');
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('fasilitasForm');
    const methodNameField = document.getElementById('method-field');
    const nameInput = document.getElementById('nama');
    const ikonInput = document.getElementById('ikon');

    function openCreateModal() {
        form.reset();
        modalTitle.textContent = 'Tambah Fasilitas Baru';
        form.action = '{{ route("admin.fasilitas.store") }}';
        methodNameField.innerHTML = '';
        modal.classList.remove('hidden');
    }

    function openEditModal(data) {
        form.reset();
        modalTitle.textContent = 'Edit Fasilitas';
        
        nameInput.value = data.nama;
        ikonInput.value = data.ikon;
        
        form.action = `/admin/fasilitas/${data.id}`;
        // Menambahkan @method('PUT') dan input hidden untuk id
        methodNameField.innerHTML = `
            @method('PUT')
            <input type="hidden" name="id" value="${data.id}">
        `;
        
        modal.classList.remove('hidden');
    }

    function closeModal() {
        modal.classList.add('hidden');
    }

    // ===============================================
    //         ✅ LOGIKA ERROR VALIDASI DIPERBAIKI
    // ===============================================
    @if($errors->any())
        document.addEventListener('DOMContentLoaded', () => {
            // Cek jika metode sebelumnya adalah PUT (artinya, error dari form edit)
            @if(old('_method') === 'PUT' && old('id'))
                // Buat objek data dari old input
                const oldData = {
                    id: {{ old('id') }},
                    nama: '{{ old('nama') }}',
                    ikon: '{{ old('ikon') }}'
                };
                // Buka kembali modal edit dengan data lama
                openEditModal(oldData);
            @else
                // Jika tidak, buka modal create dan isi dengan data lama
                openCreateModal();
                nameInput.value = '{{ old('nama') }}';
                ikonInput.value = '{{ old('ikon') }}';
            @endif
        });
    @endif
</script>
@endpush