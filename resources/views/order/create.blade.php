@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pemesanan Lapangan</h2>
    <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="lapangan_id">Pilih Lapangan</label>
            <select name="lapangan_id" id="lapangan_id" class="form-control">
                @foreach($lapangans as $lapangan)
                    <option value="{{ $lapangan->id }}">{{ $lapangan->nama_lapangan }} ({{ $lapangan->jenis_lapangan }} - Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}/jam)</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="jam">Jam Pemesanan</label>
            <input type="time" name="jam" id="jam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="notes">Catatan</label>
            <textarea name="notes" id="notes" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="total_harga">Total Harga</label>
            <input type="text" name="total_harga" id="total_harga" class="form-control" readonly>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Pesan Lapangan</button>
        </div>
    </form>
</div>

<script>
    // Menampilkan total harga berdasarkan jenis lapangan dan jam yang dipilih
    document.getElementById('lapangan_id').addEventListener('change', function() {
        var lapangan = this.options[this.selectedIndex];
        var harga = lapangan.getAttribute('data-harga');
        var jam = document.getElementById('jam').value;
        var totalHarga = harga * jam;
        document.getElementById('total_harga').value = 'Rp ' + totalHarga.toLocaleString();
    });

    document.getElementById('jam').addEventListener('input', function() {
        var lapangan = document.getElementById('lapangan_id').options[document.getElementById('lapangan_id').selectedIndex];
        var harga = lapangan.getAttribute('data-harga');
        var jam = this.value;
        var totalHarga = harga * jam;
        document.getElementById('total_harga').value = 'Rp ' + totalHarga.toLocaleString();
    });
</script>
@endsection
