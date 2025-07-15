<div class="w-64 bg-gray-800 text-white p-6 min-h-screen">
    <!-- Logo and Title -->
    <div class="mb-8 flex items-center space-x-3">
        <img src="/resources/views/image/logo.jpg" alt="Logo" class="w-12 h-12 rounded-full">
        <h2 class="text-2xl font-bold">Admin Permata</h2>
    </div>
    <!-- Sidebar Navigation -->
    <ul class="space-y-4">
         <li>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-list w-5 h-5 mr-3"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('user.index') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-list w-5 h-5 mr-3"></i>
                User
            </a>
        </li>
        <li>
            <a href="{{ route('pesanan-offline.create') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-list w-5 h-5 mr-3"></i>
                Pesanan
            </a>
        </li>
        <li>
            <a href="{{ route('pembayaran.index') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-credit-card w-5 h-5 mr-3"></i>
                Pembayaran
            </a>
        </li>
        <li>
            <a href= "{{ route('slotwaktu.index') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-calendar-alt w-5 h-5 mr-3"></i>
                Slot Waktu
            </a>
        </li>
        <li>
            <a href= "{{ route('lapangan.index') }}" class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
                <i class="fas fa-paperclip w-5 h-5 mr-3"></i>
                Lapangan
            </a>
        </li>
        <li>
            <a href="{{ route('pesanan-offline.create') }}"class="flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
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
    <form method="POST" action="">
        @csrf
        <button type="submit"
            class="w-full text-left flex items-center text-gray-300 hover:text-white hover:bg-gray-700 px-4 py-2 rounded-lg">
            <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
            {{ __('Log Out') }}
        </button>
    </form>
</li>
    </ul>
</div>
