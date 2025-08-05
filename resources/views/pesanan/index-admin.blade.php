@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container mx-auto my-10 p-6 md:p-8 bg-white shadow-xl rounded-2xl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Daftar Pesanan</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola semua pesanan yang masuk.</p>
        </div>
    </div>

    @if(request('tanggal'))
        <div class="bg-blue-50 border-l-4 border-blue-400 text-blue-800 p-4 mb-6 rounded-r-lg" role="alert">
            <p>Menampilkan pesanan untuk tanggal: <strong class="font-semibold">{{ \Carbon\Carbon::parse(request('tanggal'))->format('d F Y') }}</strong></p>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Pembayaran</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lapangan</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl. Pesan</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Detail Jam</th>
                    <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse($pesanans as $pesanan)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="py-4 px-6 whitespace-nowrap">
                        <span class="font-mono text-sm">{{ $pesanan->pembayaran->kode_pembayaran }}</span>
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">{{ $pesanan->user->nama ?? 'User tidak diketahui' }}</td>
                    <td class="py-4 px-6 whitespace-nowrap">{{ $pesanan->lapangan->nama ?? 'Lapangan tidak diketahui' }}</td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y') }}</td>
                    
                    <td class="py-4 px-6 text-center">
                        <div class="flex flex-wrap justify-center gap-1">
                            @foreach($pesanan->detailPemesanan as $detail)
                                <span class="bg-gray-200 rounded-full px-2 py-1 text-xs font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($detail->slotWaktu->jam_mulai)->format('H:i') }}
                                </span>
                            @endforeach
                        </div>
                    </td>

                    <td class="py-4 px-6 text-right font-medium whitespace-nowrap">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    
                    <td class="py-4 px-6 text-center">
                        <span class="px-3 py-1 font-semibold text-xs leading-tight rounded-full
                            {{ $pesanan->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $pesanan->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $pesanan->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($pesanan->status) }}
                        </span>
                    </td>

                    <td class="py-4 px-6 text-center whitespace-nowrap">
                    @if ($pesanan->status == 'pending')
                    <form action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="confirmed">
                    <button type="submit" class="bg-green-500 text-white text-xs font-bold py-1 px-3 rounded-full hover:bg-green-600 transition duration-300">
                    Konfirmasi
                    </button>
                    </form>
                    @else
        <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-green-100 text-green-600">
            <i class="fas fa-check"></i>
        </span>
    @endif
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-10 text-gray-500">
                        <p class="text-lg">Tidak ada data pesanan yang ditemukan.</p>
                        <p class="text-sm mt-1">Coba ubah filter atau buat pesanan baru.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Link Paginasi --}}
    <div class="mt-8">
        {{ $pesanans->appends(request()->query())->links() }}
    </div>
</div>
@endsection