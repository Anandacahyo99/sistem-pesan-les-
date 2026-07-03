<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\MateriKelas;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriSiswaController extends Controller
{
    /**
     * Menampilkan daftar materi di dalam kelas yang diikuti siswa
     */
    public function index($kelasId)
{
    $pendaftaran = Pendaftaran::where('user_id', Auth::id())
        ->where('kelas_id', $kelasId)
        ->first();


    $cekAkses = Pendaftaran::where('user_id', Auth::id())
        ->where('kelas_id', $kelasId)
        ->whereIn('status', ['diterima', 'lunas'])
        ->exists();

    if (!$cekAkses) {
        abort(403, 'Anda belum terdaftar aktif di kelas ini atau pembayaran Anda belum diverifikasi.');
    }

    $kelas = Kelas::with('pengajar.user')->findOrFail($kelasId);

    $materis = MateriKelas::where('kelas_id', $kelasId)
        ->latest()
        ->get();

    return view('siswa.materi.index', compact('kelas', 'materis'));
}
}