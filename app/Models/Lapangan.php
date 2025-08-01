<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangans';

    protected $fillable = [
        'nama',
        'harga_per_jam',
        'harga_weekend_per_jam',
        'gambar'
    ];

    public function slotWaktus()
    {
        return $this->hasMany(SlotWaktu::class, 'lapangan_id');
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_lapangan');
    }
}
