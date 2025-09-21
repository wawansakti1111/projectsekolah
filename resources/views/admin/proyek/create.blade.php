<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Proyek Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.proyek.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <x-input-label for="user_id" :value="__('Guru Pemilik')" />
                                <select name="user_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="title" :value="__('Judul Proyek')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                            </div>
                            <div>
                                <x-input-label for="subject_id" :value="__('Mata Pelajaran')" />
                                <select name="subject_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Input untuk Deadline --}}
                        <div class="mt-4">
                            <x-input-label for="deadline" :value="__('Deadline (Opsional)')" />
                            <input id="deadline" type="date" name="deadline" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" :value="old('deadline')" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                        </div>
                        <div class="mt-4">
                            <x-input-label for="attachment" :value="__('Upload Materi (Opsional)')" />
                            <input type="file" name="attachment" class="block mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                        </div>

                        <div class="mt-6">
                            <x-input-label :value="__('Pilih SDG yang Sesuai')" class="mb-2"/>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($sdgs as $sdg)
                                <label for="sdg-{{$sdg->id}}" class="flex items-center space-x-3 p-3 border rounded-md hover:bg-gray-50">
                                    <input type="checkbox" name="sdgs[]" value="{{$sdg->id}}" id="sdg-{{$sdg->id}}" class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                    <span>{{ $sdg->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.proyek.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">Batal</a>
                            <x-primary-button class="ms-4">Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
