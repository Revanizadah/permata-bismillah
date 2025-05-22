<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';
    protected $fillable = [
        'no_pesanan',
        'nama_pemesan',
        'metode_pembayaran',
        'status_pembayaran',
        'jumlah_pembayaran',
        'bukti_pembayaran',
        'catatan',
    ];
}
