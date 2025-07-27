<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama',
        'ikon', // Opsional: untuk kelas ikon Font Awesome
    ];

    public function lapangans()
    {
        return $this->belongsToMany(Lapangan::class, 'fasilitas_lapangan');
    }
}
