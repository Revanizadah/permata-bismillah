@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h2>
    
    {{-- Card Statistics Section --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card-stat p-6 rounded-lg shadow-lg bg-blue-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $totalUser }}</h3>
            <p class="text-center text-sm text-gray-600">Total Pengguna</p>
        </div>
        <div class="card-stat p-6 rounded-lg shadow-lg bg-green-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $totalLapangan }}</h3>
            <p class="text-center text-sm text-gray-600">Total Lapangan</p>
        </div>
        <div class="card-stat p-6 rounded-lg shadow-lg bg-yellow-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $pesananPending }}</h3>
            <p class="text-center text-sm text-gray-600">Pesanan Pending</p>
        </div>
        <div class="card-stat p-6 rounded-lg shadow-lg bg-teal-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $pesananConfirmed }}</h3>
            <p class="text-center text-sm text-gray-600">Pesanan Dikonfirmasi</p>
        </div>
    </div>

    {{-- Calendar Section --}}
    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Kalender Jadwal Pesanan</h3>
        <div id='calendar'></div> 
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        
        // --- MODIFIKASI DESAIN DI SINI ---

        // 1. Header yang lebih simpel
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },

        // 2. Buat kalender lebih lebar daripada tinggi (lebih compact)
        aspectRatio: 2, // Nilai defaultnya 1.35. Semakin besar angkanya, semakin pendek.

        // 3. Tampilkan event sebagai titik kecil untuk kebersihan
        eventDisplay: 'dot',
        
        // Mengambil data event dari Blade
        events: @json($events),
        
        // Tambahkan fungsionalitas: saat sebuah hari diklik, arahkan ke daftar pesanan untuk hari itu
        dateClick: function(info) {
            // Arahkan ke halaman pesanan dengan query tanggal yang diklik
            window.location.href = `{{ route('pesanan.index') }}?tanggal=${info.dateStr}`;
        }
    });

    calendar.render();
});
</script>
@endpush