@extends('layouts.app')

@section('title', 'Pemesanan Lapangan')

@section('content')
{{-- PERBAIKAN: Menghapus `items-center` agar form tidak selalu di tengah secara vertikal --}}
<div class="bg-white shadow-lg rounded-lg flex justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full space-y-8">
        
        {{-- Judul halaman, sekarang berada langsung di atas latar abu-abu --}}
        <div class="text-center">
            <h2 class="text-4xl font-extrabold text-gray-900">
                Buat Pesanan Baru
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Lengkapi detail di bawah untuk memesan jadwal Anda.
            </p>
        </div>

        <form method="POST" action="{{ route('admin.pesanan-offline.store') }}">
            @csrf
            <div class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="field_selector" class="block text-sm font-medium text-gray-700 mb-2">1. Pilih Lapangan</label>
                        <select id="field_selector" name="field_id" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required>
    <option value="" disabled selected>-- Pilih Jenis Lapangan --</option>
    @foreach ($lapangans as $lapangan)
        <option value="{{ $lapangan->id }}" 
                data-price="{{ $lapangan->harga_per_jam }}" 
                data-price-weekend="{{ $lapangan->harga_weekend_per_jam }}">
            
            {{-- PERBAIKAN: Menampilkan nama, harga weekday, dan harga weekend --}}
            {{ $lapangan->nama }} (Wd: Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} | We: Rp {{ number_format($lapangan->harga_weekend_per_jam, 0, ',', '.') }})
        </option>
    @endforeach
</select>
                        @error('field_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="date_selector" class="block text-sm font-medium text-gray-700 mb-2">2. Pilih Tanggal</label>
                        <input type="date" id="date_selector" name="booking_date" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required />
                        @error('booking_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div id="slot_waktu_section" class="hidden">
                    <div class="flex items-center mb-4">
                        <label class="block text-sm font-medium text-gray-700">3. Pilih Slot Waktu</label>
                        <div id="loading_spinner" class="hidden ml-3">
                            <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </div>
                    </div>
                    
                    <div id="time-slots-container" class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-7 gap-3">
                        @foreach ($slotWaktus as $slot)
                            <label>
                                <input type="checkbox" name="slot_ids[]" value="{{ $slot->id }}" class="sr-only slot-checkbox" data-slot-id="{{ $slot->id }}" />
                                <div class="slot-button text-center py-3 px-2 border border-gray-300 rounded-lg transition duration-200 cursor-pointer text-sm font-medium text-gray-700 bg-white disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed"
                                     data-time="{{ \Carbon\Carbon::parse($slot->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->jam_selesai)->format('H:i') }}">
                                    {{ \Carbon\Carbon::parse($slot->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->jam_selesai)->format('H:i') }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('slot_ids') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="pt-8 border-t border-gray-200 space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Rincian Pesanan</h3>
                        <div class="mt-4 space-y-2">
                            <div class="flex justify-between items-center text-gray-600">
                                <span>Total Jam Dipesan:</span>
                                <span id="total-hours" class="font-bold text-gray-900">0 Jam</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600">
                                <span>Total Harga:</span>
                                <span id="total-price" class="font-bold text-lg text-blue-600">Rp 0</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="w-full bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 font-bold text-lg transition-transform transform hover:scale-105">
                            Lanjutkan ke Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Mengambil semua elemen yang dibutuhkan dari halaman
    const fieldSelector = document.getElementById('field_selector');
    const dateSelector = document.getElementById('date_selector');
    const slotsContainer = document.getElementById('time-slots-container');
    const loadingSpinner = document.getElementById('loading_spinner');
    const slotWaktuSection = document.getElementById('slot_waktu_section');
    const totalHoursEl = document.getElementById('total-hours');
    const totalPriceEl = document.getElementById('total-price');

    // Mengatur tanggal minimal di date picker menggunakan data dari controller
    dateSelector.min = '{{ $tanggalHariIni ?? now()->toDateString() }}';

    // Fungsi untuk memeriksa ketersediaan slot dari server
    async function checkAvailability() {
        const fieldId = fieldSelector.value;
        const date = dateSelector.value;
        if (!fieldId || !date) {
            slotWaktuSection.classList.add('hidden');
            return;
        }
        slotWaktuSection.classList.remove('hidden');
        loadingSpinner.classList.remove('hidden');
        
        // Reset semua pilihan slot saat tanggal atau lapangan berubah
        slotsContainer.querySelectorAll('.slot-checkbox').forEach(checkbox => {
            checkbox.checked = false;
            checkbox.nextElementSibling.classList.remove('bg-blue-600', 'text-white');
        });

        try {
            const response = await fetch(`{{ url('/api/check-availability') }}?field_id=${fieldId}&date=${date}`);
            const data = await response.json();
            const bookedSlotIds = data.booked_slot_ids;

            slotsContainer.querySelectorAll('.slot-checkbox').forEach(checkbox => {
                const slotButton = checkbox.nextElementSibling;
                const isBooked = bookedSlotIds.includes(parseInt(checkbox.dataset.slotId));
                
                checkbox.disabled = isBooked;
                slotButton.textContent = isBooked ? 'Booked' : slotButton.dataset.time;
                
                // Reset style 'disabled' sebelum menerapkannya lagi
                slotButton.classList.remove('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                if (isBooked) {
                    slotButton.classList.add('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                }
            });

        } catch (error) { 
            console.error('Gagal mengambil data ketersediaan:', error); 
        } finally { 
            loadingSpinner.classList.add('hidden'); 
            updatePrice(); 
        }
    }

    // Fungsi untuk mengupdate rincian harga secara real-time
    function updatePrice() {
        const selectedSlots = slotsContainer.querySelectorAll('.slot-checkbox:checked');
        const selectedFieldOption = fieldSelector.options[fieldSelector.selectedIndex];
        const selectedDateValue = dateSelector.value;
        
        let pricePerHour = 0;
        // Pastikan lapangan dan tanggal sudah dipilih
        if (selectedDateValue && selectedFieldOption.value) {
            const selectedDate = new Date(selectedDateValue + 'T00:00:00'); 
            const day = selectedDate.getDay(); // 0 = Minggu, 6 = Sabtu

            // Cek apakah weekend atau weekday
            if (day === 0 || day === 6) {
                pricePerHour = parseInt(selectedFieldOption.dataset.priceWeekend) || 0;
            } else {
                pricePerHour = parseInt(selectedFieldOption.dataset.price) || 0;
            }
        }
        
        totalHoursEl.textContent = `${selectedSlots.length} Jam`;
        totalPriceEl.textContent = `Rp ${ (selectedSlots.length * pricePerHour).toLocaleString('id-ID') }`;
    }
    
    // Event listener untuk menangani klik pada tombol slot waktu
    slotsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('slot-button') && !e.target.previousElementSibling.disabled) {
            const checkbox = e.target.previousElementSibling;
            e.preventDefault();
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                e.target.classList.add('bg-blue-600', 'text-white');
            } else {
                e.target.classList.remove('bg-blue-600', 'text-white');
            }

            updatePrice();
        }
    });

    // Memasang event listener ke input lapangan dan tanggal
    fieldSelector.addEventListener('change', checkAvailability);
    dateSelector.addEventListener('change', checkAvailability);
});
</script>
@endpush