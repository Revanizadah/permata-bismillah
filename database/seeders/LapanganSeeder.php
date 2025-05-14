<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        DB::table('lapangans')->insert([
            [
                'nama_lapangan' => 'Lapangan Futsal A',
                'harga_per_jam' => 100000,
                'status' => 'tersedia',
                'jenis_lapangan' => 'futsal',
                'deskripsi' => 'Lapangan futsal dengan rumput sintetis berkualitas tinggi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Basket B',
                'harga_per_jam' => 150000,
                'status' => 'tersedia',
                'jenis_lapangan' => 'basket',
                'deskripsi' => 'Lapangan basket indoor dengan fasilitas lengkap.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Badminton C',
                'harga_per_jam' => 80000,
                'status' => 'tidak tersedia',
                'jenis_lapangan' => 'badminton',
                'deskripsi' => 'Lapangan badminton dengan lantai kayu berkualitas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
