@php
    $isModal = request('view') === 'modal';
    // Pastikan data dikonversi ke format array eksplisit untuk Alpine.js
    $subjectsArray = $subjects->map(fn($s) => ['id' => $s->id, 'name' => $s->name])->values();
    $materialsArray = $materials->map(fn($m) => ['id' => $m->id, 'title' => $m->title])->values();
@endphp

@if ($isModal)
    {{-- Tampilan Modal --}}
    <x-modal-layout>
        <div class="p-6 md:p-8 text-gray-900">
            <div class="mb-6">
                <h3 class="text-xl font-bold text-green-800 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Informasi Kuis
                </h3>
                <p class="text-green-600 text-sm mt-1">Isi detail kuis baru Anda</p>
            </div>

            <form method="POST" action="{{ route('guru.quiz.store') }}" class="space-y-6">
                @csrf
                <input type="hidden" name="view" value="modal">

                <!-- Judul Kuis -->
                <div>
                    <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Judul Kuis
                    </label>
                    <input type="text"
                           name="title"
                           value="{{ old('title') }}"
                           class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                           required />
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dropdown Mata Pelajaran -->
                <div x-data="{ 
                    open: false, 
                    selected: @js(old('subject_id')), 
                    subjects: @js($subjectsArray) 
                }" @click.away="open = false" class="relative">
                    <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Mata Pelajaran
                    </label>
                    <div @click="open = !open"
                         class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                         :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''"
                         required>
                        <span x-text="selected ? subjects.find(s => s.id == selected)?.name || '-- Pilih Mata Pelajaran --'" 
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
                    @error('subject_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dropdown Materi Terkait (Opsional) -->
                @if($materials->isNotEmpty())
                <div x-data="{ 
                    open: false, 
                    selected: @js(old('lms_material_id')), 
                    materials: @js($materialsArray) 
                }" @click.away="open = false" class="relative">
                    <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M9 11a2 2 0 114 0m-4 0V9a2 2 0 012-2m-2 0V5a2 2 0 012-2" />
                        </svg>
                        Materi Terkait (Opsional)
                    </label>
                    <div @click="open = !open"
                         class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                         :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''">
                        <span x-text="selected ? materials.find(m => m.id == selected)?.title || '-- Pilih Materi --'" 
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
                        <template x-for="material in materials" :key="material.id">
                            <div @click="selected = material.id; open = false"
                                 @mouseenter="this.style.backgroundColor = '#ecfdf5'"
                                 @mouseleave="this.style.backgroundColor = 'white'"
                                 class="px-4 py-3 text-gray-900 cursor-pointer hover:bg-emerald-50 transition-colors flex items-center">
                                <span x-text="material.title"></span>
                                <svg x-show="selected == material.id" class="ml-auto w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </template>
                    </div>
                    <input type="hidden" name="lms_material_id" x-model="selected">
                </div>
                @endif

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Deskripsi (Opsional)
                    </label>
                    <textarea name="description"
                              rows="3"
                              class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end pt-6 border-t border-green-200">
                    <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow hover:scale-105 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan & Pilih Kuis
                    </button>
                </div>
            </form>
        </div>
    </x-modal-layout>
@else
    {{-- Tampilan Halaman Penuh --}}
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-3xl text-white leading-tight">
                                {{ __('Buat Kuis Baru') }}
                            </h2>
                            <p class="text-green-100 text-sm mt-1">Buat kuis interaktif berbasis Tujuan Pembangunan Berkelanjutan</p>
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

                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-green-800 flex items-center gap-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                Informasi Kuis
                            </h3>
                            <p class="text-green-600 text-sm mt-1">Isi detail kuis baru Anda</p>
                        </div>

                        <form method="POST" action="{{ route('guru.quiz.store') }}" class="space-y-6">
                            @csrf

                            <!-- Judul Kuis -->
                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Judul Kuis
                                </label>
                                <input type="text"
                                       name="title"
                                       value="{{ old('title') }}"
                                       class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                       required />
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dropdown Mata Pelajaran -->
                            <div x-data="{ 
                                open: false, 
                                selected: @js(old('subject_id')), 
                                subjects: @js($subjectsArray) 
                            }" @click.away="open = false" class="relative">
                                <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    Mata Pelajaran
                                </label>
                                <div @click="open = !open"
                                     class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                                     :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''"
                                     required>
                                    <span x-text="selected ? subjects.find(s => s.id == selected)?.name || '-- Pilih Mata Pelajaran --'" 
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
                                @error('subject_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dropdown Materi Terkait (Opsional) -->
                            @if($materials->isNotEmpty())
                            <div x-data="{ 
                                open: false, 
                                selected: @js(old('lms_material_id')), 
                                materials: @js($materialsArray) 
                            }" @click.away="open = false" class="relative">
                                <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M9 11a2 2 0 114 0m-4 0V9a2 2 0 012-2m-2 0V5a2 2 0 012-2" />
                                    </svg>
                                    Materi Terkait (Opsional)
                                </label>
                                <div @click="open = !open"
                                     class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                                     :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''">
                                    <span x-text="selected ? materials.find(m => m.id == selected)?.title || '-- Pilih Materi --'" 
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
                                    <template x-for="material in materials" :key="material.id">
                                        <div @click="selected = material.id; open = false"
                                             @mouseenter="this.style.backgroundColor = '#ecfdf5'"
                                             @mouseleave="this.style.backgroundColor = 'white'"
                                             class="px-4 py-3 text-gray-900 cursor-pointer hover:bg-emerald-50 transition-colors flex items-center">
                                            <span x-text="material.title"></span>
                                            <svg x-show="selected == material.id" class="ml-auto w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </template>
                                </div>
                                <input type="hidden" name="lms_material_id" x-model="selected">
                            </div>
                            @endif

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Deskripsi (Opsional)
                                </label>
                                <textarea name="description"
                                          rows="3"
                                          class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-4 pt-6 border-t border-green-200">
                                <a href="{{ route('guru.quiz.index') }}"
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
                                    Lanjut & Tambah Pertanyaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif