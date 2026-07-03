@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <h2>Verifikasi Pembayaran Masuk</h2>
        <p class="text-muted">Periksa bukti transfer siswa dan lakukan verifikasi status pendaftaran.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60">No</th>
                        <th>Siswa</th>
                        <th>Kelas Yang Dipilih</th>
                        <th>Nominal Transfer</th>
                        <th width="150">Bukti Bayar</th>
                        <th>Status</th>
                        <th width="280">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pembayarans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $item->pendaftaran->user->name ?? 'Siswa Terhapus' }}</strong><br>
                            <span class="text-muted text-xs">{{ $item->pendaftaran->user->email ?? '-' }}</span>
                        </td>
                        <td>{{ $item->pendaftaran->kelas->nama_kelas ?? 'Kelas Terhapus' }}</td>
                        <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>
                            @if($item->bukti_bayar)
                                <a href="{{ asset('storage/' . $item->bukti_bayar) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $item->bukti_bayar) }}" alt="Bukti Transfer" class="img-thumbnail" style="max-height: 80px;">
                                </a>
                            @else
                                <span class="text-danger">Tidak ada file</span>
                            @endif
                        </td>
                        <td>
                            {{-- PERBAIKAN SINKRONISASI: Menggunakan 'diterima' sesuai dengan update data di Controller --}}
                            @if($item->status == 'menunggu' || $item->status == 'menunggu_verifikasi')
                                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                            @elseif($item->status == 'diterima' || $item->status == 'lunas')
                                <span class="badge bg-success">Lunas / Aktif</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'menunggu' || $item->status == 'menunggu_verifikasi')
                                <form action="{{ route('admin.pembayaran.verifikasi', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    {{-- Value dikirim 'lunas' karena divalidasi oleh Controller, nanti controller yang mengubahnya menjadi 'diterima' --}}
                                    <input type="hidden" name="status" value="lunas">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui pembayaran ini?')">
                                        ✔ Setujui
                                    </button>
                                </form>

                                <form action="{{ route('admin.pembayaran.verifikasi', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="ditolak">
                                    <div class="input-group input-group-sm mt-1">
                                        <input type="text" name="catatan" placeholder="Alasan ditolak..." class="form-control" required>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak pembayaran ini?')">
                                            ❌ Tolak
                                        </button>
                                    </div>
                                </form>
                            @else
                                <span class="text-muted text-sm">Selesai diperiksa ({{ $item->catatan }})</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada riwayat pendaftaran atau pembayaran dari siswa.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            @if(method_exists($pembayarans, 'links'))
                <div class="d-flex justify-content-end mt-3">
                    {{ $pembayarans->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection