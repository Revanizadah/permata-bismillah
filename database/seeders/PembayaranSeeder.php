<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pembayarans')->insert([
            [
                'no_pesanan' => 'ORD001',
                'nama_pemesan' => 'Budi Santoso',
                'metode_pembayaran' => 'Transfer',
                'status_pembayaran' => 'pending',
                'jumlah_pembayaran' => '200000',
                'bukti_pembayaran' => null,
                'catatan' => 'Pembayaran awal',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_pesanan' => 'ORD002',
                'nama_pemesan' => 'Siti Aminah',
                'metode_pembayaran' => 'Cash',
                'status_pembayaran' => 'lunas',
                'jumlah_pembayaran' => '150000',
                'bukti_pembayaran' => null,
                'catatan' => 'Pembayaran di tempat',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'no_pesanan' => 'ORD003',
                'nama_pemesan' => 'Andi Wijaya',
                'metode_pembayaran' => 'Transfer',
                'status_pembayaran' => 'pending',
                'jumlah_pembayaran' => '300000',
                'bukti_pembayaran' => null,
                'catatan' => 'Menunggu konfirmasi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
