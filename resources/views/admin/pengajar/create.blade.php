@extends('layouts.admin')

@section('title', 'Tambah Pengajar')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Tambah Pengajar Baru</h2>
        <a href="{{ route('admin.pengajar.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pengajar.store') }}">
                @csrf

                <h5 class="text-muted mb-3 border-b pb-2">🔒 Informasi Akun Login</h5>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password Sistem</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <h5 class="text-muted mt-4 mb-3 border-b pb-2">💼 Informasi Profil Pengajar</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">No. Handphone / WhatsApp</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" placeholder="Contoh: 08123456789" required>
                        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="keahlian" class="form-label">Bidang Keahlian / Spesialisasi</label>
                        <input type="text" name="keahlian" id="keahlian" class="form-control @error('keahlian') is-invalid @enderror" value="{{ old('keahlian') }}" placeholder="Contoh: Web Developer, Matematika SMA" required>
                        @error('keahlian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat rumah pengajar (Opsional)">{{ old('alamat') }}</textarea>
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pengajar.index') }}" class="btn btn-light border">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Data Pengajar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection