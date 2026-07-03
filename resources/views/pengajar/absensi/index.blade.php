<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('📋 Absensi Kelas Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-sm font-medium">
                    ✔ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-900">Mulai Mengabsen</h3>
                    <p class="text-sm text-gray-500">Pilih salah satu kelas aktif di bawah ini untuk membuka lembar absensi harian siswa.</p>
                </div>

                @if($kelas->isEmpty())
                    <div class="text-center py-12 border border-dashed border-gray-200 rounded-xl text-gray-400 text-sm">
                        📭 Belum ada kelas yang ditugaskan kepada Anda saat ini.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($kelas as $item)
                            <div class="border border-gray-100 rounded-xl p-5 bg-gray-50 flex flex-col justify-between hover:shadow-md transition">
                                <div class="mb-4">
                                    <h4 class="font-bold text-gray-800 text-base mb-1">{{ $item->nama_kelas }}</h4>
                                    <p class="text-xs text-indigo-600 font-semibold">Kuota Sisa: {{ $item->kuota }} Kursi</p>
                                </div>
                                <div class="pt-3 border-t border-gray-200">
                                    <a href="{{ route('pengajar.absensi.isi', $item->id) }}" class="w-full text-center inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs py-2.5 px-4 rounded-lg uppercase tracking-wider transition">
                                        📝 Buka Lembar Absen
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>