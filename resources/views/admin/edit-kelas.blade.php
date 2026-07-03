@extends('layouts.admin')

@section('title', 'Edit Kelas - ' . $kelas->nama_kelas)

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Edit Kelas: {{ $kelas->nama_kelas }}</h2>
        <a href="{{ route('admin.kelas') }}" class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.kelas.update', $kelas->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="pengajar_id" class="form-label">Pengajar</label>
                    <select name="pengajar_id" id="pengajar_id" class="form-select @error('pengajar_id') is-invalid @enderror">
                        <option value="">-- Tanpa Pengajar (Opsional) --</option>
                        @foreach($pengajars as $pengajar)
                            <option value="{{ $pengajar->id }}" 
                                {{ old('pengajar_id', $kelas->pengajar_id) == $pengajar->id ? 'selected' : '' }}>
                                {{ $pengajar->user->name ?? '-' }} ({{ $pengajar->keahlian }})
                            </option>
                        @endforeach
                    </select>
                    @error('pengajar_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="nama_kelas" class="form-label">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" 
                           class="form-control @error('nama_kelas') is-invalid @enderror" 
                           value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi Kelas</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" 
                              class="form-control @error('deskripsi') is-invalid @enderror" 
                              placeholder="Deskripsi Kelas (Opsional)">{{ old('deskripsi', $kelas->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input type="number" name="harga" id="harga" step="0.01" 
                               class="form-control @error('harga') is-invalid @enderror" 
                               value="{{ old('harga', $kelas->harga) }}" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="kuota" class="form-label">Kapasitas/Kuota</label>
                        <input type="number" name="kuota" id="kuota" 
                               class="form-control @error('kuota') is-invalid @enderror" 
                               value="{{ old('kuota', $kelas->kuota) }}" required>
                        @error('kuota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">Status Kelas</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="aktif" {{ old('status', $kelas->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $kelas->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.kelas') }}" class="btn btn-light border">Batal</a>
                    <button type="submit" class="btn btn-warning">Perbarui Kelas</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection