<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PengajarController extends Controller
{
    /**
     * 1. READ: Menampilkan daftar semua pengajar
     */
    public function index()
    {
        // Mengambil data pengajar beserta data user terkait (Nama & Email)
        $pengajars = Pengajar::with('user')->latest()->paginate(10);

        return view('admin.pengajar.index', compact('pengajars'));
    }

    /**
     * Tampilkan Form Tambah Pengajar (Opsional, pelengkap CRUD)
     */
    public function create()
    {
        return view('admin.pengajar.create');
    }

    /**
     * Simpan Pengajar Baru (Membuat User + Profil Pengajar sekaligus)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_hp'    => 'required|string|max:20',
            'keahlian' => 'required|string|max:255',
            'alamat'   => 'nullable|string',
        ]);

        // Gunakan Transaction agar jika salah satu gagal, semua di-rollback
        DB::beginTransaction();

        try {
            // 1. Buat akun di tabel users
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 2. Berikan role 'pengajar' dari Spatie langsung setelah user dibuat
            $user->assignRole('pengajar');

            // 3. Buat data profil di tabel pengajars
            Pengajar::create([
                'user_id'  => $user->id,
                'no_hp'    => $request->no_hp,
                'keahlian' => $request->keahlian,
                'alamat'   => $request->alamat,
            ]);

            // Jika semua berhasil, kunci perubahan ke database
            DB::commit();

            return redirect()->route('admin.pengajar.index')->with('success', 'Pengajar berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Jika ada yang error, batalkan semua data yang sempat masuk
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pengajar: ' . $e->getMessage());
        }
    }

    /**
     * 2. EDIT: Menampilkan form edit pengajar
     */
    public function edit(Pengajar $pengajar)
    {
        // Memuat relasi user agar datanya bisa dilempar ke form edit
        $pengajar->load('user');

        return view('admin.pengajar.edit', compact('pengajar'));
    }

    /**
     * UPDATE: Memperbarui data pengajar di database
     */
    public function update(Request $request, Pengajar $pengajar)
    {
        $user = $pengajar->user;

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8', // Password opsional saat edit
            'no_hp'    => 'required|string|max:20',
            'keahlian' => 'required|string|max:255',
            'alamat'   => 'nullable|string',
        ]);

        // Update data User Akun
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Update data Profil Pengajar
        $pengajar->update([
            'no_hp'    => $request->no_hp,
            'keahlian' => $request->keahlian,
            'alamat'   => $request->alamat,
        ]);

        return redirect()->route('admin.pengajar.index')->with('success', 'Data pengajar berhasil diperbarui.');
    }


    /**
     * 3. DESTROY: Menghapus data pengajar
     */
    public function destroy(Pengajar $pengajar)
    {
        // Karena di migration menggunakan ->cascadeOnDelete() pada user_id, 
        // menghapus data User otomatis akan menghapus profil Pengajarnya di database.
        $pengajar->user->delete();

        return redirect()->back()->with('success', 'Pengajar berhasil dihapus dari sistem.');
    }
}
