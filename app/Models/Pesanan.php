<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $fillable = [
        'nama_pemesan',
        'jenis_lapangan',
        'no_hp',
        'tanggal_pesan',
        'jam_pesan',
        'status',
        'catatan',
    ];
}
