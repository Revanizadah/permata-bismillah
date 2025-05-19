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


                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Basket B',
                'harga_per_jam' => 150000,

                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lapangan' => 'Lapangan Badminton C',
                'harga_per_jam' => 80000,

                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
