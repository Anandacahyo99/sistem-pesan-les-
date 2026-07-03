<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('pengajar.absensi.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-900 uppercase tracking-wider flex items-center gap-1 mb-1">
                ← Kembali ke Pilihan Kelas
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lembar Absensi: {{ $kelas->nama_kelas }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                
                <form method="GET" action="{{ url()->current() }}" class="flex flex-col sm:flex-row sm:items-center gap-3 mb-6 pb-6 border-b border-gray-100">
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-1">Tanggal Absen</label>
                        <input type="date" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg text-sm shadow-sm">
                    </div>
                    <p class="text-xs text-gray-400 self-end sm:mb-2">*Sistem otomatis memuat data jika tanggal ini sudah pernah diabsen.</p>
                </form>

                @if($siswas->isEmpty())
                    <div class="text-center py-8 text-gray-400 text-sm">
                        👥 Belum ada siswa aktif terdaftar di dalam database kelas ini.
                    </div>
                @else
                    <form method="POST" action="{{ route('pengajar.absensi.simpan', $kelas->id) }}">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        <div class="overflow-x-auto rounded-xl border border-gray-100 mb-6">
                            <table class="w-full text-sm text-left text-gray-600">
                                <thead class="text-xs text-gray-400 uppercase bg-gray-50 border-b border-gray-100">
                                    <tr>
                                        <th class="px-6 py-3.5 font-bold" width="60">No</th>
                                        <th class="px-6 py-3.5 font-bold">Nama Lengkap Siswa</th>
                                        <th class="px-6 py-3.5 font-bold text-center">Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                                    @foreach($siswas as $index => $siswa)
                                        <tr class="hover:bg-gray-50/50">
                                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-gray-800 text-sm">{{ $siswa->name }}</div>
                                                <div class="text-xs text-gray-400 mt-0.5">{{ $siswa->email }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex justify-center gap-4">
                                                    {{-- PERBAIKAN 1: Array menggunakan format label tampilan (Hadir, Izin, dst) --}}
                                                    @foreach(['Hadir', 'Izin', 'Sakit', 'Alpa'] as $statusLabel)
                                                        @php
                                                            // Format value database selalu huruf kecil
                                                            $valueDb = strtolower($statusLabel);
                                                            
                                                            // PERBAIKAN 2: Gunakan strtolower pada data existing agar sinkron saat pengecekan awal default 'hadir'
                                                            $statusExisting = strtolower($absensiExisting[$siswa->id] ?? 'hadir');
                                                            $is_checked = $statusExisting === $valueDb;
                                                        @endphp
                                                        <label class="inline-flex items-center gap-1.5 cursor-pointer text-xs font-bold text-gray-600 select-none">
                                                            {{-- PERBAIKAN 3: value mengirim huruf kecil ($valueDb) agar lolos CHECK constraint database --}}
                                                            <input type="radio" name="absensi[{{ $siswa->id }}]" value="{{ $valueDb }}" {{ $is_checked ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500 border-gray-300 shadow-sm w-4 h-4">
                                                            {{ $statusLabel }}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-lg shadow-sm transition">
                                💾 Simpan Rekam Absensi
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>