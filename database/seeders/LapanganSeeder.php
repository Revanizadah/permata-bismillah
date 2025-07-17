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
                'nama' => 'Lapangan Futsal Rumput',
                'harga_per_jam' => 80000,
                'harga_weekend_per_jam' => 120000,
            ],
            [
                'nama' => 'Lapangan Futsal Sintetis',
                'harga_per_jam' => 100000,
                'harga_weekend_per_jam' => 180000,
            ],
            [
                'nama' => 'Lapangan Badminton ',
                'harga_per_jam' => 80000,
                'harga_weekend_per_jam' => 100000,

            ],
        ]);
    }
}
