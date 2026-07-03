<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\Kelas; // Tambahkan ini untuk mengambil data kelas
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    // Fungsi baru: Menampilkan form siswa/pendaftaran/pendaftaran.blade.php
    public function tampilkanFormPendaftaran($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        // Membuka file resources/views/siswa/pendaftaran/pendaftaran.blade.php
        return view('siswa.pendaftaran.pendaftaran', compact('kelas'));
    }

    // Fungsi lama: Diubah rute redirect-nya agar sesuai dengan routes/web.php
    public function daftarKelas(Request $request, $kelas)
    {
        // Buat record pendaftaran manual awal setelah siswa klik tombol di dalam form pendaftaran
        $pendaftaran = Pendaftaran::create([
            'user_id'        => Auth::id(),
            'kelas_id'       => $kelas,
            'tanggal_daftar' => now(),
            'status'         => 'menunggu',
        ]);

        // Diarahkan ke rute pendaftaran.pembayaran
        return redirect()->route('siswa.pendaftaran.pembayaran', $pendaftaran->id)
            ->with('success', 'Pendaftaran berhasil dibuat, silakan lakukan pembayaran.');
    }

    public function ruangKelas()
    {
        $userId = Auth::id();

        // 1. Ambil kelas yang SUDAH DI-ACC (status: diterima)
        $kelasAktif = Pendaftaran::with(['kelas.pengajar.user'])
            ->where('user_id', $userId)
            ->where('status', 'diterima')
            ->latest()
            ->get();

        // 2. Ambil kelas yang BELUM DI-ACC (status: menunggu)
        $kelasPending = Pendaftaran::with(['kelas.pengajar.user','pembayaran'])
            ->where('user_id', $userId)
            ->where('status', 'menunggu')
            ->latest()
            ->get();

        // 3. Kirim kedua data ke view siswa/kelas/ruangkelas.blade.php
        return view('siswa.kelas.ruangkelas', compact('kelasAktif', 'kelasPending'));
    }
}
