<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $guarded = ['id'];
    protected $fillable = [
        'pesanan_id',
        'metode_pembayaran',
        'tanggal_pembayaran',
        'kode_pembayaran',
        'expired_at',
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];
    
    public function pesanan()
{
    return $this->belongsTo(Pesanan::class);
}
    
}
