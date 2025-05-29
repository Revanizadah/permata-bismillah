<!DOCTYPE html>
<html lang="id" class="scroll-smooth"> <!-- Menambahkan kelas scroll-smooth di sini -->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Lapangan</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-300 font-sans">

  <!-- Navbar -->
  <header class="bg-gray-900 p-6 shadow-lg">
    <div class="max-w-7xl mx-auto flex items-center text-white">
      <img src="image/logo.jpg" alt="Logo" class="w-12 h-12 rounded-full">
      <h1 class="text-2xl font-semibold ml-4">Permata Futsal Badminton</h1>
      <nav class="ml-auto">
        <ul class="flex space-x-6">
          <li><a href="#home" class="nav-link hover:text-gray-300 transition">Beranda</a></li>
          <li><a href="#about" class="nav-link hover:text-gray-300 transition">Tentang Kami</a></li>
          <li><a href="#type" class="nav-link hover:text-gray-300 transition">Tipe Lapangan</a></li>
          <li><a href="#contact" class="nav-link hover:text-gray-300 transition">Kontak</a></li>
          <li><a href="#" class="nav-link hover:text-gray-300 transition">Login</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section id="home" class="relative bg-cover bg-center h-96 flex items-center justify-center text-center px-6 py-20" style="background-image: url('image/utama.png');">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="relative z-10 text-white">
      <h2 class="text-5xl font-bold text-white mb-4">Selamat Datang di Permata Futsal dan Badminton</h2>
      <p class="text-xl text-white mb-6">Nikmati pengalaman olahraga terbaik di lapangan berkualitas tinggi di Malang</p>
      <a href="#booking" class="bg-yellow-500 text-black py-3 px-10 rounded-lg text-xl font-medium hover:bg-yellow-400 transition-all duration-300">Booking Now</a>
    </div>
  </section>

  <!-- About Section -->
  <section id="about" class="mx-auto px-6 py-16 text-center bg-white">
    <h2 class="text-4xl font-semibold text-gray-900 mb-8">Tentang Permata Futsal & Badminton</h2>
    <p class="text-lg text-gray-700 mb-6">Permata Futsal & Badminton menawarkan fasilitas olahraga dengan lapangan futsal dan badminton yang nyaman dan modern di Malang. Kami menyediakan ruang yang ideal untuk latihan dan pertandingan dengan pencahayaan yang baik dan kebersihan yang terjaga.</p>
    <p class="text-lg text-gray-700">Kami berkomitmen untuk memberikan pengalaman terbaik bagi setiap pengunjung, dengan layanan pelanggan yang ramah dan fasilitas yang selalu terjaga kebersihannya.</p>
  </section>

  <!-- Tipe Lapangan Section -->
  <section id="type" class="max-w-7xl bg-indigo-300 mx-auto px-6 py-16 text-center">
    <h2 class="text-4xl font-semibold text-gray-900 mb-8">Tipe Lapangan</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105">
        <img src="image/sintetis.jpeg" alt="Lapangan Futsal Sintetis" class="w-full h-64 object-cover">
        <div class="p-6">
          <h3 class="text-xl font-semibold text-gray-800">Lapangan Futsal Sintetis</h3>
          <p class="text-gray-600 mt-2">Nikmati pertandingan futsal di lapangan sintetis yang nyaman dan modern.</p>
        </div>
      </div>
      <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105">
        <img src="image/multicort.jpg" alt="Lapangan Futsal Multicourt" class="w-full h-64 object-cover">
        <div class="p-6">
          <h3 class="text-xl font-semibold text-gray-800">Lapangan Futsal Multicourt</h3>
          <p class="text-gray-600 mt-2">Rasakan serunya bermain futsal di lapangan multicourt yang luas.</p>
        </div>
      </div>
      <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-2xl transition-transform transform hover:scale-105">
        <img src="image/badminton.jpg" alt="Lapangan Badminton" class="w-full h-64 object-cover">
        <div class="p-6">
          <h3 class="text-xl font-semibold text-gray-800">Lapangan Badminton</h3>
          <p class="text-gray-600 mt-2">Rasakan sensasi bermain badminton di lapangan yang luas dan terang.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="bg-white py-16 text-gray-800">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-semibold mb-8">Kontak Kami</h2>
      <p class="text-lg mb-6">Jika Anda memiliki pertanyaan atau ingin melakukan pemesanan langsung, hubungi kami melalui tombol di bawah untuk berbicara dengan admin kami.</p>
      <a href="https://wa.me/6281234567890" class="bg-green-500 text-white py-3 px-10 rounded-lg text-xl font-medium hover:bg-green-400 transition-all duration-300">Chat dengan Admin</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-6">
    <div class="max-w-7xl mx-auto text-center">
      <p>&copy; 2025 Permata Futsal & Badminton. All rights reserved.</p>
    </div>
  </footer>

</body>
</html>
