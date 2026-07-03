<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <a href="{{ route('siswa.kelas.kelas') }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-900 flex items-center gap-1 mb-1">
                    ← Kembali ke Katalog
                </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Kelas: {{ $kelas->nama_kelas }}
                </h2>
            </div>
            <div
                class="bg-indigo-50 border border-indigo-100 rounded-lg px-4 py-2 text-sm text-indigo-700 font-semibold self-start md:self-center">
                👤 Sisa Kuota: {{ $kelas->kuota }} Kursi
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4">
                            📖 Deskripsi Kelas
                        </h3>
                        <div class="text-gray-600 whitespace-pre-line leading-relaxed">
                            {{ $kelas->deskripsi ?? 'Tidak ada deskripsi mendalam untuk kelas ini.' }}
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 border-b border-gray-100 pb-3 mb-4">
                            👨‍🏫 Profil Pengajar / Mentor
                        </h3>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-between justify-center text-xl shadow-inner pt-1">
                                👨‍🏫
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-base">
                                    {{ $kelas->pengajar->user->name ?? 'Tentor Tamu' }}
                                </h4>
                                <p class="text-sm text-indigo-600 font-medium mt-0.5">
                                    Spesialisasi: {{ $kelas->pengajar->keahlian ?? 'Umum' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-2">
                                    Berkomitmen membimbing bimbingan belajar secara intensif hingga paham materi secara
                                    menyeluruh.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-2 border-indigo-50 sticky top-6">
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-2">
                            Investasi Pendidikan
                        </h3>
                        <div class="text-3xl font-extrabold text-gray-900 mb-6 flex items-baseline gap-1">
                            <span class="text-lg font-medium text-gray-500">Rp</span>
                            {{ number_format($kelas->harga, 0, ',', '.') }}
                        </div>

                        <div class="mb-6 space-y-3">
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✔</span> Akses Ruang Belajar Penuh
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✔</span> Konsultasi Tatap Muka Langsung
                            </div>
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-green-500">✔</span> Modul & Evaluasi Pembelajaran
                            </div>
                        </div>

                        @if ($kelas->kuota > 0)
                            <form method="GET" action="{{ route('siswa.materi.index', $item->kelas_id) }}">
                                 <button type="submit"
                                    class="w-full text-center inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm py-3 px-4 rounded-md shadow-sm transition ease-in-out duration-150 uppercase tracking-wider">
                                    🚀 Daftar Kelas Sekarang
                                </button>
                            </form>
                        
                    @else
                        <button type="button" disabled
                            class="w-full text-center inline-block bg-gray-300 text-gray-500 font-bold text-sm py-3 px-4 rounded-md cursor-not-allowed uppercase tracking-wider">
                            ❌ Kuota Sudah Penuh
                        </button>
                        @endif

                        <p class="text-center text-xs text-gray-400 mt-3">
                            Pendaftaran membutuhkan verifikasi manual setelah Anda mengunggah bukti transfer.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
