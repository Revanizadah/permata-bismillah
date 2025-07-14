<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SlotWaktu;

class SlotWaktuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama untuk menghindari duplikasi saat seeding ulang
        // SlotWaktu::truncate();

        // Buat slot dari jam 8 pagi sampai jam 11 malam
        for ($hour = 8; $hour <= 23; $hour++) {
            SlotWaktu::create([
                'jam_mulai' => sprintf('%02d:00:00', $hour),
                'jam_selesai' => sprintf('%02d:00:00', $hour + 1 > 23 ? 0 : $hour + 1),
            ]);
        }
    }
}
