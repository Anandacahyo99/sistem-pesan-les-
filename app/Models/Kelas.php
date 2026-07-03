<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = [
        'pengajar_id',
        'nama_kelas',
        'deskripsi',
        'harga',
        'kuota',
        'status',
    ];

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class);
    }

    public function jadwalKelas()
    {
        return $this->hasMany(JadwalKelas::class);
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function materiKelas()
    {
        return $this->hasMany(MateriKelas::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}