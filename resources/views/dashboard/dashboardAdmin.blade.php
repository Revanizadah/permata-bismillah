@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-center text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h2>

  <div class="text-center mb-8">
    @auth
        <p class="text-lg text-gray-600">
            Selamat datang, <span class="font-bold text-indigo-600">{{ auth()->user()->nama }}</span>!
        </p>
    @else
        <p class="text-lg text-gray-600">Selamat datang, Admin!</p>
    @endauth
</div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="p-6 rounded-lg shadow-lg bg-blue-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $totalUser }}</h3>
            <p class="text-center text-sm text-gray-600">Total Pengguna</p>
        </div>
        <div class="p-6 rounded-lg shadow-lg bg-green-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $totalLapangan }}</h3>
            <p class="text-center text-sm text-gray-600">Total Lapangan</p>
        </div>
        <div class="p-6 rounded-lg shadow-lg bg-yellow-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $pesananPending }}</h3>
            <p class="text-center text-sm text-gray-600">Pesanan Pending</p>
        </div>
        <div class="p-6 rounded-lg shadow-lg bg-teal-200">
            <h3 class="text-center text-3xl font-bold text-gray-800">{{ $pesananConfirmed }}</h3>
            <p class="text-center text-sm text-gray-600">Pesanan Dikonfirmasi</p>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Pendapatan 7 Hari Terakhir</h3>
        <div>
            <canvas id="revenueChart" style="height: 300px;"></canvas>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Kalender Jadwal Pesanan</h3>
        <div id='calendar'></div> 
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    

    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: { left: 'prev', center: 'title', right: 'next' },
            aspectRatio: 2,
            eventDisplay: 'dot',
            events: @json($events),
            dateClick: function(info) {
                window.location.href = `{{ url('/pesanan') }}?tanggal=${info.dateStr}`;
            }
        });
        calendar.render();
    }

    const ctx = document.getElementById('revenueChart');
    if (ctx) {
        const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.4)');  
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: @json($dataPendapatan),
                    backgroundColor: gradient,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 6,
                    hoverBackgroundColor: 'rgba(37, 99, 235, 0.9)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false 
                    },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 6,
                        displayColors: false, 
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed.y || 0;
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#E5E7EB',
                            borderDash: [2, 4],
                        },
                        ticks: {
                            color: '#6B7280',
                            font: { size: 11 },
                            callback: function(value) {
                                if (value >= 1000000) return 'Rp ' + (value / 1000000) + ' Jt';
                                if (value >= 1000) return 'Rp ' + (value / 1000) + ' Rb';
                                return 'Rp ' + value;
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#6B7280',
                            font: { size: 11 }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush