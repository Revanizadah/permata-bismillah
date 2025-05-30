<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $fillable = [
        'kode_transaksi',
        'pesanan_id',
        'tanggal',
        'jumlah',
        'metode',
        'bukti_pembayaran',
        'status',
        'catatan',
        'expired_at'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
    
}
