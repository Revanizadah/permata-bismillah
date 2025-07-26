<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pembayaran;
use Carbon\Carbon;

class BatalkanPesananKedaluwarsa extends Command
{
    /**
     * Nama dan signature dari command di terminal.
     * @var string
     */
    protected $signature = 'pesanan:batalkan-kedaluwarsa';

    /**
     * Deskripsi dari command.
     * @var string
     */
    protected $description = 'Mencari dan membatalkan pesanan yang pembayarannya sudah kedaluwarsa';

    /**
     * Jalankan logika command.
     */
    public function handle()
    {
        $this->info('Mulai memeriksa pembayaran yang kedaluwarsa...');

        // 1. Cari semua pembayaran yang statusnya 'unpaid' DAN sudah melewati batas waktu
        $pembayaranKedaluwarsa = Pembayaran::where('status_pembayaran', 'unpaid')
                                           ->where('expired_at', '<', Carbon::now())
                                           ->get();

        if ($pembayaranKedaluwarsa->isEmpty()) {
            $this->info('Tidak ada pembayaran kedaluwarsa yang ditemukan.');
            return;
        }

        foreach ($pembayaranKedaluwarsa as $pembayaran) {
            // Update status pembayaran menjadi 'expired'
            $pembayaran->status_pembayaran = 'expired';
            $pembayaran->save();

            // Update status pesanan terkait menjadi 'cancelled'
            $pembayaran->pesanan->status = 'cancelled';
            $pembayaran->pesanan->save();

            $this->warn("Pesanan dengan kode {$pembayaran->kode_pembayaran} telah dibatalkan.");
        }

        $this->info('Proses pembatalan pesanan kedaluwarsa selesai.');
    }
}