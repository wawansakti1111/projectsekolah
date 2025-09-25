<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            Manage Materi: {{ $material->title }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola detail dan konten materi pembelajaran</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden"
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
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-8">

            <!-- Detail Topik Utama -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8">
                    <header class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Detail Topik Utama
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">Perbarui informasi utama untuk topik materi ini.</p>
                    </header>

                    <form method="POST" action="{{ route('admin.lms.update', $material->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Judul Topik Materi</label>
                                <input type="text"
                                       name="title"
                                       value="{{ old('title', $material->title) }}"
                                       class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all"
                                       required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Guru Pembuat</label>
                                <select name="user_id"
                                        class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all"
                                        required>
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}" @selected(old('user_id', $material->user_id) == $guru->id)>
                                            {{ $guru->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Detail
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Konten / Sub Materi -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8">
                    <header class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1.586l-4 4z" />
                            </svg>
                            Konten / Sub Materi
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">Geser (drag) untuk mengurutkan, lalu simpan perubahan.</p>
                    </header>

                    <!-- Form Simpan Urutan -->
                    <form action="{{ route('admin.lms-content.updateOrder') }}" method="POST" class="mt-6">
                        @csrf
                        <div x-ref="sortableContainer" class="space-y-4">
                            <template x-for="content in contents" :key="content.id">
                                <div class="p-5 bg-white rounded-2xl border-2 border-green-100 flex justify-between items-start hover:shadow-md transition-shadow" :data-id="content.id">
                                    <input type="hidden" name="content_ids[]" :value="content.id">
                                    <div class="flex items-start gap-4">
                                        <span class="cursor-grab text-green-500 hover:text-green-700 mt-1">☰</span>
                                        <div>
                                            <p class="font-semibold text-gray-900" x-text="content.title"></p>
                                            <a :href="content.type === 'file' ? `/storage/${content.path_or_url}` : content.path_or_url"
                                               target="_blank"
                                               class="text-sm text-emerald-600 hover:underline flex items-center gap-1 mt-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                                <span x-text="content.type === 'file' ? 'Lihat File' : 'Lihat Video'"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex gap-2">
                                        <button type="button"
                                                @click="openEditModal(content)"
                                                class="px-3 py-1.5 text-sm font-medium text-green-600 hover:text-green-800 hover:bg-green-50 rounded-lg transition-colors">
                                            Edit
                                        </button>
                                        <form method="POST" :action="`/admin/lms-content/${content.id}`">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus konten ini?')"
                                                    class="px-3 py-1.5 text-sm font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="flex justify-end mt-6 pt-4 border-t border-green-200">
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Urutan
                            </button>
                        </div>
                    </form>

                    <!-- Tambah Konten Baru -->
                    <div class="mt-10 pt-6 border-t border-green-200" x-data="{ type: 'file' }">
                        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Konten Baru
                        </h3>
                        <form method="POST" action="{{ route('admin.lms-content.store') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
                            @csrf
                            <input type="hidden" name="lms_material_id" value="{{ $material->id }}">

                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Judul Konten</label>
                                <input type="text"
                                       name="title"
                                       class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all"
                                       required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Tipe Konten</label>
                                <select name="type"
                                        x-model="type"
                                        class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all">
                                    <option value="file">Upload File</option>
                                    <option value="video_link">Link Video</option>
                                </select>
                            </div>

                            <div x-show="type === 'file'">
                                <label class="block text-sm font-medium text-green-800 mb-2">File Lampiran</label>
                                <input type="file"
                                       name="attachment"
                                       class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                            </div>

                            <div x-show="type === 'video_link'">
                                <label class="block text-sm font-medium text-green-800 mb-2">URL Video</label>
                                <input type="url"
                                       name="path_or_url"
                                       placeholder="https://youtube.com/watch?v=..."
                                       class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all" />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Deskripsi (Opsional)</label>
                                <textarea name="description"
                                          rows="3"
                                          class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all"></textarea>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:justify-between gap-4 pt-4">
                                <a href="{{ route('admin.lms.index') }}"
                                   class="inline-flex items-center justify-center px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                    </svg>
                                    Kembali
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Konten
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Konten -->
        <div x-show="isEditModalOpen" x-cloak
             class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div @click.outside="isEditModalOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-5">Edit Konten</h3>
                    <template x-if="editingContent">
                        <form :action="`/admin/lms-content/${editingContent.id}`" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-5">
                                <label class="block text-sm font-medium text-green-800 mb-2">Judul Konten</label>
                                <input type="text"
                                       name="title"
                                       x-model="editingContent.title"
                                       class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all"
                                       required />
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-green-800 mb-2">Deskripsi (Opsional)</label>
                                <textarea name="description"
                                          rows="4"
                                          x-model="editingContent.description"
                                          class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all"></textarea>
                            </div>
                            <div class="flex justify-end gap-3 pt-4 border-t border-green-200">
                                <button type="button"
                                        @click="isEditModalOpen = false"
                                        class="px-6 py-3 text-gray-700 font-semibold rounded-xl border border-gray-300 hover:bg-gray-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                        class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow transition-all">
                                    Update
                                </button>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>