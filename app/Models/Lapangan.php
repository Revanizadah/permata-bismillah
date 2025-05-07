<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapangan extends Model
{
    use HasFactory, Notifiable;

    protected $table = "lapangans";
    protected $primaryKey = "id";
    protected $fillable = [
        "nama_lapangan",
        "harga_per_jam",
        "status",
        "jenis_lapangan",
        "status"


    ];
}
