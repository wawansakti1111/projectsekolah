<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Proyek: ') . $proyek->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.proyek.update', $proyek->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <x-input-label for="user_id" :value="__('Guru Pemilik Proyek')" />
                        <select name="user_id" id="user_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}" @selected(old('user_id', $proyek->user_id) == $guru->id)>{{ $guru->name }}</option>
                            @endforeach
                        </select>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div>
                                <x-input-label for="title" :value="__('Judul Proyek')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $proyek->title)" required />
                            </div>
                            <div>
                                <x-input-label for="subject_id" :value="__('Mata Pelajaran')" />
                                <select name="subject_id" id="subject_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" @selected(old('subject_id', $proyek->subject_id) == $subject->id)>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('subject_id')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Input untuk Deadline --}}
                        <div class="mt-4">
                            <x-input-label for="deadline" :value="__('Deadline (Opsional)')" />
                            <input id="deadline" type="date" name="deadline" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" :value="old('deadline', $proyek->deadline)" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Deskripsi')" />
                            <textarea name="description" id="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $proyek->description) }}</textarea>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="attachment" :value="__('Upload Materi Baru (Opsional)')" />
                            @if ($proyek->attachment_path)
                                <p class="text-sm text-gray-600 mt-1">File saat ini: <a href="{{ asset('storage/' . $proyek->attachment_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></p>
                            @endif
                            <input type="file" name="attachment" id="attachment" class="block mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100">
                        </div>

                        <div class="mt-6">
                            <x-input-label :value="__('Pilih SDG yang Sesuai')" class="mb-2"/>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($sdgs as $sdg)
                                <label for="sdg-{{$sdg->id}}" class="flex items-center space-x-3 p-3 border rounded-md hover:bg-gray-50">
                                    <input type="checkbox" name="sdgs[]" value="{{$sdg->id}}" id="sdg-{{$sdg->id}}"
                                        @checked(in_array($sdg->id, old('sdgs', $projectSdgIds)))
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span>{{ $sdg->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.proyek.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
