<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'pendaftaran_id',
        'nominal',
        'bukti_bayar',
        'catatan',
        'status',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function pembayaran() {
        return $this->hasOne(Pembayaran::class, 'pendaftaran_id');
    }
}