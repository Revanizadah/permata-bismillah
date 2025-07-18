<footer class="bg-gray-800 text-white pt-16 pb-6">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Kolom 1: Logo & Deskripsi --}}
            <div class="mb-6 md:mb-0">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
                    <h3 class="text-xl font-bold">Permata Futsal</h3>
                </div>
                <p class="text-gray-400 text-sm">
                    Pesan lapangan futsal dan badminton favorit Anda dengan mudah dan cepat.
                </p>
            </div>

            {{-- Kolom 2: Link Cepat --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 tracking-wider uppercase">Link Cepat</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Pesan Lapangan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Riwayat Pesanan</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Kontak --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 tracking-wider uppercase">Kontak</h4>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt w-5 mt-1 mr-3"></i>
                        <span>Jl. Raya Tidar No. 100, Malang, Jawa Timur</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone-alt w-5 mr-3"></i>
                        <span>(0341) 123-456</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope w-5 mr-3"></i>
                        <span>kontak@permatafutsal.com</span>
                    </li>
                </ul>
            </div>

            {{-- Kolom 4: Media Sosial --}}
            <div>
                <h4 class="text-lg font-semibold mb-4 tracking-wider uppercase">Ikuti Kami</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition text-2xl"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

        </div>

        {{-- Garis Pemisah & Copyright --}}
        <div class="mt-12 border-t border-gray-700 pt-6 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Permata Futsal. All Rights Reserved.</p>
        </div>
    </div>
</footer>