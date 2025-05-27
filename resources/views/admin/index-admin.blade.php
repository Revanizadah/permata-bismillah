<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
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
            <li>
                <a href="pesanan-admin.html" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-list w-5 h-5 mr-3"></i>
                    Pesanan
                </a>
            </li>
            <li>
                <a href="pembayaran-admin.html" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
                    Pembayaran
                </a>
            </li>
            <li>
                <a href="slotwaktu.html" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                    Slot Waktu
                </a>
            </li>
            <li>
                <a href="pesan-lapangan.html" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-paperclip w-5 h-5 mr-3"></i>
                    Pesan Lapangan Offline
                </a>
            </li>
            <li>
                <a href="laporan-admin.html" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                    Laporan Admin
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8">
        <div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Pembayaran</h2>

            <!-- Button to add a new slot -->
            <div class="text-center mb-6">
                <button class="bg-blue-200 text-black px-6 py-3 rounded-lg hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-200">Tambah Pembayaran</button>
            </div>

            <!-- Table for displaying payment details -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-blue-200 text-gray-800">
                        <th class="px-6 py-4 border-b">No</th>
                        <th class="px-6 py-4 border-b">Nomor Pemesan</th>
                        <th class="px-6 py-4 border-b">Metode Pembayaran</th>
                        <th class="px-6 py-4 border-b">Status</th>
                        <th class="px-6 py-4 border-b">Jumlah</th>
                        <th class="px-6 py-4 border-b">Bukti</th>
                        <th class="px-6 py-4 border-b">Catatan</th>
                        <th class="px-6 py-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4 border-b">1</td>
                        <td class="px-6 py-4 border-b">dikaas</td>
                        <td class="px-6 py-4 border-b">Lapangan 1</td>
                        <td class="px-6 py-4 border-b">2023-10-01</td>
                        <td class="px-6 py-4 border-b">09:00 - 10:00</td>
                        <td class="px-6 py-4 border-b">Rp 90.000</td>
                        <td class="px-6 py-4 border-b"><a href="#" class="text-blue-600">Lihat</a></td>
                        <td class="px-6 py-4 border-b">Transfer Bank</td>
                        <td class="px-6 py-4 border-b">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Verifikasi</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">Tolak</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 border-b">2</td>
                        <td class="px-6 py-4 border-b">Andi</td>
                        <td class="px-6 py-4 border-b">Lapangan 2</td>
                        <td class="px-6 py-4 border-b">2023-10-02</td>
                        <td class="px-6 py-4 border-b">10:00 - 11:00</td>
                        <td class="px-6 py-4 border-b">Rp 100.000</td>
                        <td class="px-6 py-4 border-b"><a href="#" class="text-blue-600">Lihat</a></td>
                        <td class="px-6 py-4 border-b">Cash</td>
                        <td class="px-6 py-4 border-b">
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">Verifikasi</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">Tolak</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
