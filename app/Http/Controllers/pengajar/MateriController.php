<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\MateriKelas;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{

    public function pilihKelas()
    {
        // Menarik data kelas sesuai dengan user pengajar yang sedang login
        $kelas = Kelas::whereHas('pengajar', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        return view('pengajar.materi.pilih-kelas', compact('kelas'));
    }
    /**
     * Mengecek apakah kelas ini benar diampu oleh pengajar yang login
     */
    private function otorisasiKelas($kelasId)
    {
        $pengajar = Auth::user()->pengajar;
        if (!$pengajar || !Kelas::where('id', $kelasId)->where('pengajar_id', $pengajar->id)->exists()) {
            abort(403, 'Anda tidak memiliki akses ke kelas ini.');
        }
    }

    /**
     * Menampilkan daftar materi berdasarkan Kelas
     */
    public function index($kelasId)
    {
        $this->otorisasiKelas($kelasId);
        $kelas = Kelas::findOrFail($kelasId);
        $materis = MateriKelas::where('kelas_id', $kelasId)->latest()->get();

        return view('pengajar.materi.index', compact('kelas', 'materis'));
    }

    /**
     * Form Tambah Materi
     */
    public function create($kelasId)
    {
        $this->otorisasiKelas($kelasId);
        $kelas = Kelas::findOrFail($kelasId);
        return view('pengajar.materi.create', compact('kelas'));
    }

    /**
     * Menyimpan Materi Baru (Upload File)
     */
    public function store(Request $request, $kelasId)
    {
        $this->otorisasiKelas($kelasId);

        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,docx,pptx,zip|max:10240', // Max 10MB
            'deskripsi' => 'nullable|string',
        ]);

        $path = null;
        if ($request->hasFile('file')) {
            // Menyimpan ke folder storage/app/public/materi
            $path = $request->file('file')->store('materi', 'public');
        }

        MateriKelas::create([
            'kelas_id' => $kelasId,
            'judul' => $request->judul,
            'file' => $path,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('pengajar.materi.index', $kelasId)->with('success', 'Materi berhasil diunggah!');
    }

    /**
     * Form Edit Materi
     */
    public function edit($kelasId, $id)
    {
        $this->otorisasiKelas($kelasId);
        $kelas = Kelas::findOrFail($kelasId);
        $materi = MateriKelas::where('kelas_id', $kelasId)->findOrFail($id);

        return view('pengajar.materi.edit', compact('kelas', 'materi'));
    }

    /**
     * Memperbarui Materi
     */
    public function update(Request $request, $kelasId, $id)
    {
        $this->otorisasiKelas($kelasId);
        $materi = MateriKelas::where('kelas_id', $kelasId)->findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,docx,pptx,zip|max:10240',
            'deskripsi' => 'nullable|string',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada file baru yang diunggah
            if ($materi->file) {
                Storage::disk('public')->delete($materi->file);
            }
            $data['file'] = $request->file('file')->store('materi', 'public');
        }

        $materi->update($data);

        return redirect()->route('pengajar.materi.index', $kelasId)->with('success', 'Materi berhasil diperbarui!');
    }

    /**
     * Menghapus Materi beserta Filenya
     */
    public function destroy($kelasId, $id)
    {
        $this->otorisasiKelas($kelasId);
        $materi = MateriKelas::where('kelas_id', $kelasId)->findOrFail($id);

        // Hapus file fisik dari storage
        if ($materi->file) {
            Storage::disk('public')->delete($materi->file);
        }

        $materi->delete();

        return redirect()->route('pengajar.materi.index', $kelasId)->with('success', 'Materi berhasil dihapus!');
    }
}