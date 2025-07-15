<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';

   protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal_pesan',
        'waktu_mulai',
        'waktu_selesai',
        'jumlah_jam',
        'total_harga',
        'status',
        'catatan',
    ];

   public function user()
{
    return $this->belongsTo(User::class);
}

public function lapangan()
{
    return $this->belongsTo(Lapangan::class);
}

public function pembayaran()
{
    return $this->hasOne(Pembayaran::class);
}

public function detailPemesanan()
{
    return $this->hasMany(DetailPesanan::class);
}
}
