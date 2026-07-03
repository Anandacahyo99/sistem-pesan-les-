<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Metode & Upload Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 text-sm rounded-lg text-yellow-800">
                    <h4 class="font-bold mb-1">🏦 Instruksi Transfer Manual:</h4>
                    <p>Silakan transfer sesuai nominal ke salah satu rekening di bawah ini:</p>
                    <ul class="list-disc list-inside mt-2 font-medium">
                        <li>Bank BCA: 123-4567-890 a/n Admin Les</li>
                        <li>Bank Mandiri: 987-6543-210 a/n Admin Les</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('siswa.pembayaran.kirim', $pendaftaran->id) }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <x-input-label for="nominal" :value="__('Nominal Transfer (Rp)')" />
                        <x-text-input id="nominal" class="block mt-1 w-full bg-gray-50 font-bold" type="number" name="nominal" value="{{ $pendaftaran->kelas->harga }}" readonly required />
                        <span class="text-xs text-gray-500 mt-1">Sistem otomatis mengunci nominal sesuai harga kelas.</span>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="bukti_bayar" :value="__('Unggah Bukti Transfer (Gambar)')" />
                        <input id="bukti_bayar" class="block mt-1 w-full border border-gray-300 p-2 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="file" name="bukti_bayar" accept="image/*" required />
                        <x-input-error :messages="$errors->get('bukti_bayar')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="catatan" :value="__('Catatan Tambahan (Opsional)')" />
                        <textarea id="catatan" name="catatan" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Contoh: Transfer dari rekening atas nama Ananda"></textarea>
                        <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150">
                            Kirim Bukti Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>