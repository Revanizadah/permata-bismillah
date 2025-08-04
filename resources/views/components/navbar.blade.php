<nav x-data="{ open: false }" class="bg-white shadow-md fixed w-full top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            
            {{-- Logo & Nama Aplikasi --}}
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full" />
                    <span class="text-xl font-semibold text-gray-800">Permata Futsal</span>
                </a>
            </div>

            {{-- Link Navigasi Utama (Layar Besar) --}}
            <div class="hidden md:flex md:items-center md:space-x-8">
                <a href="{{ route('dashboard') }}" class="font-medium text-gray-500 hover:text-indigo-600 transition duration-150 ease-in-out">Home</a>
                <a href="{{ route('user.pesanan.create') }}" class="font-medium text-gray-500 hover:text-indigo-600 transition duration-150 ease-in-out">Pesan Lapangan</a>
                <a href="{{ route('user.riwayat.index') }}" class="font-medium text-gray-500 hover:text-indigo-600 transition duration-150 ease-in-out">Riwayat Pesanan</a>
            </div>

            {{-- Tombol Aksi Kanan (Login/Register atau Profil Pengguna) --}}
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    {{-- Dropdown Profil jika sudah login --}}
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 text-gray-500 hover:text-gray-900">
                            <span class="font-semibold">{{ auth()->user()->nama }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false" 
                             class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg py-1 z-50"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             style="display: none;">
                            <div class="px-4 py-2 text-gray-600 text-xs border-b">{{ auth()->user()->email }}</div>
                            {{-- Tombol Logout sekarang diubah menjadi link biasa yang memicu form --}}
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Tombol Login & Daftar jika belum login --}}
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 rounded-lg font-semibold text-white bg-indigo-500 hover:bg-indigo-600 transition duration-300">
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Tombol Hamburger untuk Mobile --}}
            <div class="-mr-2 flex md:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Mobile (Muncul saat hamburger diklik) --}}
    <div x-show="open" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Home</a>
            <a href="{{ route('user.pesanan.create') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Pesan Lapangan</a>
            <a href="{{ route('user.riwayat.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Riwayat Pesanan</a>
        </div>
    </div>
</nav>