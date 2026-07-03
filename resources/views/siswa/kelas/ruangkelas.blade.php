<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🚀 Ruang Belajar Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">

            <div>
                <div class="border-b border-gray-200 pb-3 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex h-3 w-3 rounded-full bg-green-500"></span>
                        📖 Kelas Aktif (Sudah Diverifikasi)
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Kelas yang sudah disetujui oleh admin. Silakan mulai belajar!
                    </p>
                </div>

                @if ($kelasAktif->isEmpty())
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500 border border-dashed border-gray-200">
                        📭 Anda belum memiliki kelas yang aktif saat ini.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($kelasAktif as $item)
                            <div
                                class="bg-white overflow-hidden shadow-md rounded-xl border border-gray-100 flex flex-col justify-between p-6 hover:shadow-lg transition">
                                <div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mb-3">
                                        Active
                                    </span>
                                    <h4 class="text-lg font-bold text-gray-900 mb-1">{{ $item->kelas->nama_kelas }}</h4>
                                    <p class="text-sm text-indigo-600 font-medium mb-4">
                                        👨‍🏫 Mentor: {{ $item->kelas->pengajar->user->name ?? 'Tentor Tamu' }}
                                    </p>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <a href="{{ route('siswa.materi.index', $item->kelas->id) }}"
                                       class="w-full text-center inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm py-2.5 px-4 rounded-lg transition">
                                        Mulai Masuk Kelas →
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div>
                <div class="border-b border-gray-200 pb-3 mb-6">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex h-3 w-3 rounded-full bg-yellow-500 animate-pulse"></span>
                        ⏳ Menunggu Konfirmasi Admin
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Pendaftaran kelas yang sedang diperiksa bukti transfernya oleh
                        admin.</p>
                </div>

                @if ($kelasPending->isEmpty())
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500 border border-dashed border-gray-200">
                        👍 Tidak ada pendaftaran yang menggantung.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($kelasPending as $item)
                            <div
                                class="bg-gray-50 overflow-hidden shadow-sm rounded-xl border border-gray-200 flex flex-col justify-between p-6 opacity-80">
                                <div>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mb-3 animate-pulse">
                                        Menunggu Verifikasi
                                    </span>
                                    <h4 class="text-lg font-bold text-gray-700 mb-1">{{ $item->kelas->nama_kelas }}</h4>
                                    <p class="text-sm text-gray-500">
                                        Didaftar pada:
                                        {{ \Carbon\Carbon::parse($item->tanggal_daftar)->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                                <div class="mt-6 space-y-3">
                                    {{-- JIKA USER BELUM UPLOAD BUKTI SAMA SEKALI --}}
                                    @if (!$item->pembayaran)
                                        <div
                                            class="p-3 bg-red-50 rounded-lg border border-red-100 text-xs text-red-800 text-center font-medium">
                                            ⚠️ Anda belum menyelesaikan pembayaran untuk kelas ini.
                                        </div>
                                        <a href="{{ route('siswa.pendaftaran.pembayaran', $item->id) }}"
                                            class="w-full text-center block bg-orange-500 hover:bg-orange-600 text-white font-bold text-xs py-2.5 px-4 rounded-lg shadow-sm transition">
                                            💳 Selesaikan Pembayaran Now
                                        </a>
                                        {{-- JIKA USER SUDAH UPLOAD, TINGGAL TUNGGU ADMIN --}}
                                    @else
                                        <div
                                            class="p-3 bg-yellow-50 rounded-lg border border-yellow-100 text-xs text-yellow-800 text-center">
                                            🔒 Akses kelas akan terbuka otomatis setelah admin memvalidasi bukti
                                            transfer Anda.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
