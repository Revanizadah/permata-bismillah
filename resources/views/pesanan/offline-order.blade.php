@extends('layouts.app')

@section('title', 'Pemesanan Lapangan')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg max-w-4xl w-full mx-auto mt-12 mb-12">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Buat Pemesanan Baru</h2>

    {{-- Pastikan nama route ini sudah benar sesuai file routes/web.php Anda --}}
    <form method="POST" action="{{ route('pesanan.store') }}">
        @csrf

        <div class="mb-8">
            <label for="field_selector" class="block text-lg font-semibold text-gray-700 mb-3">1. Pilih Jenis Lapangan</label>
            <select id="field_selector" name="field_id" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-blue-400" required>
                <option value="" disabled selected>-- Pilih Lapangan --</option>
                @foreach ($lapangans as $lapangan)
                    <option value="{{ $lapangan->id }}" data-price="{{ $lapangan->harga_per_jam }}">
                        {{ $lapangan->nama }} (Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}/jam)
                    </option>
                @endforeach
            </select>
            @error('field_id')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label for="date_selector" class="block text-lg font-semibold text-gray-700 mb-3">2. Pilih Tanggal</label>
            <input type="date" id="date_selector" name="booking_date" class="w-full border border-gray-300 rounded-md p-3 focus:ring-2 focus:ring-blue-400" required />
            @error('booking_date')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div id="slot_waktu_section" class="mb-8 hidden">
            <div class="flex items-center mb-3">
                <label class="block text-lg font-semibold text-gray-700">3. Pilih Slot Waktu</label>
                <div id="loading_spinner" class="hidden ml-4">
                    <svg class="animate-spin h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
            
            <div id="time-slots-container" class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 gap-3">
                @if($slotWaktus->isEmpty())
                    <p class="text-center text-gray-500 col-span-full">Belum ada data slot waktu yang tersedia.</p>
                @else
                    @foreach ($slotWaktus as $slot)
                        <label for="slot-{{ $slot->id }}">
                            <input type="checkbox" id="slot-{{ $slot->id }}" name="slot_ids[]" value="{{ $slot->id }}" class="sr-only peer slot-checkbox" data-slot-id="{{ $slot->id }}" />
                            <div class="slot-button text-center py-3 px-2 border border-gray-300 rounded-md transition duration-200 ease-in-out hover:bg-blue-100 peer-checked:bg-blue-600 peer-checked:text-white peer-checked:shadow-lg hover:shadow-md cursor-pointer">
                                {{ \Carbon\Carbon::parse($slot->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->jam_selesai)->format('H:i') }}
                            </div>
                        </label>
                    @endforeach
                @endif
            </div>
             @error('slot_ids')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-10 p-4 border-t border-gray-200">
            <h3 class="text-xl font-semibold text-gray-800">Rincian Pesanan</h3>
            <div class="flex justify-between items-center mt-4">
                <span class="text-gray-600">Total Jam Dipesan:</span>
                <span id="total-hours" class="font-bold text-lg">0 Jam</span>
            </div>
            <div class="flex justify-between items-center mt-2">
                <span class="text-gray-600">Total Harga:</span>
                <span id="total-price" class="font-bold text-lg text-blue-600">Rp 0</span>
            </div>
        </div>

        <div class="text-center mt-6">
            <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 font-semibold text-lg transition-transform transform hover:scale-105">
                Buat Pesanan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fieldSelector = document.getElementById('field_selector');
    const dateSelector = document.getElementById('date_selector');
    const slotsContainer = document.getElementById('time-slots-container');
    const loadingSpinner = document.getElementById('loading_spinner');
    const slotWaktuSection = document.getElementById('slot_waktu_section');
    const totalHoursEl = document.getElementById('total-hours');
    const totalPriceEl = document.getElementById('total-price');

    async function checkAvailability() {
        const fieldId = fieldSelector.value;
        const date = dateSelector.value;

        // Jika lapangan atau tanggal belum dipilih, sembunyikan kembali section slot waktu
        if (!fieldId || !date) {
            slotWaktuSection.classList.add('hidden');
            return;
        }

        // Tampilkan section dan spinner loading
        slotWaktuSection.classList.remove('hidden');
        loadingSpinner.classList.remove('hidden');
        
        // Nonaktifkan semua checkbox sementara saat loading
        slotsContainer.querySelectorAll('.slot-checkbox').forEach(c => c.disabled = true);

        try {
            // Panggil API untuk mendapatkan slot yang sudah di-booking
            const response = await fetch(`{{ url('/api/check-availability') }}?field_id=${fieldId}&date=${date}`);
            if (!response.ok) throw new Error('Network response was not ok.');
            
            const data = await response.json();
            const bookedSlotIds = data.booked_slot_ids;

            slotsContainer.querySelectorAll('.slot-checkbox').forEach(checkbox => {
                const slotId = parseInt(checkbox.dataset.slotId);
                const slotButton = checkbox.parentElement.querySelector('.slot-button');
                const isBooked = bookedSlotIds.includes(slotId);

                if (isBooked) {
                    checkbox.disabled = true;
                    checkbox.checked = false; 
                    slotButton.classList.add('bg-gray-300', 'cursor-not-allowed', 'text-gray-500');
                    slotButton.classList.remove('hover:bg-blue-100', 'peer-checked:bg-blue-600');
                } else {
                    checkbox.disabled = false;
                    slotButton.classList.remove('bg-gray-300', 'cursor-not-allowed', 'text-gray-500');
                    slotButton.classList.add('hover:bg-blue-100', 'peer-checked:bg-blue-600');
                }
            });

        } catch (error) {
            console.error('Gagal mengambil data ketersediaan:', error);
            alert('Terjadi kesalahan saat memeriksa jadwal. Silakan coba lagi.');
        } finally {
            loadingSpinner.classList.add('hidden');
            updatePrice(); // Selalu update harga setelah selesai
        }
    }

    function updatePrice() {
        const selectedSlots = slotsContainer.querySelectorAll('.slot-checkbox:checked');
        const selectedFieldOption = fieldSelector.options[fieldSelector.selectedIndex];
        
        const pricePerHour = (selectedFieldOption && selectedFieldOption.dataset.price) 
                             ? parseInt(selectedFieldOption.dataset.price) 
                             : 0;
        
        const totalHours = selectedSlots.length;
        const totalPrice = totalHours * pricePerHour;
        
        totalHoursEl.textContent = `${totalHours} Jam`;
        totalPriceEl.textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    }

    // Event Listeners
    fieldSelector.addEventListener('change', () => {
        slotsContainer.querySelectorAll('.slot-checkbox').forEach(c => c.checked = false);
        checkAvailability();
    });
    dateSelector.addEventListener('change', checkAvailability);

    slotsContainer.addEventListener('change', function(e) {
        if (e.target.classList.contains('slot-checkbox')) {
            updatePrice();
        }
    });

    // Set tanggal minimal adalah hari ini
    dateSelector.min = new Date().toISOString().split("T")[0];
});
</script>
@endpush