<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unggah Materi Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-xl border border-gray-100">
                
                <form method="POST" action="{{ route('pengajar.materi.store', $kelas->id) }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Materi</label>
                        <input type="text" name="judul" required class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih File (PDF, Word, PPT, ZIP max 10MB)</label>
                        <input type="file" name="file" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi / Catatan Tambahan (Opsional)</label>
                        <textarea name="deskripsi" rows="3" class="mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('pengajar.materi.index', $kelas->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold text-sm px-4 py-2 rounded-lg">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-4 py-2 rounded-lg">Simpan & Unggah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>