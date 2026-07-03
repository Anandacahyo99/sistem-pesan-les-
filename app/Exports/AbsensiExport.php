<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AbsensiExport implements FromQuery, WithHeadings, WithMapping
{
    protected $kelasId;
    protected $tanggal;

    // Menerima filter dari Controller agar bisa download per kelas atau per tanggal
    public function __construct($kelasId = null, $tanggal = null)
    {
        $this->kelasId = $kelasId;
        $this->tanggal = $tanggal;
    }

    public function query()
    {
        $query = Absensi::with(['kelas', 'user']);

        if ($this->kelasId) {
            $query->where('kelas_id', $this->kelasId);
        }

        if ($this->tanggal) {
            $query->where('tanggal', $this->tanggal);
        }

        return $query->latest('tanggal');
    }

    // Menentukan Judul Kolom Excel
    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Kelas',
            'Nama Siswa',
            'Email Siswa',
            'Status Kehadiran',
        ];
    }

    // Memetakan data dari database ke kolom Excel
    public function map($absensi): array
    {
        return [
            $absensi->tanggal,
            $absensi->kelas->nama_kelas ?? 'Kelas Terhapus',
            $absensi->user->name ?? 'Siswa Terhapus',
            $absensi->user->email ?? '-',
            ucfirst($absensi->status), // Mengubah 'hadir' menjadi 'Hadir' di Excel
        ];
    }
}