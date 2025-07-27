@extends('layouts.app-user')

@section('title', 'Detail Pembayaran')

@section('content')
<div class="container mx-auto py-16 px-4 pt-28">
    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-8">
            {{-- Notifikasi Sukses/Error --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg" role="alert">
                    <p class="font-bold">Sukses!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg" role="alert">
                    <p class="font-bold">Gagal!</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            {{-- 1. KARTU DETAIL PESANAN --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 flex items-center space-x-4">
                    <img class="h-24 w-24 rounded-lg object-cover" src="{{ $pembayaran->pesanan->lapangan->gambar ? asset('images/' . $pembayaran->pesanan->lapangan->gambar) : 'https://via.placeholder.com/150' }}" alt="Foto Lapangan">
                    <div>
                        <p class="font-bold text-lg text-gray-900">{{ $pembayaran->pesanan->lapangan->nama }}</p>
                        <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($pembayaran->pesanan->tanggal_pesan)->isoFormat('dddd, D MMMM YYYY') }}</p>
                        <div class="flex flex-wrap gap-2 mt-2">
                            @foreach($pembayaran->pesanan->detailPemesanan as $detail)
                                <span class="bg-gray-200 rounded-full px-2 py-1 text-xs font-medium text-gray-700">
                                    {{ \Carbon\Carbon::parse($detail->slotWaktu->jam_mulai)->format('H:i') }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- 2. RINCIAN BIAYA & BATAS WAKTU --}}
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">Kode Pembayaran</p>
                        <p class="text-lg font-mono font-semibold text-gray-800">{{ $pembayaran->kode_pembayaran }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 text-right">Total Pembayaran</p>
                        <p class="text-3xl font-bold text-indigo-600">
                            Rp {{ number_format($pembayaran->pesanan->total_harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
                <div id="countdown-wrapper" class="text-xs text-center text-red-600 mt-4 bg-red-50 py-2 rounded-md">
                    Batas waktu pembayaran: <span class="font-bold" id="countdown-timer"></span>
                </div>
            </div>

            @if ($pembayaran->status_pembayaran == 'unpaid' && now()->lessThan($pembayaran->expired_at))
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekening Tujuan</h3>
                    <div class="space-y-3">
                        <div class="border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                            <div>
                                <p class="font-medium text-gray-700">Bank Central Asia (BCA)</p>
                                <div class="flex items-center space-x-3">
                                    <p id="bca-number" class="text-2xl font-bold text-gray-900 mt-1">123 456 7890</p>
                                    <button onclick="copyToClipboard('bca-number')" class="text-gray-500 hover:text-indigo-600">
                                        <i class="far fa-copy"></i>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">a.n. PT Permata Futsal Sejahtera</p>
                            </div>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia_logo.svg/1280px-Bank_Central_Asia_logo.svg.png" alt="BCA" class="h-6">
                        </div>
                        {{-- ... rekening lainnya bisa ditambahkan dengan pola yang sama ... --}}
                    </div>
                </div>

                {{-- 4. FORM UPLOAD BUKTI --}}
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Unggah Bukti Pembayaran</h3>
                    <form action="{{ route('user.pembayaran.upload', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-500 transition">
                            <label for="bukti_pembayaran" class="cursor-pointer">
                                <i id="upload-icon" class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                                <img id="image-preview" src="" alt="Preview" class="hidden mx-auto h-24 rounded-lg"/>
                                <p id="file-info" class="mt-2 text-sm text-gray-600">
                                    <span class="font-semibold text-indigo-600">Klik untuk memilih file</span> atau seret file ke sini.
                                </p>
                                <p class="text-xs text-gray-500 mt-1">PNG atau JPG (Maks. 2MB)</p>
                            </label>
                            <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only" required accept="image/png, image/jpeg">
                        </div>
                        @error('bukti_pembayaran')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror

                        <div class="mt-6">
                            <button type="submit" class="w-full bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 font-bold text-lg transition">
                                Konfirmasi Pembayaran
                            </button>
                        </div>
                    </form>
                </div>

            @elseif ($pembayaran->status_pembayaran == 'paid')
                <div class="text-center p-8 bg-green-50 border-2 border-dashed border-green-200 rounded-lg">
                    <i class="fas fa-check-circle text-5xl text-green-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800">Pembayaran Lunas</h3>
                    <p class="text-gray-600 mt-2">Terima kasih! Pesanan Anda telah dikonfirmasi. Sampai jumpa di lapangan!</p>
                    @if ($pembayaran->bukti_pembayaran)
                        <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank" class="mt-4 inline-block text-sm text-indigo-600 hover:underline">
                            Lihat Bukti Pembayaran
                        </a>
                    @endif
                </div>
            @else
                <div class="text-center p-8 bg-red-50 border-2 border-dashed border-red-200 rounded-lg">
                    <i class="fas fa-times-circle text-5xl text-red-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800">Pembayaran Kedaluwarsa</h3>
                    <p class="text-gray-600 mt-2">Batas waktu pembayaran untuk pesanan ini telah lewat. Silakan buat pesanan baru.</p>
                    <a href="{{ route('user.pesanan.create') }}" class="mt-6 inline-block bg-indigo-500 text-white font-bold py-2 px-5 rounded-lg hover:bg-indigo-600">
                        Buat Pesanan Baru
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('bukti_pembayaran');
    const fileInfo = document.getElementById('file-info');
    const uploadIcon = document.getElementById('upload-icon');
    const imagePreview = document.getElementById('image-preview');
    const originalText = fileInfo.innerHTML;

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                fileInfo.innerHTML = `<span class="font-semibold text-green-600">File terpilih:</span> ${file.name}`;
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    uploadIcon.classList.add('hidden');
                }
                reader.readAsDataURL(file);

            } else {
                fileInfo.innerHTML = originalText;
                imagePreview.classList.add('hidden');
                uploadIcon.classList.remove('hidden');
            }
        });
    }

    // ===============================================
    //         ✅ SCRIPT BARU DITAMBAHKAN DI SINI
    // ===============================================

    // 1. Fungsi untuk Tombol "Salin" Nomor Rekening
    window.copyToClipboard = function(elementId) {
        const textToCopy = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(textToCopy).then(() => {
            alert('Nomor rekening berhasil disalin!');
        }, (err) => {
            console.error('Gagal menyalin: ', err);
        });
    }

    // 2. Fungsi untuk Countdown Timer
    const countdownEl = document.getElementById('countdown-timer');
    if (countdownEl) {
        const expiredTime = new Date('{{ $pembayaran->expired_at->toIso8601String() }}').getTime();

        const timer = setInterval(function() {
            const now = new Date().getTime();
            const distance = expiredTime - now;

            if (distance < 0) {
                clearInterval(timer);
                document.getElementById('countdown-wrapper').innerHTML = '<span class="font-bold">Waktu pembayaran telah habis.</span>';
                return;
            }

            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            countdownEl.textContent = `${hours} jam ${minutes} menit ${seconds} detik`;
        }, 1000);
    }
});
</script>
@endpush