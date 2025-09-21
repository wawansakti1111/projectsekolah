<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Topik Materi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('guru.lms.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 space-y-6">

                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Detail Topik Utama</h3>

                        <div>
                            <x-input-label for="title" value="Judul Topik Materi" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                        </div>

                        <div>
                            <x-input-label for="subject_id" value="Mata Pelajaran (Opsional)" />
                            <select name="subject_id" id="subject_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                             <x-input-label for="description" value="Deskripsi Topik Utama (Opsional)" />
                             <textarea name="description" id="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4 border-t pt-4">
                            <a href="{{ route('guru.lms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button class="ms-4">{{ __('Simpan & Lanjut Tambah Konten') }}</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
