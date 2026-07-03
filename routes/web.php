<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapAbsensiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/rekap-absensi', [RekapAbsensiController::class, 'index'])->name('rekap.absensi.index');
    Route::get('/rekap-absensi/export', [RekapAbsensiController::class, 'exportExcel'])->name('rekap.absensi.export');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/pengajar.php';
require __DIR__.'/siswa.php';