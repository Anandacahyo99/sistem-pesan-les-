<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilihan Kelas Kursus Les') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @forelse($daftarKelas as $kelas)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 flex flex-col justify-between p-6 h-full">
                        
                        <div class="mb-4">
                            <div class="flex justify-between items-center mb-3">
                                <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    Online / Offline
                                </span>
                                <span class="text-xs text-gray-500">👤 Sisa Kuota: {{ $kelas->kuota }}</span>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                {{ $kelas->nama_kelas }}
                            </h3>

                            <p class="text-sm text-gray-600 mb-3 flex items-center gap-1">
                                👨‍🏫 Pengajar: <span class="font-medium text-gray-800">{{ $kelas->pengajar->user->name ?? 'Tentor Tamu' }}</span>
                            </p>

                            <p class="text-sm text-gray-500 line-clamp-3">
                                {{ $kelas->deskripsi ?? 'Tidak ada deskripsi untuk kelas ini.' }}
                            </p>
                        </div>

                        <div class="border-t border-gray-100 pt-4 flex items-center justify-between mt-auto w-full relative z-10">
                            <div class="flex flex-col">
                                <p class="text-xs text-gray-400 uppercase tracking-wider">Investasi</p>
                                <p class="text-lg font-extrabold text-indigo-600">
                                    Rp {{ number_format($kelas->harga, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <a href="{{ route('siswa.kelas.detail-kelas', $kelas->id) }}" 
                               class="inline-flex items-center justify-center text-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm min-w-[100px]">
                                {{ __('Lihat Detail') }}
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 text-center shadow-sm sm:rounded-lg border text-gray-500">
                        📭 Saat ini belum ada kelas les aktif yang dibuka. Silakan cek kembali nanti!
                    </div>
                @endforelse

            </div>

            <div class="mt-6">
                {{ $daftarKelas->links() }}
            </div>

        </div>
    </div>
</x-app-layout>