<?php

namespace App\Http\Controllers\Pengajar;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{


    public function index()
    {
        // Mengambil kelas yang diampu pengajar berdasarkan user_id yang sedang login saat ini
        $kelas = Kelas::whereHas('pengajar', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        // Jika ingin tetap memunculkan pesan peringatan bila akun login tidak terdaftar sebagai pengajar:
        if ($kelas->isEmpty() && !Auth::user()->pengajar) {
            return view('pengajar.absensi.index', compact('kelas'))
                ->with('error', 'Profil pengajar Anda tidak ditemukan di sistem atau belum ditugaskan ke kelas manapun.');
        }

        return view('pengajar.absensi.index', compact('kelas'));
    }

    /**
     * Menampilkan lembar kerja absensi siswa
     */
    public function isiAbsensi(Request $request, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $tanggal = $request->get('tanggal', date('Y-m-d'));

        // Ambil siswa yang status pendaftarannya sudah disetujui ('diterima')
        $siswas = Pendaftaran::with('user')
            ->where('kelas_id', $kelasId)
            ->where('status', 'diterima')
            ->get()
            ->pluck('user')
            ->filter(); // Menghilangkan data null jika user terhapus

        // Mengambil histori absen yang sudah diisi di tanggal terpilih (untuk default checked)
        $absensiExisting = Absensi::where('kelas_id', $kelasId)
            ->where('tanggal', $tanggal)
            ->get()
            ->pluck('status', 'user_id');

        return view('pengajar.absensi.isi', compact('kelas', 'siswas', 'tanggal', 'absensiExisting'));
    }

    /**
     * Memproses penyimpanan / update massal data absensi
     */
    public function simpanAbsensi(Request $request, $kelasId)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'absensi' => 'required|array',
            // Jika di validation masih menggunakan huruf kapital, biarkan saja tidak apa-apa
            'absensi.*' => 'required|in:Hadir,Izin,Sakit,Alpa,hadir,izin,sakit,alpa',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->absensi as $userId => $status) {
                Absensi::updateOrCreate(
                    [
                        'kelas_id' => $kelasId,
                        'user_id'  => $userId,
                        'tanggal'  => $request->tanggal,
                    ],
                    [
                        'status'   => strtolower($status),
                    ]
                );
            }

            DB::commit();
            return redirect()->route('pengajar.absensi.index')->with('success', 'Rekam absensi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
