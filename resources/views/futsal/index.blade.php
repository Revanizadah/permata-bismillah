<div class="container">
            <section class="reservation-management">
                <h1>Pemesanan Lapangan Futsal</h1>

                <!-- Pilihan Tanggal -->
                <div class="mb-5">
                    <label for="tanggal" class="font-semibold">Tanggal</label>
                    <input type="date" id="tanggal" class="form-control mt-2 w-48" required />
                </div>

                <!-- Court Selection with Availability Status -->
                <div class="court-options">
                    <button class="court-btn available">Lapangan 1 Sintetis</button>
                    <button class="court-btn unavailable">Lapangan 2 Multicourt</button>
                </div>

                <!-- Time Slot Availability -->
                <div class="time-slots">
                    <h3>Jam</h3>
                    <div class="time-slot-grid">
                        <!-- Available slots: Create a grid of buttons for time slots -->
                        @foreach (range(7, 22) as $hour)
                            <div class="time-slot">
                                <button class="slot-btn {{ $hour == 8 ? 'unavailable' : 'available' }}" data-time="{{ sprintf('%02d', $hour) }}:00">
                                    {{ sprintf('%02d', $hour) }}:00
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Simpan Pesanan button -->
                <div class="off-btn">
                    <button class="btn-off">Simpan Pesanan</button>
                </div>
            </section>
        </div>
