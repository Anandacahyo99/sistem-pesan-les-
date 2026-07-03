<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pendaftaran Kelas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan Kelas yang Dipilih</h3>
                
                <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-4 mb-6">
                    <table class="w-full text-sm text-left text-gray-600">
                        <tbody>
                            <tr>
                                <td class="py-2 font-semibold w-1/3">Nama Kelas</td>
                                <td class="py-2">: {{ $kelas->nama_kelas }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-semibold">Pengajar</td>
                                <td class="py-2">: {{ $kelas->pengajar->user->name ?? 'Tentor Tamu' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-semibold">Total Biaya/Investasi</td>
                                <td class="py-2 font-bold text-indigo-600">: Rp {{ number_format($kelas->harga, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <form method="POST" action="{{ route('siswa.kelas.daftar.simpan', $kelas->id) }}">
                    @csrf
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('siswa.kelas.kelas') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                            Konfirmasi & Buat Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>