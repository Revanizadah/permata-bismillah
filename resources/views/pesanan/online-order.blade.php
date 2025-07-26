@extends('layouts.app-user')

@section('title', 'Pemesanan Lapangan')

@section('content')
<div class="py-12 px-4 sm:px-6 lg:px-8 pt-28">
    <div class="max-w-6xl w-full mx-auto">
        <form method="POST" action="{{ route('user.pesanan.store') }}">
            @csrf
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-10">

                    {{-- =============================================== --}}
                    {{-- KOLOM KIRI: PILIHAN LAPANGAN & RINCIAN --}}
                    {{-- =============================================== --}}
                    <div class="flex flex-col justify-between">
                        <div>
                            {{-- Header Form --}}
                            <div class="mb-8">
                                <h2 class="text-3xl font-extrabold text-gray-900">
                                    Buat Pesanan
                                </h2>
                                <p class="mt-2 text-sm text-gray-600">
                                    Pilih lapangan dan tanggal untuk melihat jadwal yang tersedia.
                                </p>
                            </div>

                            {{-- Pilihan Lapangan dengan Kartu --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">1. Pilih Lapangan</label>
                                <div id="field_selector" class="space-y-4">
                                    @forelse ($lapangans as $lapangan)
                                        <label class="block cursor-pointer">
                                            <input type="radio" name="field_id" value="{{ $lapangan->id }}" class="sr-only peer" required
                                                   data-price="{{ $lapangan->harga_per_jam }}"
                                                   data-price-weekend="{{ $lapangan->harga_weekend_per_jam }}">
                                            <div class="p-4 border border-gray-300 rounded-lg flex items-center space-x-4 transition duration-300 peer-checked:ring-2 peer-checked:ring-indigo-500 peer-checked:border-indigo-500 hover:bg-gray-50">
                                                <img src="{{ $lapangan->gambar ? asset('images/' . $lapangan->gambar) : 'https://via.placeholder.com/150' }}" alt="Foto {{ $lapangan->nama }}" class="w-24 h-24 rounded-md object-cover">
                                                <div class="flex-1">
                                                    <p class="font-bold text-lg text-gray-800">{{ $lapangan->nama }}</p>
                                                    {{-- Menampilkan Fasilitas --}}
                                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-600 mt-2">
                                                        @if($lapangan->fasilitas)
                                                            @foreach(explode(',', $lapangan->fasilitas) as $fasilitas)
                                                                <span class="flex items-center">
                                                                    <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                                                    {{ trim($fasilitas) }}
                                                                </span>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    @empty
                                        <p class="text-sm text-gray-500">Tidak ada lapangan yang tersedia.</p>
                                    @endforelse
                                </div>
                                @error('field_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Rincian Pesanan & Tombol Aksi --}}
                        <div id="rincian-section" class="pt-8 mt-8 border-t border-gray-200" style="display: none;">
                             <h3 class="text-lg font-semibold text-gray-900">Rincian Pesanan</h3>
                            <div class="mt-4 space-y-2">
                                <div class="flex justify-between items-center text-gray-600">
                                    <span>Total Jam Dipesan:</span>
                                    <span id="total-hours" class="font-bold text-gray-900">0 Jam</span>
                                </div>
                                <div class="flex justify-between items-center text-gray-600">
                                    <span>Total Harga:</span>
                                    <span id="total-price" class="font-bold text-lg text-indigo-600">Rp 0</span>
                                </div>
                            </div>
                            <div class="text-center mt-6">
                                <button type="submit" class="w-full bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 font-bold text-lg transition-transform transform hover:scale-105">
                                    Lanjutkan ke Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- =============================================== --}}
                    {{-- KOLOM KANAN: TANGGAL & SLOT WAKTU --}}
                    {{-- =============================================== --}}
                    <div class="bg-gray-50 p-6 rounded-lg border">
                        <div class="space-y-8">
                            <div>
                                <label for="date_selector" class="block text-sm font-medium text-gray-700 mb-2">2. Pilih Tanggal</label>
                                <input type="date" id="date_selector" name="booking_date" class="w-full border-gray-300 rounded-lg shadow-sm p-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition" required />
                                @error('booking_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Pilihan Slot Waktu --}}
                            <div id="slot_waktu_section" class="hidden">
                                <div class="flex items-center mb-4">
                                    <label class="block text-sm font-medium text-gray-700">3. Pilih Slot Waktu</label>
                                    <div id="loading_spinner" class="hidden ml-3">
                                        <svg class="animate-spin h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    </div>
                                </div>
                                <div id="time-slots-container" class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                                    @foreach ($slotWaktus as $slot)
                                        <label>
                                            <input type="checkbox" name="slot_ids[]" value="{{ $slot->id }}" class="sr-only slot-checkbox" data-slot-id="{{ $slot->id }}" />
                                            <div class="slot-button text-center py-3 px-2 border border-gray-300 rounded-lg transition duration-200 cursor-pointer text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed"
                                                 data-time="{{ \Carbon\Carbon::parse($slot->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->jam_selesai)->format('H:i') }}">
                                                {{ \Carbon\Carbon::parse($slot->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->jam_selesai)->format('H:i') }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('slot_ids') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
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
    const fieldSelectorContainer = document.getElementById('field_selector');
    const dateSelector = document.getElementById('date_selector');
    const slotsContainer = document.getElementById('time-slots-container');
    const loadingSpinner = document.getElementById('loading_spinner');
    const slotWaktuSection = document.getElementById('slot_waktu_section');
    const rincianSection = document.getElementById('rincian-section');
    const totalHoursEl = document.getElementById('total-hours');
    const totalPriceEl = document.getElementById('total-price');

    dateSelector.min = '{{ $tanggalHariIni ?? now()->toDateString() }}';

    async function checkAvailability() {
        const selectedRadio = fieldSelectorContainer.querySelector('input[name="field_id"]:checked');
        const fieldId = selectedRadio ? selectedRadio.value : null;
        const date = dateSelector.value;
        if (!fieldId || !date) {
            slotWaktuSection.classList.add('hidden');
            return;
        }
        slotWaktuSection.classList.remove('hidden');
        loadingSpinner.classList.remove('hidden');
        
        try {
            const response = await fetch(`{{ url('/api/check-availability') }}?field_id=${fieldId}&date=${date}`);
            const data = await response.json();
            const bookedSlotIds = data.booked_slot_ids;

            slotsContainer.querySelectorAll('.slot-checkbox').forEach(checkbox => {
                const slotButton = checkbox.nextElementSibling;
                const isBooked = bookedSlotIds.includes(parseInt(checkbox.dataset.slotId));
                checkbox.disabled = isBooked;
                slotButton.textContent = isBooked ? 'Booked' : slotButton.dataset.time;
                
                slotButton.classList.remove('bg-blue-600', 'text-white', 'bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                checkbox.checked = false;

                if (isBooked) {
                    slotButton.classList.add('bg-gray-200', 'text-gray-400', 'cursor-not-allowed');
                }
            });
        } catch (error) { console.error('Gagal mengambil data ketersediaan:', error); }
        finally { loadingSpinner.classList.add('hidden'); updatePrice(); }
    }

    function updatePrice() {
        const selectedSlots = slotsContainer.querySelectorAll('.slot-checkbox:checked');
        const selectedRadio = fieldSelectorContainer.querySelector('input[name="field_id"]:checked');
        const selectedDateValue = dateSelector.value;
        let pricePerHour = 0;

        if (selectedDateValue && selectedRadio) {
            const selectedDate = new Date(selectedDateValue + 'T00:00:00'); 
            const day = selectedDate.getDay();
            if (day === 0 || day === 6) {
                pricePerHour = parseInt(selectedRadio.dataset.priceWeekend) || 0;
            } else {
                pricePerHour = parseInt(selectedRadio.dataset.price) || 0;
            }
        }
        
        if (selectedSlots.length > 0) {
            rincianSection.style.display = 'block';
        } else {
            rincianSection.style.display = 'none';
        }
        
        totalHoursEl.textContent = `${selectedSlots.length} Jam`;
        totalPriceEl.textContent = `Rp ${ (selectedSlots.length * pricePerHour).toLocaleString('id-ID') }`;
    }
    
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

    fieldSelectorContainer.addEventListener('change', checkAvailability);
    dateSelector.addEventListener('change', checkAvailability);
});
</script>
@endpush