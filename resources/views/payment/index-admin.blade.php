@extends('layouts.app')

@section('title', 'Kelola Pembayaran')

@section('content')
<div class="container mx-auto my-10 p-6 md:p-8 bg-white shadow-xl rounded-2xl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Kelola Pembayaran</h2>
            <p class="text-sm text-gray-500 mt-1">Konfirmasi atau lihat riwayat pembayaran.</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Pembayaran</th>
                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="py-3 px-6 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @forelse($pembayarans as $pembayaran)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="py-4 px-6 whitespace-nowrap">
                        <span class="font-mono text-sm">{{ $pembayaran->kode_pembayaran }}</span>
                    </td>
                    <td class="py-4 px-6 whitespace-nowrap">{{ $pembayaran->pesanan->user->nama ?? 'N/A' }}</td>
                    <td class="py-4 px-6 text-right font-medium whitespace-nowrap">
                        Rp {{ number_format($pembayaran->pesanan->total_harga ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="py-4 px-6 text-center">
                        @if ($pembayaran->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="text-blue-500 hover:underline text-sm">
                                Lihat Bukti
                            </a>
                        @else
                            <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>

                    <td class="py-4 px-6 text-center">
                        <span class="px-3 py-1 font-semibold text-xs leading-tight rounded-full
                            {{ $pembayaran->status_pembayaran == 'paid' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $pembayaran->status_pembayaran == 'unpaid' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $pembayaran->status_pembayaran == 'expired' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ ucfirst($pembayaran->status_pembayaran) }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-center whitespace-nowrap">
                        <a href="" class="text-indigo-600 hover:text-indigo-900 font-medium">Lihat Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        <p class="text-lg">Tidak ada data pembayaran yang ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {{ $pembayarans->links() }}
    </div>
</div>
@endsection