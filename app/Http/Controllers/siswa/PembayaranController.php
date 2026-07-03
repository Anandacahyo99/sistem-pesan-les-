<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{

    public function tampilPembayaran($pendaftaranId)
    {
        // Ambil data pendaftaran beserta relasi kelasnya agar bisa menampilkan total harga di halaman bayar
        $pendaftaran = Pendaftaran::with('kelas')->findOrFail($pendaftaranId);

        // Membuka file resources/views/siswa/kelas/pembayaran.blade.php atau lokasi file blade pembayaranmu
        return view('siswa.pendaftaran.pembayaran', compact('pendaftaran'));
    }
    
    public function kirimPembayaran(Request $request, $pendaftaranId)
{

    // 1. Data ditangkap oleh $request
    $request->validate([
        'nominal'     => 'required|numeric',
        'bukti_bayar' => 'required|image|max:2048', // Menangkap file berkat 'enctype'
    ]);

    // 2. File gambar disimpan ke folder storage
    $path = $request->file('bukti_bayar')->store('pembayaran', 'public');

    // 3. Data dimasukkan ke database tabel pembayaran
    Pembayaran::create([
        'pendaftaran_id' => $pendaftaranId, // Diambil dari variabel parameter di URL
        'nominal'        => $request->nominal,
        'bukti_bayar'    => $path,
        'status'         => 'menunggu',
    ]);

    return redirect()->route('siswa.dashboard')->with('success', 'Bukti bayar berhasil dikirim!');
}
}
