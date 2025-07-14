<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'detail_pesanans';

    protected $fillable = [
        'pesanan_id',
        'slot_waktu_id',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function slotWaktu()
    {
        return $this->belongsTo(SlotWaktu::class);
    }
}
