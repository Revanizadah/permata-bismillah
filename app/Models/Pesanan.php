<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';

   protected $fillable = [
        'user_id',
        'lapangan_id',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'jumlah_jam',
        'total_harga',
        'status',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'lapangan_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class, 'pesanan_id');
    }
}
