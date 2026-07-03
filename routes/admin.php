<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PengajarController;
use App\Http\Controllers\Admin\PembayaranController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/kelas', [KelasController::class, 'index'])
            ->name('kelas');

        Route::get('/kelas/tambah', [KelasController::class, 'create'])
            ->name('kelas.create');

        Route::post('/kelas', [KelasController::class, 'store'])
            ->name('kelas.store');

        Route::get('/kelas/{kelas}/edit', [KelasController::class, 'edit'])->name('kelas.edit');
        Route::put('/kelas/{kelas}', [KelasController::class, 'update'])->name('kelas.update');

        // Tambahkan ini jika belum ada: Route Hapus Data
        Route::delete('/kelas/{kelas}', [KelasController::class, 'destroy'])->name('kelas.destroy');

        Route::resource('pengajar', PengajarController::class);

        Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');

        // Route aksi tombol setuju/tolak pembayaran
        Route::patch('/pembayaran/{id}/verifikasi', [PembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
    });


Route::resource('kelas', KelasController::class);
