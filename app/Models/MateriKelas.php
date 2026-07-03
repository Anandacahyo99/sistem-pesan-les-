<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriKelas extends Model
{
    protected $table = 'materi_kelas';

    protected $fillable = [
        'kelas_id',
        'judul',
        'file',
        'deskripsi',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}