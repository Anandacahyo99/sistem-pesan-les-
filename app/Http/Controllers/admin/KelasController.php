<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Pengajar;
use Illuminate\Http\Request;


class KelasController extends Controller
{
    /**
     * Menampilkan daftar kelas.
     */
    public function index()
    {
        $kelas = Kelas::with('pengajar')
            ->latest()
            ->paginate(10);


        return view('admin.kelas', compact('kelas'));
    }

    /**
     * Form tambah kelas.
     */
    public function create()
    {
        $pengajars = Pengajar::all();

        return view('admin.kelas-tambah', compact('pengajars'));
    }

    /**
     * Simpan kelas baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|max:255',
            'pengajar_id' => 'required|exists:pengajars,id',
            'harga' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'deskripsi' => 'nullable',
            'status' => 'required'
        ]);

        Kelas::create($validated);

        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Detail kelas.
     */
    public function show(Kelas $kelas)
    {
        return view('admin.kelas.show', [
            'kelas' => $kelas->load('pengajar')
        ]);
    }

    /**
     * Form edit kelas.
     */
    /**
     * Form edit kelas.
     */
    public function edit(Kelas $kelas)
    {
        // Ambil semua data pengajar dengan relasi user-nya
        $pengajars = Pengajar::with('user')->get();

        // PERBAIKAN 1: Arahkan ke file view admin/edit-kelas.blade.php
        return view('admin.edit-kelas', [
            'kelas'     => $kelas,
            'pengajars' => $pengajars // Menggunakan jamak agar sinkron dengan blade
        ]);
    }

    /**
     * Update data kelas di database.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $validated = $request->validate([
            'nama_kelas'  => 'required|max:255',
            // PERBAIKAN 2: Jika pengajar opsional gunakan 'nullable', dan nama tabelnya 'pengajars' (pakai s)
            'pengajar_id' => 'nullable|exists:pengajars,id',
            'harga'       => 'required|numeric|min:0',
            // PERBAIKAN 3: Sesuaikan 'kapasitas' menjadi 'kuota' sesuai kolom migration kamu
            'kuota'       => 'required|integer|min:1',
            'deskripsi'   => 'nullable',
            'status'      => 'required|in:aktif,nonaktif'
        ]);

        // Lakukan update data
        $kelas->update($validated);

        // PERBAIKAN 4: Setelah sukses edit, kembalikan ke halaman daftar utama tabel kelas
        return redirect()
            ->route('admin.kelas')
            ->with('success', 'Kelas berhasil diperbarui.');
    }
    /**
     * Hapus kelas.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()
            ->back()
            ->with('success', 'Kelas berhasil dihapus.');
    }
}
