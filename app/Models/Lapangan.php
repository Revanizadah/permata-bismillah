<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lapangan extends Model
{
    use HasFactory;

    protected $table = 'lapangans';

    protected $fillable = [
        'nama_lapangan',
        'harga_per_jam',
        'status',
        'jenis_lapangan',
        'deskripsi',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
