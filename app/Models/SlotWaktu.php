<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    protected $table = 'slot_waktu';
    protected $fillable = [
        'nama_lapangan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
    ];
}
