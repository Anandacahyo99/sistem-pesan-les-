<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('📊 Rekapitulasi Absensi Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                
                {{-- Form Filter dan Tombol Excel --}}
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6 pb-6 border-b border-gray-100">
                    <form method="GET" action="{{ route('rekap.absensi.index') }}" class="flex flex-wrap items-center gap-3">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Pilih Kelas</label>
                            <select name="kelas_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg text-sm shadow-sm">
                                <option value="">Semua Kelas</option>
                                @foreach($pilihanKelas as $k)
                                    <option value="{{ $k->id }}" {{ $kelasId == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Tanggal</label>
                            <input type="date" name="tanggal" value="{{ $tanggal }}" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg text-sm shadow-sm">
                        </div>

                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-4 py-2 rounded-lg shadow-sm mt-5">
                            🔍 Filter
                        </button>
                        
                        @if($kelasId || $tanggal)
                            <a href="{{ route('rekap.absensi.index') }}" class="text-xs text-gray-500 hover:underline mt-5">Reset Filter</a>
                        @endif
                    </form>

                    {{-- Tombol Unduh Excel --}}
                    <div>
                        <a href="{{ route('rekap.absensi.export', ['kelas_id' => $kelasId, 'tanggal' => $tanggal]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-lg shadow-sm transition">
                            🟢 Unduh Rekap (Excel)
                        </a>
                    </div>
                </div>

                {{-- Tabel List Absensi --}}
                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3.5 font-bold" width="60">No</th>
                                <th class="px-6 py-3.5 font-bold">Tanggal</th>
                                <th class="px-6 py-3.5 font-bold">Kelas</th>
                                <th class="px-6 py-3.5 font-bold">Nama Siswa</th>
                                <th class="px-6 py-3.5 font-bold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($absensis as $index => $row)
                                <tr class="hover:bg-gray-50/50">
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $absensis->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 font-medium">{{ $row->tanggal }}</td>
                                    <td class="px-6 py-4">{{ $row->kelas->nama_kelas ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800">{{ $row->user->name ?? 'Siswa Terhapus' }}</div>
                                        <div class="text-xs text-gray-400">{{ $row->user->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($row->status == 'hadir')
                                            <span class="px-2.5 py-1 text-xs font-bold bg-green-50 text-green-700 rounded-full">Hadir</span>
                                        @elseif($row->status == 'izin')
                                            <span class="px-2.5 py-1 text-xs font-bold bg-blue-50 text-blue-700 rounded-full">Izin</span>
                                        @elseif($row->status == 'sakit')
                                            <span class="px-2.5 py-1 text-xs font-bold bg-amber-50 text-amber-700 rounded-full">Sakit</span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-bold bg-red-50 text-red-700 rounded-full">Alpa</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12 text-gray-400">
                                        📭 Tidak ditemukan data absensi yang sesuai dengan kriteria filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-4">
                    {{ $absensis->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>