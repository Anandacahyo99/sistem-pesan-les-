<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Hanya mengambil kelas yang berstatus 'aktif' beserta data pengajarnya
        $daftarKelas = Kelas::with('pengajar.user')
            ->where('status', 'aktif')
            ->latest()
            ->paginate(6); // Tampilkan 6 kelas per halaman

        return view('siswa.kelas.kelas', compact('daftarKelas'));
    }

    /**
     * Menampilkan detail kelas secara mendalam (Opsional).
     */
    public function show(Kelas $kelas)
    {
        // Pastikan kelas yang diintip berstatus aktif
        if ($kelas->status !== 'aktif') {
            abort(404);
        }

        $kelas->load('pengajar.user');
        return view('siswa.kelas.detail-kelas', compact('kelas'));
    }
}
