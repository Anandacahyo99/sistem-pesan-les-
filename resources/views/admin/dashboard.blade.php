<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-sky-800">
                    Dashboard Admin
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola seluruh sistem pembelajaran dalam satu tempat.
                </p>
            </div>

            <div class="bg-sky-100 text-sky-700 px-4 py-2 rounded-xl font-semibold">
                👋 {{ Auth::user()->name }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-sky-50 min-h-screen">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-4 gap-6">

                <!-- Sidebar -->

                <aside class="bg-white rounded-2xl shadow-sm border border-sky-100 p-6">

                    <h3 class="text-xs font-bold uppercase tracking-wider text-sky-600 mb-6">
                        MENU ADMIN
                    </h3>

                    <nav class="space-y-2">

                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition
                            {{ request()->routeIs('admin.dashboard')
                                ? 'bg-sky-500 text-white shadow'
                                : 'hover:bg-sky-50 text-gray-700' }}">

                            📊 Dashboard
                        </a>

                        <a href="{{ route('admin.kelas') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium hover:bg-sky-50 text-gray-700 transition">

                            📚 Data Kelas
                        </a>

                        <a href="{{ route('admin.pengajar.index') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium hover:bg-sky-50 text-gray-700 transition">

                            👨‍🏫 Data Pengajar
                        </a>

                        <a href="{{ route('admin.pembayaran.index') }}"
                            class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium hover:bg-sky-50 text-gray-700 transition">

                            💳 Pembayaran
                        </a>

                    </nav>
                </aside>

                <!-- Content -->

                <main class="lg:col-span-3 space-y-6">

                    <!-- Welcome -->

                    <div
                        class="rounded-2xl bg-gradient-to-r from-sky-500 to-blue-600 text-white p-8 shadow-lg">

                        <h2 class="text-3xl font-bold">
                            Selamat Datang 👋
                        </h2>

                        <p class="mt-2 text-sky-100">
                            Halo <strong>{{ Auth::user()->name }}</strong>,
                            semoga hari ini produktif.
                        </p>

                    </div>

                    <!-- Statistik -->

                    <div class="grid md:grid-cols-3 gap-5">

                        <div
                            class="bg-white rounded-2xl shadow-sm border border-sky-100 p-6 hover:shadow-md transition">

                            <div class="flex justify-between">

                                <div>

                                    <p class="text-gray-500 text-sm">
                                        Total Kelas
                                    </p>

                                    <h2 class="text-3xl font-bold text-sky-700 mt-2">
                                        12
                                    </h2>

                                </div>

                                <div
                                    class="w-14 h-14 rounded-xl bg-sky-100 flex items-center justify-center text-2xl">

                                    📚

                                </div>

                            </div>

                        </div>

                        <div
                            class="bg-white rounded-2xl shadow-sm border border-sky-100 p-6 hover:shadow-md transition">

                            <div class="flex justify-between">

                                <div>

                                    <p class="text-gray-500 text-sm">
                                        Pengajar
                                    </p>

                                    <h2 class="text-3xl font-bold text-sky-700 mt-2">
                                        8
                                    </h2>

                                </div>

                                <div
                                    class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">

                                    👨‍🏫

                                </div>

                            </div>

                        </div>

                        <div
                            class="bg-white rounded-2xl shadow-sm border border-sky-100 p-6 hover:shadow-md transition">

                            <div class="flex justify-between">

                                <div>

                                    <p class="text-gray-500 text-sm">
                                        Menunggu Verifikasi
                                    </p>

                                    <h2 class="text-3xl font-bold text-red-500 mt-2">
                                        5
                                    </h2>

                                </div>

                                <div
                                    class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center text-2xl">

                                    💳

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Quick Menu -->

                    <div
                        class="bg-white rounded-2xl shadow-sm border border-sky-100 p-6">

                        <h3 class="font-bold text-xl text-sky-700 mb-6">

                            Akses Cepat

                        </h3>

                        <div class="grid md:grid-cols-3 gap-5">

                            <a href="{{ route('admin.kelas') }}"
                                class="border border-sky-100 rounded-xl p-6 hover:bg-sky-50 transition">

                                <div class="text-4xl">

                                    📚

                                </div>

                                <h4 class="font-bold mt-4">

                                    Kelola Kelas

                                </h4>

                                <p class="text-gray-500 text-sm mt-2">

                                    Tambah, ubah, dan hapus data kelas.

                                </p>

                            </a>

                            <a href="{{ route('admin.pengajar.index') }}"
                                class="border border-sky-100 rounded-xl p-6 hover:bg-sky-50 transition">

                                <div class="text-4xl">

                                    👨‍🏫

                                </div>

                                <h4 class="font-bold mt-4">

                                    Kelola Pengajar

                                </h4>

                                <p class="text-gray-500 text-sm mt-2">

                                    Atur seluruh data mentor.

                                </p>

                            </a>

                            <a href="{{ route('admin.pembayaran.index') }}"
                                class="border border-sky-100 rounded-xl p-6 hover:bg-sky-50 transition">

                                <div class="text-4xl">

                                    💳

                                </div>

                                <h4 class="font-bold mt-4">

                                    Verifikasi Pembayaran

                                </h4>

                                <p class="text-gray-500 text-sm mt-2">
                                    Cek pembayaran dari peserta.
                                </p>
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

</x-app-layout>