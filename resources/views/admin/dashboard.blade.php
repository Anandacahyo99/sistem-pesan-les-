<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <div class="flex flex-col md:flex-row gap-8">
                    
                    <div class="w-full md:w-1/4 border-b md:border-b-0 md:border-r border-gray-200 pb-6 md:pb-0 md:pr-6">
                        <h3 class="font-bold text-gray-400 text-xs uppercase tracking-wider mb-4">Menu Utama Admin</h3>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('admin.dashboard') }}" 
                                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                    <span>📊</span> Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.kelas') }}" 
                                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                                    <span>📚</span> Data Kelas
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.pengajar.index') }}" 
                                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                                    <span>💼</span> Data Pengajar
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.pembayaran.index') }}" 
                                   class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition">
                                    <span>💳</span> Verifikasi Pembayaran
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="w-full md:w-3/4 pt-2 md:pt-0 space-y-6">
                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-sm text-gray-700">
                            ✨ {{ __("You're logged in admin!") }} Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong>.
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="p-5 border border-gray-100 bg-white rounded-xl shadow-sm flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Kelas</p>
                                    <h4 class="text-2xl font-extrabold text-gray-900 mt-1">Kelola</h4>
                                </div>
                                <a href="{{ route('admin.kelas') }}" class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold hover:bg-indigo-100 transition">
                                    →
                                </a>
                            </div>

                            <div class="p-5 border border-gray-100 bg-white rounded-xl shadow-sm flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Data Mentor</p>
                                    <h4 class="text-2xl font-extrabold text-gray-900 mt-1">Aktif</h4>
                                </div>
                                <a href="{{ route('admin.pengajar.index') }}" class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold hover:bg-emerald-100 transition">
                                    →
                                </a>
                            </div>

                            <div class="p-5 border border-gray-100 bg-white rounded-xl shadow-sm flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pembayaran</p>
                                    <h4 class="text-2xl font-extrabold text-yellow-600 mt-1">Periksa</h4>
                                </div>
                                <a href="{{ route('admin.pembayaran.index') }}" class="w-10 h-10 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center font-bold hover:bg-yellow-100 transition">
                                    →
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>