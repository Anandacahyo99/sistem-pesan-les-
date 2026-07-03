<?php

use App\Http\Controllers\Siswa\KelasController;
use App\Http\Controllers\Siswa\MateriSiswaController;
use App\Http\Controllers\Siswa\PembayaranController;
use App\Http\Controllers\Siswa\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::prefix('siswa')
    ->name('siswa.')
    ->middleware(['auth', 'role:siswa'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('siswa.dashboard');
        })->name('dashboard');

        Route::get('/daftar-kelas', [KelasController::class, 'index'])->name('kelas.kelas');
        Route::get('/daftar-kelas/{kelas}', [KelasController::class, 'show'])->name('kelas.detail-kelas');

        // LANGKAH 1: Tampilkan form pendaftaran/konfirmasi (GET)
        Route::get('/daftar-kelas/{kelas}/proses', [PendaftaranController::class, 'tampilkanFormPendaftaran'])->name('kelas.daftar.form');

        // LANGKAH 2: Submit data dari form pendaftaran ke database (POST)
        Route::post('/daftar-kelas/{kelas}/simpan', [PendaftaranController::class, 'daftarKelas'])->name('kelas.daftar.simpan');

        // LANGKAH 3: Tampilkan form halaman pembayaran (GET)
        Route::get('/pembayaran/{pendaftaranId}', [PembayaranController::class, 'tampilPembayaran'])->name('pendaftaran.pembayaran');

        // LANGKAH 4: Proses upload bukti transfer (POST)
        Route::post('/pembayaran/{pendaftaranId}/kirim', [PembayaranController::class, 'kirimPembayaran'])->name('pembayaran.kirim');

        // Tambahkan ini di dalam group route siswa
        Route::get('/ruang-kelas', [PendaftaranController::class, 'ruangKelas'])->name('kelas.ruang');

        //rute materi siswa
        Route::get('/kelas/{kelasId}/materi', [MateriSiswaController::class, 'index'])->name('materi.index');
    });
