<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Topik Materi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="materiForm()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.lms.store') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <p class="font-bold">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 space-y-6">

                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Detail Topik Utama</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="title" value="Judul Topik Materi" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                            </div>
                            <div>
                                <x-input-label for="user_id" value="Guru Pembuat Materi" />
                                <select name="user_id" id="user_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Guru --</option>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}" @selected(old('user_id') == $guru->id)>{{ $guru->name }}</option>
                                    @endforeach
                                </select>
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
                        </div>
                         <div>
                             <x-input-label for="description" value="Deskripsi Topik Utama (Opsional)" />
                             <textarea name="description" id="description" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
                         </div>

                        <hr>

                        <h3 class="text-lg font-medium text-gray-900">Konten / Sub Materi</h3>
                        <div x-ref="sortableContainer" class="space-y-4">
                        <template x-for="(content, index) in contents" :key="content.id">
                            <div class="p-4 border rounded-lg bg-gray-50 relative group">
                                <span class="absolute top-2 right-2 cursor-grab text-gray-400 hover:text-gray-600">☰</span>
                                <h4 class="font-semibold mb-2" x-text="`Konten #${index + 1}`"></h4>

                                <div>
                                    <x-input-label value="Judul Konten" />
                                    <input type="text" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" :name="`contents[${index}][title]`" required>
                                </div>
                                <div class="mt-2">
                                    <x-input-label value="Tipe Konten" />
                                    <select class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" x-model="content.type" :name="`contents[${index}][type]`" required>
                                        <option value="file">Upload File</option>
                                        <option value="video_link">Link Video (YouTube)</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <x-input-label value="Deskripsi Konten (Opsional)" />
                                    <textarea rows="2" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" :name="`contents[${index}][description]`"></textarea>
                                </div>

                                <div class="mt-2" x-show="content.type === 'file'">
                                    <x-input-label value="File Lampiran" />
                                    <input type="file" class="block mt-1 w-full text-sm" :name="`contents[${index}][file]`">
                                </div>
                                <div class="mt-2" x-show="content.type === 'video_link'">
                                    <x-input-label value="URL Video" />
                                    <input type="url" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" placeholder="https://www.youtube.com/watch?v=..." :name="`contents[${index}][url]`">
                                </div>

                                <button type="button" @click="removeContent(index)" class="mt-3 text-sm text-red-600 hover:text-red-800">Hapus Konten</button>
                            </div>
                        </template>
                        </div>

                        <x-secondary-button type="button" @click="addContent()">+ Tambah Konten</x-secondary-button>

                        <div class="flex items-center justify-end mt-4 border-t pt-4">
                            <a href="{{ route('admin.lms.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button class="ms-4">{{ __('Simpan Materi') }}</x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function materiForm() {
            return {
                contents: [{ id: 1, type: 'file' }],
                nextId: 2,
                init() {
                    Sortable.create(this.$refs.sortableContainer, { animation: 150, handle: '.cursor-grab' });
                },
                addContent() { this.contents.push({ id: this.nextId++, type: 'file' }); },
                removeContent(index) { this.contents.splice(index, 1); }
            }
        }
    </script>
</x-app-layout>
