<div class="w-64 bg-gray-900 text-gray-300 flex flex-col min-h-screen">
   <div class="px-6 py-5 border-b border-gray-800">
        <div class="flex items-center space-x-4">
            {{-- PERUBAHAN: Menggunakan path logo baru --}}
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-11 h-11 rounded-full object-cover">
            <h2 class="text-xl font-bold text-white tracking-tight">Admin Permata</h2>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">
        {{-- Link Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-tachometer-alt fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        {{-- Kelola Pesanan Group --}}
        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Kelola</p>
        <a href="{{ route('admin.pesanan-offline.create') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('pesanan-offline.*') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-edit fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Buat Pesanan</span>
        </a>
        <a href="{{ route('admin.pesanan-offline.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('manage-pesanan.*') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-receipt fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Pesanan</span>
        </a>
        <a href="{{ route('admin.pembayaran.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('pembayaran.*') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-credit-card fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Pembayaran</span>
        </a>

        {{-- Master Data Group --}}
        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Master Data</p>
        <a href="{{ route('admin.lapangan.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('lapangan.*') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-futbol fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Lapangan</span>
        </a>
        <a href="{{ route('admin.slotwaktu.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('slotwaktu.*') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-clock fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Slot Waktu</span>
        </a>
        <a href="{{ route('admin.user.index') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('user.*') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-users fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Pengguna</span>
        </a>

        {{-- Laporan Group --}}
        <p class="px-4 pt-4 pb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Analisis</p>
        <a href="{{ route('admin.laporan.pendapatan') }}" 
           class="flex items-center px-4 py-2.5 rounded-lg transition duration-200 
                  {{ request()->routeIs('admin.laporan.*') ? 'bg-indigo-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-chart-pie fa-fw w-5 h-5 mr-3"></i>
            <span class="font-medium">Laporan</span>
        </a>
    </nav>

    <div class="px-4 py-4 mt-auto border-t border-gray-800">
        <form method="POST" action="{{ route('logout') }}"">
            @csrf
            <button type="submit"
                    class="w-full text-left flex items-center text-gray-400 hover:bg-red-900 hover:text-white px-4 py-2.5 rounded-lg transition duration-200">
                <i class="fas fa-sign-out-alt fa-fw w-5 h-5 mr-3"></i>
                <span class="font-medium">{{ __('Log Out') }}</span>
            </button>
        </form>
    </div>
</div>