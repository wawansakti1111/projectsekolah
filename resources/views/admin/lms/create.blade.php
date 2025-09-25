<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Buat Topik Materi Baru') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola konten pembelajaran dengan mudah dan terstruktur</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-green-50 via-emerald-50 to-white min-h-screen relative overflow-hidden" x-data="materiForm()">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <form method="POST" action="{{ route('admin.lms.store') }}" enctype="multipart/form-data">
                @csrf

                @if ($errors->any())
                    <div class="mb-8 p-6 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-400 text-red-700 rounded-r-2xl shadow-lg backdrop-blur-sm animate-fade-in">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-red-500 mt-0.5 mr-3 flex-shrink-0 animate-bounce-slow" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p class="font-bold text-lg mb-2">Terjadi kesalahan:</p>
                                <ul class="list-disc list-inside space-y-1 ml-2 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 relative">
                    <!-- Decorative top border -->
                    <div class="h-2 bg-gradient-to-r from-green-500 via-emerald-500 to-green-600"></div>
                    
                    <div class="p-8 md:p-10 text-gray-900 space-y-8">
                        
                        <!-- Main Topic Section -->
                        <div class="border-b border-green-200 pb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-green-800">Detail Topik Utama</h3>
                                    <p class="text-green-600 text-sm">Informasi dasar tentang materi pembelajaran</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <x-input-label for="title" value="Judul Topik Materi" class="text-green-800 font-semibold" />
                                <div class="relative group">
                                    <x-text-input id="title" class="block w-full border border-green-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base" type="text" name="title" :value="old('title')" required />
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-2">
                                <x-input-label for="user_id" value="Guru Pembuat Materi" class="text-green-800 font-semibold" />
                                <div class="relative group">
                                    <select name="user_id" id="user_id" class="block w-full border border-green-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base bg-white appearance-none" required>
                                        <option value="">-- Pilih Guru --</option>
                                        @foreach ($gurus as $guru)
                                            <option value="{{ $guru->id }}" @selected(old('user_id') == $guru->id)>{{ $guru->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-2 md:col-span-2">
                                <x-input-label for="subject_id" value="Mata Pelajaran (Opsional)" class="text-green-800 font-semibold" />
                                <div class="relative group">
                                    <select name="subject_id" id="subject_id" class="block w-full border border-green-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base bg-white appearance-none">
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <x-input-label for="description" value="Deskripsi Topik Utama (Opsional)" class="text-green-800 font-semibold" />
                            <div class="relative group">
                                <textarea name="description" id="description" rows="3" class="block w-full border border-green-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base resize-none">{{ old('description') }}</textarea>
                                <div class="absolute left-3 top-4 text-green-500">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="border-t border-green-200 pt-8">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-green-800">Konten / Sub Materi</h3>
                                    <p class="text-green-600 text-sm">Tambahkan konten pembelajaran yang beragam</p>
                                </div>
                                <div class="flex items-center space-x-1 ml-auto">
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                    <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
                                </div>
                            </div>
                        </div>

                        <div x-ref="sortableContainer" class="space-y-6">
                            <template x-for="(content, index) in contents" :key="content.id">
                                <div class="relative group">
                                    <div class="p-6 border border-green-200 rounded-xl bg-green-50/50 hover:bg-green-50 transition-all duration-300 hover:shadow-md">
                                        <div class="flex items-start justify-between mb-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                                    <span x-text="index + 1"></span>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-green-800" x-text="`Konten #${index + 1}`"></h4>
                                                    <p class="text-green-600 text-sm">Materi pembelajaran interaktif</p>
                                                </div>
                                            </div>
                                            <button type="button" @click="removeContent(index)" class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition-all duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="space-y-4">
                                            <div>
                                                <x-input-label value="Judul Konten" class="text-green-800 font-semibold mb-1" />
                                                <div class="relative group">
                                                    <input type="text" class="block w-full border border-green-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-9 py-2.5 text-base" :name="`contents[${index}][title]`" required>
                                                    <div class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-green-500">
                                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <x-input-label value="Tipe Konten" class="text-green-800 font-semibold mb-1" />
                                                <div class="relative group">
                                                    <select class="block w-full border border-green-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-9 py-2.5 text-base bg-white appearance-none" x-model="content.type" :name="`contents[${index}][type]`" required>
                                                        <option value="file">📁 Upload File</option>
                                                        <option value="video_link">🎥 Link Video</option>
                                                    </select>
                                                    <div class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-green-500">
                                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <x-input-label value="Deskripsi Konten (Opsional)" class="text-green-800 font-semibold mb-1" />
                                                <div class="relative group">
                                                    <textarea rows="2" class="block w-full border border-green-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-9 py-2.5 text-base resize-none" :name="`contents[${index}][description]`"></textarea>
                                                    <div class="absolute left-2.5 top-3 text-green-500">
                                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <div x-show="content.type === 'file'" class="bg-white p-4 rounded-lg border border-dashed border-green-300 hover:border-green-400 transition-colors">
                                                <x-input-label value="File Lampiran" class="text-green-800 font-semibold mb-2" />
                                                <label class="flex flex-col items-center justify-center w-full h-24 border border-green-300 border-dashed rounded-lg cursor-pointer hover:bg-green-50 transition-colors">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <svg class="w-6 h-6 mb-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                        </svg>
                                                        <p class="text-xs text-green-600 text-center">Klik untuk upload file (PDF, DOC, PPT, dll)</p>
                                                    </div>
                                                    <input type="file" class="hidden" :name="`contents[${index}][file]`">
                                                </label>
                                            </div>
                                            
                                            <div x-show="content.type === 'video_link'" class="bg-white p-4 rounded-lg border border-red-200">
                                                <x-input-label value="URL Video" class="text-green-800 font-semibold mb-2" />
                                                <div class="relative group">
                                                    <input type="url" class="block w-full border border-red-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-500/30 transition-all duration-300 pl-9 py-2.5 text-base" placeholder="https://youtube.com/..." :name="`contents[${index}][url]`">
                                                    <div class="absolute left-2.5 top-1/2 transform -translate-y-1/2 text-red-500">
                                                        <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="flex justify-center pt-4">
                            <x-secondary-button type="button" @click="addContent()" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-100 to-emerald-100 hover:from-green-200 hover:to-emerald-200 text-green-700 font-semibold rounded-lg border border-green-300 hover:border-green-400 transition-all duration-300 hover:shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Konten Baru
                            </x-secondary-button>
                        </div>

                        <!-- Action buttons -->
                        <div class="flex items-center justify-between pt-6 border-t border-green-200">
                            <a href="{{ route('admin.lms.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 text-green-600 hover:text-green-800 font-semibold transition-all duration-300 rounded-lg hover:bg-green-50">
                                <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Daftar
                            </a>
                            <x-primary-button class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ __('Simpan Materi') }}
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
        .animate-bounce-slow { animation: bounceSlow 2s infinite; }
    </style>

    <script>
        function materiForm() {
            return {
                contents: [{ id: 1, type: 'file' }],
                nextId: 2,
                init() {
                    if (typeof Sortable !== 'undefined') {
                        Sortable.create(this.$refs.sortableContainer, { 
                            animation: 150, 
                            handle: '.cursor-grab' 
                        });
                    }
                },
                addContent() { 
                    this.contents.push({ id: this.nextId++, type: 'file' }); 
                },
                removeContent(index) { 
                    this.contents.splice(index, 1); 
                }
            }
        }
    </script>
</x-app-layout>