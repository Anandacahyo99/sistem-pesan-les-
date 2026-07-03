<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Pengajar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6 border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-2">Selamat Datang, {{ Auth::user()->name }}! 👨‍🏫</h3>
                <p class="text-sm text-gray-500 mb-6">Kelola absensi harian siswa bimbingan belajar Anda dengan cepat dan mudah.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 bg-indigo-50/50 rounded-xl border border-indigo-100 flex flex-col justify-between">
                        <div>
                            <span class="text-3xl">📋</span>
                            <h4 class="font-bold text-gray-800 text-lg mt-3 mb-1">Manajemen Absensi</h4>
                            <p class="text-sm text-gray-500">Buka daftar kelas bimbingan aktif dan catat kehadiran siswa hari ini.</p>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('pengajar.absensi.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs px-4 py-2.5 rounded-lg uppercase tracking-wider transition">
                                Buka Absensi →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>