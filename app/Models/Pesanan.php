<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';
    protected $fillable = [
        'nama_pemesan',
        'jenis_lapangan',
        'no_hp',
        'tanggal_pesan',
        'jam_mulai',
        'jam_selesai',
        'jumlah_jam',
        'status',
        'total_harga',
        'catatan',
    ];
}
