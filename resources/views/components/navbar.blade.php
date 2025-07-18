<nav class="bg-white shadow-md py-4 px-5 fixed w-full top-0 z-10">
    <div class="max-w-screen-lg mx-auto px-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full" />
            <h1 class="text-1xl font-semibold text-black">Permata Futsal</h1>
        </div>
        <div class="flex items-center space-x-6">
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('user.dashboard') }}" class="text-lg text-gray-500 hover:text-black transition duration-300">Home</a>
                <a href="{{ route('user.pesanan.create') }}" class="text-lg text-gray-500 hover:text-black transition duration-300">Pesan Lapangan</a>
                <a href="{{ route('user.pesanan.history') }}" class="text-lg text-gray-500 hover:text-black transition duration-300">Riwayat Pesanan</a>
            </div>
            @auth
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 text-gray-500 hover:text-black transition duration-300">
                    <span class="font-semibold">{{ auth()->user()->nama }}</span>
                    <i class="fas fa-caret-down"></i>
                </button>
                <div x-show="open" @click.away="open = false" 
                     class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg py-1 transition duration-300"
                     style="display: none;">
                    <div class="px-4 py-2 text-gray-600 text-xs border-b">{{ auth()->user()->email }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 text-red-600 hover:bg-gray-100 transition duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="text-lg font-semibold text-white hover:text-gray-200 transition duration-300">Login</a>
            @endauth
        </div>
    </div>
</nav>