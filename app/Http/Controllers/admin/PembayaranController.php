<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    /**
     * Menampilkan semua data pembayaran masuk (perlu verifikasi)
     */
    public function index()
    {
        // Eager load ke pendaftaran, siswa (user), dan kelas terkait
        $pembayarans = Pembayaran::with(['pendaftaran.user', 'pendaftaran.kelas'])
            ->latest()
            ->paginate(10);

        return view('admin.pembayaran.index', compact('pembayarans'));
    }

    /**
     * Memproses verifikasi persetujuan atau penolakan pembayaran
     */
    public function verifikasi(Request $request, $id)
    {
        // Tetap validasi input dari form Blade ('lunas' atau 'ditolak')
        $request->validate([
            'status' => 'required|in:lunas,ditolak',
            'catatan' => 'nullable|string|max:255'
        ]);

        $pembayaran = Pembayaran::with(['pendaftaran.kelas'])->findOrFail($id);

        // Gunakan Database Transaction agar jika salah satu update gagal, data di-rollback (aman)
        DB::beginTransaction();

        try {
            if ($request->status === 'lunas') {
                // 1. PERBAIKAN: Update status pembayaran jadi 'diterima' agar lolos CHECK constraint SQLite
                $pembayaran->update([
                    'status' => 'diterima', 
                    'catatan' => $request->catatan ?? 'Pembayaran valid dan disetujui.'
                ]);

                // 2. PERBAIKAN: Update status pendaftaran menjadi 'diterima' (sesuai enum pendaftarans)
                $pembayaran->pendaftaran->update([
                    'status' => 'diterima'
                ]);

                // 3. Potong kuota kelas secara otomatis
                $pembayaran->pendaftaran->kelas->decrement('kuota');

                $message = 'Pembayaran berhasil disetujui. Kelas siswa kini telah aktif!';
            } else {
                // Jika status === 'ditolak'
                // 1. Update status pembayaran jadi 'ditolak'
                $pembayaran->update([
                    'status' => 'ditolak',
                    'catatan' => $request->catatan ?? 'Pembayaran ditolak. Bukti tidak valid.'
                ]);

                // 2. PERBAIKAN: Update status pendaftaran menjadi 'ditolak' (sesuai enum pendaftarans)
                $pembayaran->pendaftaran->update([
                    'status' => 'ditolak'
                ]);

                $message = 'Pembayaran telah ditolak.';
            }

            DB::commit();
            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}