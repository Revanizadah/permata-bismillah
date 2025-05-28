<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-indigo-300">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white p-6">
        <!-- Logo and Title -->
        <div class="mb-8 flex items-center space-x-3">
            <img src="/resources/views/image/logo.jpg" alt="Logo" class="w-12 h-12 rounded-full">
            <h2 class="text-2xl font-bold">Admin Permata</h2>
        </div>
        <!-- Sidebar Navigation -->
        <ul class="space-y-4">
            <li><a href= "{{ route('pesanan.index') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg"><i class="fas fa-list w-5 h-5 mr-3"></i>Pesanan</a></li>
            <li><a href= "{{ route('pembayaran.index') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg"><i class="fas fa-credit-card w-5 h-5 mr-3"></i>Pembayaran</a></li>
            <li><a href= "{{ route('slotwaktu.index') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg"><i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>Slot Waktu</a></li>
            <li><a href="pesan-lapangan.html" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg"><i class="fas fa-paperclip w-5 h-5 mr-3"></i>Pesan Lapangan Offline</a></li>
            <li><a href="laporan-admin.html" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg"><i class="fas fa-chart-bar w-5 h-5 mr-3"></i>Laporan Admin</a></li>
            <li><a href="#" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg"><i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Pembayaran</h2>

            <!-- Button to add a new slot -->
            <div class="text-center mb-6">
                <a href="{{ route('pembayaran.create') }}" class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200 inline-block">Tambah Pembayaran</a>
            </div>

            <!-- Table for displaying payment details -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-center">
                    <thead>
                        <tr class="bg-blue-200 text-gray-800">
                            <th class="px-4 py-3 border-b border-r">No</th>
                            <th class="px-4 py-3 border-b border-r">Nomor Pesanan</th>
                            <th class="px-4 py-3 border-b border-r">Nama Pemesan</th>
                            <th class="px-4 py-3 border-b border-r">Metode Pembayaran</th>
                            <th class="px-4 py-3 border-b border-r">Status</th>
                            <th class="px-4 py-3 border-b border-r">Jumlah</th>
                            <th class="px-4 py-3 border-b border-r">Bukti</th>
                            <th class="px-4 py-3 border-b border-r">Catatan</th>
                            <th class="px-4 py-3 border-b">Aksi</th>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
</body>
</html>