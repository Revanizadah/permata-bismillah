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

    public function handle()
    {
        $this->info('Mulai memeriksa pembayaran yang kedaluwarsa...');

        $pembayaranKedaluwarsa = Pembayaran::where('status_pembayaran', 'unpaid')
                                           ->where('expired_at', '<', Carbon::now())
                                           ->get();

        if ($pembayaranKedaluwarsa->isEmpty()) {
            $this->info('Tidak ada pembayaran kedaluwarsa yang ditemukan.');
            return;
        }

        foreach ($pembayaranKedaluwarsa as $pembayaran) {
            $pembayaran->status_pembayaran = 'expired';
            $pembayaran->save();

            $pembayaran->pesanan->status = 'cancelled';
            $pembayaran->pesanan->save();

            $this->warn("Pesanan dengan kode {$pembayaran->kode_pembayaran} telah dibatalkan.");
        }

        $this->info('Proses pembatalan pesanan kedaluwarsa selesai.');
    }
}