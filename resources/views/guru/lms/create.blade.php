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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Buat Topik Materi Baru') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Buat topik baru untuk mengelola konten pembelajaran</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <form method="POST" action="{{ route('guru.lms.store') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2">Judul Topik Materi</label>
                            <input type="text"
                                   name="title"
                                   value="{{ old('title') }}"
                                   class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                   required />
                        </div>

                        <!-- Dropdown Keren dengan Alpine.js -->
                        <div x-data="{ open: false, selected: @js(old('subject_id')), subjects: @js($subjects) }"
                             @click.away="open = false"
                             class="relative">
                            <label class="block text-sm font-medium text-green-800 mb-2">Mata Pelajaran (Opsional)</label>
                            <div @click="open = !open"
                                 class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                                 :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''">
                                <span x-text="selected ? subjects.find(s => s.id == selected)?.name : '-- Pilih Mata Pelajaran --'"
                                      :class="selected ? 'text-gray-900' : 'text-gray-500'"></span>
                                <svg class="w-5 h-5 text-green-600 transition-transform duration-300"
                                     :class="open ? 'rotate-180' : ''"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <!-- Dropdown Menu -->
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
                                <div x-show="subjects.length === 0" class="px-4 py-3 text-gray-500 italic">
                                    Tidak ada mata pelajaran tersedia
                                </div>
                            </div>

                            <!-- Hidden input untuk mengirim nilai -->
                            <input type="hidden" name="subject_id" x-model="selected">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2">Deskripsi Topik Utama (Opsional)</label>
                            <textarea name="description"
                                      rows="4"
                                      class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('guru.lms.index') }}"
                               class="inline-flex items-center justify-center px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50 group">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Simpan & Lanjut Tambah Konten
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Tidak perlu jQuery atau Select2 — murni Alpine.js + Tailwind
    </script>
    @endpush
</x-app-layout>