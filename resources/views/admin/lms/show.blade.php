<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Materi: {{ $material->title }}
        </h2>
    </x-slot>

    <div class="py-12"
         x-data="{
            isEditModalOpen: false,
            editingContent: null,
            contents: {{ json_encode($material->contents) }},
            openEditModal(content) {
                this.editingContent = content;
                this.isEditModalOpen = true;
            }
         }"
         x-init="Sortable.create($refs.sortableContainer, {
            animation: 150,
            handle: '.cursor-grab'
         })">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Detail Topik Utama</h2>
                        <p class="mt-1 text-sm text-gray-600">Perbarui informasi utama untuk topik materi ini.</p>
                    </header>
                    <form method="POST" action="{{ route('admin.lms.update', $material->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="title" value="Judul Topik Materi" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $material->title)" required />
                            </div>
                            <div>
                                <x-input-label for="user_id" value="Guru Pembuat" />
                                <select name="user_id" id="user_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}" @selected(old('user_id', $material->user_id) == $guru->id)>{{ $guru->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update Detail') }}</x-primary-button>
                        </div>
                    </form>
                </section>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Konten / Sub Materi</h2>
                        <p class="mt-1 text-sm text-gray-600">Geser (drag) untuk mengurutkan, lalu simpan perubahan.</p>
                    </header>

                    {{-- Form untuk menyimpan urutan baru --}}
                    <form action="{{ route('admin.lms-content.updateOrder') }}" method="POST" class="mt-4">
                        @csrf
                        <div x-ref="sortableContainer" class="mt-6 space-y-4">
                            <template x-for="content in contents" :key="content.id">
                                <div class="p-4 border rounded-md flex justify-between items-center bg-gray-50" :data-id="content.id">
                                    <input type="hidden" name="content_ids[]" :value="content.id">
                                    <div class="flex items-center">
                                        <span class="cursor-grab text-gray-400 hover:text-gray-600 mr-4">☰</span>
                                        <div>
                                            <p class="font-semibold" x-text="content.title"></p>
                                            <a :href="content.type === 'file' ? `/storage/${content.path_or_url}` : content.path_or_url" target="_blank" class="text-sm text-blue-600 hover:underline" x-text="content.type === 'file' ? 'Lihat File' : 'Lihat Video'"></a>
                                        </div>
                                    </div>
                                    <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                        <button type="button" @click="openEditModal(content)" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                            Edit
                                        </button>
                                        <form method="POST" :action="`/admin/lms-content/${content.id}`" :id="`delete-form-content-${content.id}`">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" :data-form-id="`content-${content.id}`">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Simpan Urutan') }}</x-primary-button>
                        </div>
                    </form>

                    {{-- ▼▼▼ BLOK YANG HILANG SEBELUMNYA ▼▼▼ --}}

                    <div class="mt-6 border-t pt-6" x-data="{ type: 'file' }">
                        <h3 class="text-md font-medium text-gray-900">Tambah Konten Baru</h3>
                        <form method="POST" action="{{ route('admin.lms-content.store') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
                            @csrf
                            <input type="hidden" name="lms_material_id" value="{{ $material->id }}">

                            <div>
                                <x-input-label for="new_title" value="Judul Konten" />
                                <x-text-input id="new_title" name="title" type="text" class="mt-1 block w-full" required />
                            </div>

                            <div>
                                <x-input-label for="new_type" value="Tipe Konten" />
                                <select name="type" x-model="type" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="file">Upload File</option>
                                    <option value="video_link">Link Video</option>
                                </select>
                            </div>

                            <div x-show="type === 'file'">
                                <x-input-label for="new_attachment" value="File Lampiran" />
                                <input type="file" name="attachment" id="new_attachment" class="block mt-1 w-full text-sm">
                            </div>
                            <div x-show="type === 'video_link'">
                                <x-input-label for="new_url" value="URL Video" />
                                <x-text-input id="new_url" name="path_or_url" type="url" class="mt-1 block w-full" placeholder="https://youtube.com/watch?v=..." />
                            </div>

                            <div>
                                <x-input-label for="new_description" value="Deskripsi (Opsional)" />
                                <textarea name="description" id="new_description" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            </div>

                            <div class="flex items-center justify-end gap-4">
                                <a href="{{ route('admin.lms.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                    Kembali
                                </a>
                                <x-primary-button>Tambah Konten</x-primary-button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <div x-show="isEditModalOpen" x-cloak
             class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div @click.outside="isEditModalOpen = false" class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Edit Konten</h3>
                    <template x-if="editingContent">
                        <form :action="`/admin/lms-content/${editingContent.id}`" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <x-input-label for="edit_title" value="Judul Konten" />
                                <x-text-input id="edit_title" name="title" type="text" class="mt-1 block w-full" x-model="editingContent.title" required />
                            </div>
                            <div class="mt-4">
                                <x-input-label for="edit_description" value="Deskripsi (Opsional)" />
                                <textarea name="description" id="edit_description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" x-model="editingContent.description"></textarea>
                            </div>
                            <div class="flex items-center justify-end mt-6 pt-4 border-t">
                                <x-secondary-button type="button" @click="isEditModalOpen = false">Batal</x-secondary-button>
                                <x-primary-button class="ms-3">Update</x-primary-button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
