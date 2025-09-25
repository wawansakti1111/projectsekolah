<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            Edit Proyek: {{ $proyek->title }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Perbarui detail proyek berbasis SDG</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <form method="POST" action="{{ route('guru.proyek.update', $proyek->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Grid: Judul & Mata Pelajaran -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2">Judul Proyek</label>
                                <input type="text"
                                       name="title"
                                       value="{{ old('title', $proyek->title) }}"
                                       class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                       required autofocus />
                            </div>

                            <!-- Dropdown Mata Pelajaran Keren -->
                            <div x-data="{ open: false, selected: @js(old('subject_id', $proyek->subject_id)), subjects: @js($subjects) }"
                                 @click.away="open = false"
                                 class="relative">
                                <label class="block text-sm font-medium text-green-800 mb-2">Mata Pelajaran</label>
                                <div @click="open = !open"
                                     class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                                     :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''"
                                     required>
                                    <span x-text="selected ? subjects.find(s => s.id == selected)?.name : '-- Pilih Mata Pelajaran --'"
                                          :class="selected ? 'text-gray-900' : 'text-gray-500'"></span>
                                    <svg class="w-5 h-5 text-green-600 transition-transform duration-300"
                                         :class="open ? 'rotate-180' : ''"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>

                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 scale-100"
                                     x-transition:leave-end="opacity-0 scale-95"
                                     class="absolute z-10 mt-1 w-full bg-white border-2 border-green-200 rounded-xl shadow-lg max-h-60 overflow-auto">
                                    <template x-for="subject in subjects" :key="subject.id">
                                        <div @click="selected = subject.id; open = false"
                                             @mouseenter="this.style.backgroundColor = '#ecfdf5'"
                                             @mouseleave="this.style.backgroundColor = 'white'"
                                             class="px-4 py-3 text-gray-900 cursor-pointer hover:bg-emerald-50 transition-colors flex items-center">
                                            <span x-text="subject.name"></span>
                                            <svg x-show="selected == subject.id" class="ml-auto w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </template>
                                </div>
                                <input type="hidden" name="subject_id" x-model="selected" required>
                            </div>
                        </div>

                        <!-- Deadline -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2">Deadline (Opsional)</label>
                            <input type="date"
                                   name="deadline"
                                   value="{{ old('deadline', $proyek->deadline) }}"
                                   class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300" />
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2">Deskripsi</label>
                            <textarea name="description"
                                      rows="4"
                                      class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300">{{ old('description', $proyek->description) }}</textarea>
                        </div>

                        <!-- Upload Materi - Versi Menarik -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2">Ganti Materi (Opsional)</label>
                            
                            <!-- Tampilkan file saat ini -->
                            @if ($proyek->attachment_path)
                                <div class="mb-3 p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between">
                                    <span class="text-sm text-emerald-800 font-medium">File saat ini:</span>
                                    <a href="{{ asset('storage/' . $proyek->attachment_path) }}" target="_blank"
                                       class="text-sm text-emerald-600 hover:text-emerald-800 font-medium underline flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Lihat File
                                    </a>
                                </div>
                            @endif

                            <!-- Drop zone upload baru -->
                            <div x-data="{ fileName: null }" class="relative">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-green-300 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 hover:from-green-100 hover:to-emerald-100 cursor-pointer transition-all duration-300 group">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <div class="bg-white/80 p-3 rounded-full mb-3 shadow-sm">
                                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-5l-4-4H5a2 2 0 00-2 2z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 10v6m0 0l-2-2m2 2l2-2" />
                                            </svg>
                                        </div>
                                        <p class="mb-2 text-sm text-green-700 font-medium">
                                            <span class="font-semibold group-hover:text-green-800">Klik untuk ganti file</span> atau seret file ke sini
                                        </p>
                                        <p class="text-xs text-green-600" x-show="!fileName">PDF, DOC, PPT, ZIP (maks. 10MB)</p>
                                        <p class="text-xs text-emerald-700 font-medium truncate max-w-full px-2" x-show="fileName" x-text="fileName"></p>
                                    </div>
                                    <input type="file"
                                           name="attachment"
                                           class="hidden"
                                           @change="fileName = $event.target.files[0] ? $event.target.files[0].name : null" />
                                </label>
                            </div>
                        </div>

                        <!-- Pilih SDG -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-3">Pilih SDG yang Sesuai</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach ($sdgs as $sdg)
                                    <label class="flex items-start p-4 border-2 border-green-100 rounded-2xl bg-green-50/30 hover:bg-green-100 transition-colors cursor-pointer group">
                                        <input type="checkbox"
                                               name="sdgs[]"
                                               value="{{ $sdg->id }}"
                                               id="sdg-{{ $sdg->id }}"
                                               @checked(in_array($sdg->id, old('sdgs', $projectSdgIds)))
                                               class="mt-0.5 w-5 h-5 text-green-600 bg-white border-2 border-green-300 rounded focus:ring-green-500 focus:ring-2">
                                        <span class="ml-3 text-gray-800 group-hover:text-green-800 font-medium">
                                            {{ $sdg->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('guru.proyek.index') }}"
                               class="inline-flex items-center justify-center px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50 group">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Proyek
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>