<?php

use App\Http\Controllers\Pengajar\AbsensiController;
use App\Http\Controllers\Pengajar\MateriController;
use Illuminate\Support\Facades\Route;

Route::prefix('pengajar')
    ->name('pengajar.')
    ->middleware(['auth', 'role:pengajar'])
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('pengajar.dashboard');
        })->name('dashboard');


        // Halaman pilih kelas
        Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');

        // Halaman lembar input absen (GET)
        Route::get('/absensi/kelas/{kelas}/proses', [AbsensiController::class, 'isiAbsensi'])->name('absensi.isi');

        // Proses simpan data absen (POST)
        Route::post('/absensi/kelas/{kelas}/simpan', [AbsensiController::class, 'simpanAbsensi'])->name('absensi.simpan');

        Route::get('/materi/pilih-kelas', [MateriController::class, 'pilihKelas'])->name('materi.pilih_kelas');

        //crud materi kelas 
        Route::get('/kelas/{kelasId}/materi', [MateriController::class, 'index'])->name('materi.index');
        Route::get('/kelas/{kelasId}/materi/create', [MateriController::class, 'create'])->name('materi.create');
        Route::post('/kelas/{kelasId}/materi', [MateriController::class, 'store'])->name('materi.store');
        Route::get('/kelas/{kelasId}/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
        Route::patch('/kelas/{kelasId}/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
        Route::delete('/kelas/{kelasId}/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
    });
