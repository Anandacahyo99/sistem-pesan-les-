@extends('layouts.admin')

@section('title', 'Data Pengajar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pengajar</h2>
        <a href="{{ route('admin.pengajar.create') }}" class="btn btn-primary">
            + Tambah Pengajar
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
                        <th>Nama Pengajar</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Keahlian</th>
                        <th>Alamat</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pengajars as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->user->email ?? '-' }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $item->keahlian }}</span>
                        </td>
                        <td>{{ $item->alamat ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.pengajar.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.pengajar.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Hapus pengajar {{ $item->user->name ?? '' }}? Menghapus pengajar juga akan menghapus akun loginnnya.')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data pengajar.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            @if(method_exists($pengajars, 'links'))
                <div class="d-flex justify-content-end mt-3">
                    {{ $pengajars->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection