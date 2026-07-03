<form method="POST" action="{{ route('admin.kelas') }}">
    @csrf

    <div class="form-group">
        <label for="pengajar_id">Pengajar</label>
        <select name="pengajar_id" id="pengajar_id" required>
            <option value="">-- Pilih Pengajar --</option>
            @foreach($pengajars as $pengajar)
                {{-- PERBAIKAN: Ambil properti 'name' dari relasi 'user' --}}
                <option value="{{ $pengajar->id }}">
                    {{ $pengajar->user->name ?? 'Pengajar Tanpa Nama' }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="nama_kelas">Nama Kelas</label>
        <input type="text" name="nama_kelas" id="nama_kelas" placeholder="Nama Kelas" required>
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi Kelas (Opsional)"></textarea>
    </div>

    <div class="form-group">
        <label for="harga">Harga</label>
        <input type="number" name="harga" id="harga" placeholder="Harga" required>
    </div>

    <div class="form-group">
        <label for="kuota">Kapasitas</label>
        <input type="number" name="kuota" id="kuota" placeholder="Kapasitas" required>
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="aktif" selected>Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>

    <button type="submit">
        Simpan
    </button>
</form>