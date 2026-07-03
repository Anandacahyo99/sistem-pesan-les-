<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Exports\AbsensiExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class RekapAbsensiController extends Controller
{
    public function index(Request $request)
    {
        $kelasId = $request->get('kelas_id');
        $tanggal = $request->get('tanggal');

        // Mengambil pilihan kelas untuk filter dropdown di view
        // Jika yang login Pengajar, batasi hanya kelas miliknya. Jika Admin, tampilkan semua.
        if (Auth::user()->hasRole('pengajar')) { 
            $pilihanKelas = Kelas::where('pengajar_id', Auth::user()->pengajar->id ?? 0)->get();
            
            // Pengaman: Jika pengajar mencoba melihat kelas orang lain lewat URL
            if ($kelasId && !in_array($kelasId, $pilihanKelas->pluck('id')->toArray())) {
                abort(403, 'Anda tidak berhak melihat kelas ini.');
            }
        } else {
            $pilihanKelas = Kelas::all(); // Admin bisa melihat semua kelas
        }

        // Query data absensi berdasarkan filter
        $query = Absensi::with(['kelas', 'user']);

        if ($kelasId) {
            $query->where('kelas_id', $kelasId);
        } elseif (Auth::user()->hasRole('pengajar')) {
            // Jika pengajar belum memilih kelas, default tampilkan semua kelas miliknya saja
            $query->whereIn('kelas_id', $pilihanKelas->pluck('id'));
        }

        if ($tanggal) {
            $query->where('tanggal', $tanggal);
        }

        $absensis = $query->latest('tanggal')->paginate(15)->withQueryString();

        return view('rekap-absensi.index', compact('absensis', 'pilihanKelas', 'kelasId', 'tanggal'));
    }

    public function exportExcel(Request $request)
    {
        $kelasId = $request->get('kelas_id');
        $tanggal = $request->get('tanggal');

        $namaFile = 'rekap-absensi-' . ($tanggal ?? date('Y-m-d')) . '.xlsx';

        // Menjalankan fungsi download Excel bawaan library
        return Excel::download(new AbsensiExport($kelasId, $tanggal), $namaFile);
    }
}