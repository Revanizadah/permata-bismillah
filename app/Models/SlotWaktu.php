<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SlotWaktu extends Model
{
    protected $table = 'slot_waktus';
    protected $fillable = [
       'jam_mulai',
       'jam_selesai',
    ];
}
