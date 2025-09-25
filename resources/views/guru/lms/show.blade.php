<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                            <svg class="w-7 h-7 text-white animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M9 11a2 2 0 114 0m-4 0V9a2 2 0 012-2m-2 0V5a2 2 0 012-2" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-3xl text-white leading-tight">
                                Manage Materi: {{ $material->title }}
                            </h2>
                            <p class="text-green-100 text-sm mt-1">Kelola konten, urutan, dan progress siswa</p>
                        </div>
                    </div>

                    <!-- Tombol Kembali - Hanya di Desktop (sm ke atas) -->
                    <a href="{{ url()->previous() }}" 
                       class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-medium rounded-xl transition-all duration-300 group">
                        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Styling Select2 agar menarik dan konsisten */
        .select2-container .select2-selection--single {
            height: 2.875rem !important;
            border-radius: 0.75rem !important;
            border: 2px solid #d1fae5 !important;
            background-color: white !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.875rem !important;
            padding-left: 1rem !important;
            color: #065f46 !important;
            font-weight: 500 !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 2.75rem !important;
            width: 2.5rem !important;
            right: 0.5rem !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #059669 transparent transparent transparent !important;
        }
        .select2-dropdown {
            border-radius: 0.75rem !important;
            border: 2px solid #d1fae5 !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1) !important;
            background-color: white !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #10b981 !important;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.25) !important;
        }
        .select2-results__option {
            padding: 0.75rem 1rem !important;
            font-size: 0.875rem !important;
            color: #1f2937 !important;
        }
        .select2-results__option--highlighted[aria-selected] {
            background-color: #ecfdf5 !important;
            color: #065f46 !important;
        }
        .select2-results__option[aria-selected=true] {
            background-color: #d1fae5 !important;
            color: #065f46 !important;
            font-weight: 600 !important;
        }
        [x-cloak] { display: none !important; }
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
    </style>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10"
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
             x-init="Sortable.create($refs.sortableContainer, { animation: 150, handle: '.cursor-grab' })">

            @if (session('status'))
                <div class="mb-6 p-4 bg-emerald-100 text-emerald-800 rounded-xl border border-emerald-200 shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-xl border border-red-200 shadow-sm">
                    <p class="font-bold">Terjadi Kesalahan:</p>
                    <ul class="list-disc list-inside mt-2 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Kolom Kiri -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Tambah Konten Baru -->
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                        <div class="p-6 md:p-8">
                            <h3 class="text-xl font-bold text-green-800 mb-5">Tambah Konten Baru</h3>
                            <div x-data="{ type: 'quiz' }">
                                <form id="add-content-form" method="POST" action="{{ route('guru.lms-content.store') }}" enctype="multipart/form-data" class="space-y-5">
                                    @csrf
                                    <input type="hidden" name="lms_material_id" value="{{ $material->id }}">

                                    <div>
                                        <label class="block text-sm font-medium text-green-800 mb-2">Judul Konten</label>
                                        <input type="text" name="title" class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-green-800 mb-2">Tipe Konten</label>
                                        <select name="type" x-model="type" class="w-full select2-basic">
                                            <option value="file">Upload File</option>
                                            <option value="video_link">Link Video</option>
                                            <option value="quiz">Kuis</option>
                                        </select>
                                    </div>

                                    <div x-show="type === 'file'" class="space-y-2">
                                        <label class="block text-sm font-medium text-green-800">File Lampiran</label>
                                        <input type="file" name="attachment" class="w-full text-sm text-gray-700">
                                    </div>

                                    <div x-show="type === 'video_link'" class="space-y-2">
                                        <label class="block text-sm font-medium text-green-800">URL Video</label>
                                        <input type="url" name="path_or_url" placeholder="https://youtube.com/watch?v=..." class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition">
                                    </div>

                                    <div x-show="type === 'quiz'" class="space-y-2">
                                        <label class="block text-sm font-medium text-green-800">Pilih Kuis</label>
                                        <div class="flex flex-col sm:flex-row gap-3">
                                            <select name="quiz_id" class="flex-1 select2-basic">
                                                <option value="">-- Pilih Kuis --</option>
                                                @forelse ($availableQuizzes as $quiz)
                                                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                                @empty
                                                    <option disabled>Tidak ada kuis tersedia</option>
                                                @endforelse
                                            </select>
                                            <button type="button"
                                                    @click.prevent="isIframeModalOpen = true; iframeUrl = '{{ route('guru.quiz.create', ['view' => 'modal', 'lms_material_id' => $material->id]) }}'"
                                                    class="px-4 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-medium rounded-xl shadow hover:from-green-700 hover:to-emerald-700 transition flex items-center justify-center gap-2 hover:scale-[1.02]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Buat Baru
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-green-800 mb-2">Deskripsi (Opsional)</label>
                                        <textarea name="description" rows="3" class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition"></textarea>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:from-green-700 hover:to-emerald-700 transition hover:scale-105 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Tambah Konten
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Konten / Sub Materi -->
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                        <div class="p-6 md:p-8">
                            <header class="mb-6">
                                <h2 class="text-xl font-bold text-green-800">Konten / Sub Materi</h2>
                                <p class="text-green-600 text-sm">Geser (drag) untuk mengurutkan, lalu simpan perubahan.</p>
                            </header>

                            <form action="{{ route('guru.lms-content.updateOrder') }}" method="POST">
                                @csrf
                                <input type="hidden" name="material_id" value="{{ $material->id }}">
                                <div x-ref="sortableContainer" class="space-y-4">
                                    <template x-for="content in contents" :key="content.id">
                                        <div class="p-5 border-2 border-green-100 rounded-2xl bg-green-50/30 flex justify-between items-start relative group" :data-id="content.id">
                                            <input type="hidden" name="content_ids[]" :value="content.id">
                                            <div class="flex items-start">
                                                <span class="cursor-grab text-green-500 hover:text-green-700 mr-3 mt-1">☰</span>
                                                <div>
                                                    <p class="font-semibold text-gray-900" x-text="content.title"></p>
                                                    <div class="text-sm mt-2">
                                                        @verbatim
                                                        <template x-if="content.type === 'file'">
                                                            <a :href="`/storage/${content.path_or_url}`" target="_blank" class="text-emerald-600 hover:underline font-medium flex items-center gap-1">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                </svg>
                                                                Lihat File
                                                            </a>
                                                        </template>
                                                        <template x-if="content.type === 'video_link'">
                                                            <a :href="content.path_or_url" target="_blank" class="text-emerald-600 hover:underline font-medium flex items-center gap-1">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                                </svg>
                                                                Lihat Video
                                                            </a>
                                                        </template>
                                                        <template x-if="content.type === 'quiz'">
                                                            <button type="button" @click="isIframeModalOpen = true; iframeUrl = `/guru/quiz/${content.quiz_id}?view=modal`" class="text-emerald-600 hover:underline font-medium flex items-center gap-1">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                                </svg>
                                                                Manage Kuis
                                                            </button>
                                                        </template>
                                                        @endverbatim
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-wrap gap-2 mt-2 sm:mt-0">
                                                <button type="button" @click="openEditModal(content)" class="px-3 py-2 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 text-sm font-medium rounded-xl hover:from-blue-200 hover:to-indigo-200 transition flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </button>
                                                <form method="POST" :action="`/guru/lms-content/${content.id}`" onsubmit="return confirm('Anda yakin ingin menghapus konten ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-2 bg-gradient-to-r from-red-100 to-rose-100 text-red-700 text-sm font-medium rounded-xl hover:from-red-200 hover:to-rose-200 transition flex items-center gap-1">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <div class="flex justify-end mt-6">
                                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:from-green-700 hover:to-emerald-700 transition hover:scale-105 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Simpan Urutan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Analitik Progress -->
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                        <div class="p-6 md:p-8">
                            <header class="mb-6">
                                <h2 class="text-xl font-bold text-green-800">Analitik Progress Siswa</h2>
                                <p class="text-green-600 text-sm">Progress siswa untuk materi ini.</p>
                            </header>

                            <div class="overflow-x-auto -mx-4 sm:mx-0">
                                <table class="min-w-full divide-y divide-green-100 text-sm">
                                    <thead class="bg-green-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-semibold text-green-800">Nama Siswa</th>
                                            <th class="px-4 py-3 text-left font-semibold text-green-800">Progress</th>
                                            <th class="px-4 py-3 text-left font-semibold text-green-800">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-green-100">
                                        @if ($totalContents > 0)
                                            @forelse ($progressBySiswa as $siswaId => $progress)
                                                @php $percentage = ($progress['completed_count'] / $totalContents) * 100; @endphp
                                                <tr class="hover:bg-green-50/50 transition-colors">
                                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $progress['name'] }}</td>
                                                    <td class="px-4 py-3">
                                                        <div class="w-full bg-green-200 rounded-full h-2.5">
                                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 text-gray-700">
                                                        {{ $progress['completed_count'] }} / {{ $totalContents }}
                                                        <span class="font-semibold">({{ round($percentage) }}%)</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">Belum ada siswa yang memulai.</td></tr>
                                            @endforelse
                                        @else
                                            <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">Materi belum memiliki konten.</td></tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="lg:col-span-1">
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                        <div class="p-6 md:p-8">
                            <header class="mb-6">
                                <h2 class="text-xl font-bold text-green-800">Detail Topik Utama</h2>
                                <p class="text-green-600 text-sm">Perbarui informasi utama materi ini.</p>
                            </header>

                            <form method="POST" action="{{ route('guru.lms.update', $material->id) }}" class="space-y-5">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label class="block text-sm font-medium text-green-800 mb-2">Judul Topik Materi</label>
                                    <input type="text" name="title" value="{{ old('title', $material->title) }}" class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-green-800 mb-2">Mata Pelajaran (Opsional)</label>
                                    <select name="subject_id" class="w-full select2-basic">
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach(App\Models\Subject::orderBy('name')->get() as $subject)
                                            <option value="{{ $subject->id }}" @selected(old('subject_id', $material->subject_id) == $subject->id)>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-green-800 mb-2">Deskripsi (Opsional)</label>
                                    <textarea name="description" rows="3" class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition">{{ old('description', $material->description) }}</textarea>
                                </div>

                                <!-- Tombol Aksi -->
                                <div class="flex flex-col sm:flex-row sm:items-center gap-3 pt-4">
                                    <!-- Tombol Update -->
                                    <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:from-green-700 hover:to-emerald-700 transition hover:scale-[1.02] flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Update Detail
                                    </button>

                                    <!-- Tombol Kembali - Hanya di Mobile, di bawah Update -->
                                    <a href="{{ url()->previous() }}" 
                                       class="sm:hidden w-full px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium rounded-xl transition flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div x-show="isEditModalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div @click.outside="isEditModalOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-5">
                    <h3 class="text-xl font-bold text-green-800">Edit Konten</h3>
                    <button @click="isEditModalOpen = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <template x-if="editingContent">
                    <form :action="`/guru/lms-content/${editingContent.id}`" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Judul Konten</label>
                                <input type="text" name="title" x-model="editingContent.title" class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Deskripsi (Opsional)</label>
                                <textarea name="description" rows="4" x-model="editingContent.description" class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
                            <button type="button" @click="isEditModalOpen = false" class="px-4 py-2.5 bg-gray-200 text-gray-800 font-medium rounded-xl hover:bg-gray-300 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-bold rounded-xl shadow hover:from-green-700 hover:to-emerald-700 transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Konten
                            </button>
                        </div>
                    </form>
                </template>
            </div>
        </div>
    </div>

    <!-- Modal Iframe -->
    <div x-show="isIframeModalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-2 sm:p-4">
        <div @click.outside="isIframeModalOpen = false; window.location.reload();" class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl h-[90vh] flex flex-col">
            <header class="p-4 border-b border-green-200 flex justify-between items-center">
                <h3 class="text-lg font-bold text-green-800">Kelola Konten</h3>
                <button @click="isIframeModalOpen = false; window.location.reload();" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
            </header>
            <div class="flex-grow overflow-hidden">
                <iframe :src="iframeUrl" class="w-full h-full border-0"></iframe>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2-basic').select2({
                width: '100%',
                dropdownAutoWidth: false,
                minimumResultsForSearch: 8
            });
        });

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