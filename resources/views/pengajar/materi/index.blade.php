<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                📚 Materi Kelas: {{ $kelas->nama_kelas }}
            </h2>
            <a href="{{ route('pengajar.materi.create', $kelas->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-4 py-2 rounded-lg shadow-sm">
                ➕ Unggah Materi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 text-green-800 rounded-xl border border-green-200 text-sm">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-xl border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="bg-gray-50 text-xs text-gray-400 uppercase font-bold">
                            <tr>
                                <th class="px-6 py-3" width="50">No</th>
                                <th class="px-6 py-3">Judul Materi</th>
                                <th class="px-6 py-3">Deskripsi</th>
                                <th class="px-6 py-3" width="120">File</th>
                                <th class="px-6 py-3" width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($materis as $index => $materi)
                                <tr>
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-bold text-gray-900">{{ $materi->judul }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $materi->deskripsi ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ asset('storage/' . $materi->file) }}" target="_blank" class="text-indigo-600 hover:underline inline-flex items-center gap-1 font-semibold">
                                            📄 Lihat File
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('pengajar.materi.edit', [$kelas->id, $materi->id]) }}" class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg">
                                            Edit
                                        </a>
                                        <form action="{{ route('pengajar.materi.destroy', [$kelas->id, $materi->id]) }}" method="POST" onsubmit="return confirm('Hapus materi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-3 py-1.5 rounded-lg">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-400">Belum ada materi yang diunggah untuk kelas ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>