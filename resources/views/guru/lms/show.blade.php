<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Materi: {{ $material->title }}
        </h2>
    </x-slot>

    <div class="py-12"
         x-data="{
             isEditModalOpen: false,
             isIframeModalOpen: false,
             iframeUrl: '',
             editingContent: null,
             contents: {{ json_encode($material->contents) }},
             openEditModal(content) {
                 this.editingContent = JSON.parse(JSON.stringify(content));
                 this.isEditModalOpen = true;
             }
         }"
         x-init="Sortable.create($refs.sortableContainer, {
             animation: 150,
             handle: '.cursor-grab'
         })">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
                <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                    {{ session('status') }}
                </div>
            @endif
             @if ($errors->any())
                <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-100" role="alert">
                    <p class="font-bold">Terjadi Kesalahan:</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ▼▼▼ LAYOUT 2 KOLOM BARU ▼▼▼ --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- KOLOM KIRI: KONTEN UTAMA --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- KARTU 1: TAMBAH KONTEN BARU --}}
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div x-data="{ type: 'quiz' }">
                            <h3 class="text-lg font-medium text-gray-900">Tambah Konten Baru</h3>
                            <form id="add-content-form" method="POST" action="{{ route('guru.lms-content.store') }}" enctype="multipart/form-data" class="mt-4 space-y-4">
                                @csrf
                                <input type="hidden" name="lms_material_id" value="{{ $material->id }}">
                                <div>
                                    <x-input-label for="new_title" value="Judul Konten" />
                                    <x-text-input id="new_title" name="title" type="text" class="mt-1 block w-full" required />
                                </div>
                                <div>
                                    <x-input-label for="new_type" value="Tipe Konten" />
                                    <select name="type" x-model="type" id="content-type-select" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="file">Upload File</option>
                                        <option value="video_link">Link Video</option>
                                        <option value="quiz">Kuis</option>
                                    </select>
                                </div>
                                <div x-show="type === 'file'"><x-input-label for="new_attachment" value="File Lampiran" /><input type="file" name="attachment" id="new_attachment" class="block mt-1 w-full text-sm"></div>
                                <div x-show="type === 'video_link'"><x-input-label for="new_url" value="URL Video" /><x-text-input id="new_url" name="path_or_url" type="url" class="mt-1 block w-full" placeholder="https://youtube.com/watch?v=..." /></div>
                                <div x-show="type === 'quiz'">
                                    <x-input-label for="quiz_id" value="Pilih Kuis" />
                                    <div class="flex items-center gap-2 mt-1">
                                        <select name="quiz_id" id="quiz_id" class="block w-full border-gray-300 rounded-md shadow-sm">
                                            <option value="">-- Pilih Kuis yang Tersedia --</option>
                                            @forelse ($availableQuizzes as $quiz)
                                                <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                            @empty
                                                <option disabled>Tidak ada kuis yang bisa ditambahkan</option>
                                            @endforelse
                                        </select>
                                        <button type="button" @click.prevent="isIframeModalOpen = true; iframeUrl = '{{ route('guru.quiz.create', ['view' => 'modal', 'lms_material_id' => $material->id]) }}'" class="flex-shrink-0 inline-flex items-center px-4 py-2 bg-gray-200 border rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                            Buat Baru
                                        </button>
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="new_description" value="Deskripsi (Opsional)" />
                                    <textarea name="description" id="new_description" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"></textarea>
                                </div>
                                <div class="flex items-center justify-end">
                                    <x-primary-button>Tambah Konten</x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- KARTU 2: KONTEN / SUB MATERI --}}
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">Konten / Sub Materi</h2>
                                <p class="mt-1 text-sm text-gray-600">Geser (drag) untuk mengurutkan, lalu simpan perubahan.</p>
                            </header>
                            <form action="{{ route('guru.lms-content.updateOrder') }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="material_id" value="{{ $material->id }}">
                                <div x-ref="sortableContainer" class="mt-6 space-y-4">
                                    <template x-for="content in contents" :key="content.id">
                                        <div class="p-4 border rounded-md flex justify-between items-center bg-gray-50" :data-id="content.id">
                                            <input type="hidden" name="content_ids[]" :value="content.id">
                                            <div class="flex items-center">
                                                <span class="cursor-grab text-gray-400 hover:text-gray-600 mr-4">☰</span>
                                                <div>
                                                    <p class="font-semibold" x-text="content.title"></p>
                                                    <div class="text-sm">
                                                        @verbatim
                                                        <template x-if="content.type === 'file'"><a :href="`/storage/${content.path_or_url}`" target="_blank" class="text-blue-600 hover:underline">Lihat File</a></template>
                                                        <template x-if="content.type === 'video_link'"><a :href="content.path_or_url" target="_blank" class="text-blue-600 hover:underline">Lihat Video</a></template>
                                                        <template x-if="content.type === 'quiz'"><button type="button" @click="isIframeModalOpen = true; iframeUrl = `/guru/quiz/${content.quiz_id}?view=modal`" class="text-blue-600 hover:underline font-medium">Manage Kuis</button></template>
                                                        @endverbatim
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                                <button type="button" @click="openEditModal(content)" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">Edit</button>
                                                <form method="POST" :action="`/guru/lms-content/${content.id}`" onsubmit="return confirm('Anda yakin ingin menghapus konten ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button>{{ __('Simpan Urutan') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                    </div>

                    {{-- KARTU 3: ANALITIK PROGRESS SISWA --}}
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">Analitik Progress Siswa</h2>
                                <p class="mt-1 text-sm text-gray-600">Berikut adalah progress siswa untuk materi ini.</p>
                            </header>
                            <div class="mt-6 overflow-x-auto">
                                <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 font-medium text-left text-gray-900">Nama Siswa</th>
                                            <th class="px-4 py-2 font-medium text-left text-gray-900">Progress</th>
                                            <th class="px-4 py-2 font-medium text-left text-gray-900">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @if ($totalContents > 0)
                                            @forelse ($progressBySiswa as $siswaId => $progress)
                                                @php $percentage = ($progress['completed_count'] / $totalContents) * 100; @endphp
                                                <tr>
                                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $progress['name'] }}</td>
                                                    <td class="px-4 py-2 text-gray-700">
                                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-2 text-gray-700">
                                                        {{ $progress['completed_count'] }} / {{ $totalContents }}
                                                        <span class="font-semibold">({{ round($percentage) }}%)</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="3" class="text-center text-gray-500 py-4">Belum ada siswa yang memulai materi ini.</td></tr>
                                            @endforelse
                                        @else
                                            <tr><td colspan="3" class="text-center text-gray-500 py-4">Materi ini belum memiliki konten untuk dilacak progressnya.</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>

                {{-- ▼▼▼ KOLOM KANAN: DETAIL TOPIK UTAMA ▼▼▼ --}}
                <div class="lg:col-span-1">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">Detail Topik Utama</h2>
                                <p class="mt-1 text-sm text-gray-600">Perbarui informasi utama untuk topik materi ini.</p>
                            </header>
                            <form method="POST" action="{{ route('guru.lms.update', $material->id) }}" class="mt-6 space-y-6">
                                @csrf
                                @method('PUT')
                                <div>
                                    <x-input-label for="title" value="Judul Topik Materi" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $material->title)" required />
                                </div>
                                <div>
                                    <x-input-label for="subject_id" value="Mata Pelajaran (Opsional)" />
                                    <select name="subject_id" id="subject_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach(App\Models\Subject::orderBy('name')->get() as $subject)
                                            <option value="{{ $subject->id }}" @selected(old('subject_id', $material->subject_id) == $subject->id)>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="description" value="Deskripsi Topik Utama (Opsional)" />
                                    <textarea name="description" id="description" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $material->description) }}</textarea>
                                </div>
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Update Detail') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>

            </div>

            {{-- Modal untuk Edit Konten --}}
            <div x-show="isEditModalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
                <div @click.outside="isEditModalOpen = false" class="bg-white rounded-lg shadow-xl w-full max-w-2xl">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Edit Konten</h3>
                        <template x-if="editingContent">
                            <form :action="`/guru/lms-content/${editingContent.id}`" method="POST">
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
                                    <x-primary-button class="ms-3">Update Konten</x-primary-button>
                                </div>
                            </form>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Modal Iframe (untuk Buat & Manage Kuis) --}}
            <div x-show="isIframeModalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4">
                <div @click.outside="isIframeModalOpen = false; window.location.reload();" class="bg-white rounded-lg shadow-xl w-full max-w-5xl h-[90vh] flex flex-col">
                    <header class="p-4 border-b flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Kelola Konten</h3>
                        <button @click="isIframeModalOpen = false; window.location.reload();" class="text-gray-400 hover:text-gray-600 font-bold text-2xl">&times;</button>
                    </header>
                    <div class="flex-grow overflow-y-auto">
                        <iframe :src="iframeUrl" class="w-full h-full border-0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function addQuizAndCloseModal(newQuiz) {
            const addContentForm = document.getElementById('add-content-form');
            const titleInput = document.getElementById('new_title');
            const typeSelect = document.getElementById('content-type-select');
            const quizSelect = document.getElementById('quiz_id');
            const newOption = new Option(newQuiz.title, newQuiz.id, true, true);
            quizSelect.add(newOption);

            titleInput.value = newQuiz.title;
            typeSelect.value = 'quiz';
            quizSelect.value = newQuiz.id;

            addContentForm.submit();
        }
    </script>
    @endpush
</x-app-layout>
