@extends('layouts.app')

@section('title', 'Laporan Admin')

@section('content')
<div class="container mx-auto my-10 p-6 md:p-8 bg-white shadow-xl rounded-2xl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 pb-4 border-b border-gray-200">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Laporan Admin</h2>
            <p class="text-sm text-gray-500 mt-1">Analisis pendapatan berdasarkan rentang waktu.</p>
        </div>
        <form action="{{ route('admin.laporan.pendapatan') }}" method="GET" class="flex items-center space-x-2 mt-4 md:mt-0">
            <input type="date" name="tanggal_mulai" value="{{ $tanggalMulai }}" class="border-gray-300 rounded-lg shadow-sm p-2">
            <span class="text-gray-500">s/d</span>
            <input type="date" name="tanggal_selesai" value="{{ $tanggalSelesai }}" class="border-gray-300 rounded-lg shadow-sm p-2">
            <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">Filter</button>
        </form>
        <a href="{{ route('admin.laporan.export.excel', request()->query()) }}" class="bg-green-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-green-600">
            Ekspor Excel
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="p-6 rounded-lg shadow-lg bg-green-100 text-green-800">
            <h3 class="text-4xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            <p class="text-sm font-medium">Total Pendapatan</p>
        </div>
        <div class="p-6 rounded-lg shadow-lg bg-blue-100 text-blue-800">
            <h3 class="text-4xl font-bold">{{ $jumlahTransaksi }}</h3>
            <p class="text-sm font-medium">Jumlah Transaksi</p>
        </div>
        <div class="p-6 rounded-lg shadow-lg bg-indigo-100 text-indigo-800">
            <h3 class="text-4xl font-bold">Rp {{ number_format($rataRataTransaksi, 0, ',', '.') }}</h3>
            <p class="text-sm font-medium">Rata-rata per Transaksi</p>
        </div>
    </div>
    
    {{-- GRAFIK KONTRIBUSI --}}
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Kontribusi Pendapatan per Lapangan</h3>
        <div style="height: 350px;">
            <canvas id="contributionChart"></canvas>
        </div>
    </div>

    {{-- TABEL RINCIAN --}}
    <div class="mt-8">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Rincian Transaksi</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                        <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lapangan</th>
                        <th class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    @forelse($laporanPesanans as $pesanan)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 whitespace-nowrap">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesan)->format('d M Y') }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $pesanan->user->nama ?? 'N/A' }}</td>
                        <td class="py-4 px-6 whitespace-nowrap">{{ $pesanan->lapangan->nama ?? 'N/A' }}</td>
                        <td class="py-4 px-6 text-right font-medium">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-10 text-gray-500">Tidak ada data transaksi pada rentang tanggal ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $laporanPesanans->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('contributionChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'pie', // Jenis grafik adalah Pie Chart
            data: {
                labels: @json($labelsKontribusi),
                datasets: [{
                    label: 'Kontribusi Pendapatan',
                    data: @json($dataKontribusi),
                    backgroundColor: [ // Sediakan beberapa warna untuk setiap bagian pie
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    }
});
</script>
@endpush