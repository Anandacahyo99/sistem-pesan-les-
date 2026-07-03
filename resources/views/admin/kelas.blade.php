@extends('layouts.admin')

@section('title', 'Data Kelas')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Kelas</h2>

        <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary">
            + Tambah Kelas
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Kelas</th>
                        <th>Pengajar</th>
                        <th>Harga</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($kelas as $item)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $item->nama_kelas }}
                        </td>

                        <td>
                            {{ $item->pengajar->user->name ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $item->kuota }}
                        </td>

                        <td>
                            @if($item->status == 'aktif')
                                <span class="badge bg-success">
                                    Aktif
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('admin.kelas.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.kelas.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $item->nama_kelas }}?')">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data kelas
                        </td>
                    </tr>

                @endforelse

                </tbody>
            </table>

            @if(method_exists($kelas, 'links'))
                <div class="d-flex justify-content-end mt-3">
                    {{ $kelas->links() }}
                </div>
            @endif

        </div>
    </div>

</div>
@endsection