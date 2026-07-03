<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 overflow-hidden shadow-sm sm:rounded-xl p-6 text-white">
                <h3 class="text-2xl font-bold mb-1">Halo, {{ Auth::user()->name }}! 👋</h3>
                <p class="text-indigo-100 text-sm">Selamat datang di panel bimbingan belajar Anda. Silakan pilih menu di bawah untuk memulai.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-12 h-12 rounded-lg bg-indigo-100 flex items-center justify-center text-2xl mb-4">
                            📚
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Katalog & Daftar Kelas</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            Cari dan pilih berbagai macam kelas les intensif yang tersedia untuk meningkatkan kemampuan akademik Anda.
                        </p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('siswa.kelas.kelas') }}" 
                           class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-900 transition group">
                            Lihat Pilihan Kelas 
                            <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 flex items-center justify-center text-2xl mb-4">
                            🚀
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Ruang Belajar Saya</h4>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            Pantau status pendaftaran kelas Anda, selesaikan pembayaran yang tertunda, atau masuk ke kelas yang sudah aktif.
                        </p>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('siswa.kelas.ruang') }}" 
                           class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-900 transition group">
                            Masuk Ruang Belajar
                            <span class="transform group-hover:translate-x-1 transition-transform">→</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>