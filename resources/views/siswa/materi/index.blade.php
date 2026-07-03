<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    📖 Ruang Belajar: {{ $kelas->nama_kelas }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">Pengajar: {{ $kelas->pengajar->user->name ?? 'Tentor' }}</p>
            </div>
            <a href="{{ url()->previous() }}" class="text-xs font-bold text-gray-500 hover:text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg shadow-sm transition">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <h3 class="text-lg font-bold text-gray-900">Materi Pembelajaran</h3>
                <p class="text-sm text-gray-500">Silakan pelajari materi, modul, atau berkas PDF yang telah diunggah oleh pengajar Anda di bawah ini.</p>
            </div>

            @if($materis->isEmpty())
                <div class="bg-white p-12 text-center rounded-xl border border-gray-100 shadow-sm text-gray-400 text-sm">
                    📭 Belum ada materi yang diunggah oleh pengajar untuk kelas ini. Silakan periksa kembali nanti!
                </div>
            @else
                <div class="grid grid-cols-1 gap-4">
                    @foreach($materis as $materi)
                        <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-5 hover:shadow-md transition flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                {{-- Icon PDF / Dokumen dekoratif mini --}}
                                <div class="bg-indigo-50 text-indigo-600 p-3 rounded-xl font-bold text-xl select-none">
                                    📄
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-base">{{ $materi->judul }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">{{ $materi->deskripsi ?? 'Tidak ada deskripsi tambahan.' }}</p>
                                    <span class="inline-block text-[10px] font-semibold text-gray-400 uppercase bg-gray-50 border border-gray-200 px-2 py-0.5 rounded mt-2">
                                        Diupload: {{ $materi->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="sm:self-center w-full sm:w-auto">
                                {{-- Tombol Download / Buka File untuk Siswa --}}
                                <a href="{{ asset('storage/' . $materi->file) }}" 
                                   target="_blank" 
                                   class="w-full sm:w-auto text-center inline-flex items-center justify-center gap-1.5 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-sm uppercase tracking-wider transition">
                                    📥 Buka / Unduh File
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>