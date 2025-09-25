<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 animate-fade-in">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <div class="absolute -top-1 -right-1 h-3 w-3 bg-green-400 rounded-full animate-ping-slow"></div>
            </div>
            <h2 class="font-extrabold text-3xl bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent animate-gradient-x">
                {{ __('Tambah Proyek Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <form method="POST" action="{{ route('admin.proyek.store') }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf

                        <!-- Guru, Judul, Mata Pelajaran -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2 group">
                                <x-input-label for="user_id" :value="__('Guru Pemilik')" class="text-green-800 font-semibold flex items-center gap-2" />
                                <div class="relative">
                                    <select name="user_id" id="user_id" class="block w-full border border-green-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base bg-white appearance-none group-hover:border-green-400" required>
                                        <option value="">-- Pilih Guru --</option>
                                        @foreach ($gurus as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 group">
                                <x-input-label for="title" :value="__('Judul Proyek')" class="text-green-800 font-semibold flex items-center gap-2" />
                                <div class="relative">
                                    <x-text-input id="title" name="title" type="text" class="block w-full border border-green-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base group-hover:border-green-400" required />
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 group">
                                <x-input-label for="subject_id" :value="__('Mata Pelajaran')" class="text-green-800 font-semibold flex items-center gap-2" />
                                <div class="relative">
                                    <select name="subject_id" id="subject_id" class="block w-full border border-green-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base bg-white appearance-none group-hover:border-green-400" required>
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deadline -->
                        <div class="space-y-2 group">
                            <x-input-label for="deadline" :value="__('Deadline (Opsional)')" class="text-green-800 font-semibold flex items-center gap-2" />
                            <div class="relative">
                                <input id="deadline" type="date" name="deadline" class="block w-full border border-green-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base group-hover:border-green-400" :value="old('deadline')" />
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="space-y-2 group">
                            <x-input-label for="description" :value="__('Deskripsi')" class="text-green-800 font-semibold flex items-center gap-2" />
                            <div class="relative">
                                <textarea name="description" rows="4" class="block w-full border border-green-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/30 transition-all duration-300 pl-10 py-3 text-base resize-none group-hover:border-green-400"></textarea>
                                <div class="absolute left-3 top-4 text-green-500">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Materi -->
                        <div class="space-y-2">
                            <x-input-label for="attachment" :value="__('Upload Materi (Opsional)')" class="text-green-800 font-semibold flex items-center gap-2" />
                            <label class="flex flex-col w-full h-32 border-2 border-dashed border-green-300 rounded-xl cursor-pointer bg-green-50 hover:bg-green-100 transition-all duration-300 group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-3 text-green-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mb-2 text-sm text-green-600"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                    <p class="text-xs text-green-500">PDF, DOC, ZIP, atau file lainnya</p>
                                </div>
                                <input type="file" id="attachment" name="attachment" class="hidden" />
                            </label>
                        </div>

                        <!-- Pilih SDG -->
                        <div class="space-y-4">
                            <x-input-label :value="__('Pilih SDG yang Sesuai')" class="text-green-800 font-bold text-lg mb-4 flex items-center gap-2" />
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach ($sdgs as $sdg)
                                <label for="sdg-{{$sdg->id}}" class="flex items-center space-x-3 p-4 border-2 border-green-200 rounded-xl hover:bg-green-50 hover:border-green-400 transition-all duration-300 cursor-pointer group">
                                    <div class="relative">
                                        <input type="checkbox" name="sdgs[]" value="{{$sdg->id}}" id="sdg-{{$sdg->id}}" class="sr-only peer" />
                                        <div class="w-5 h-5 rounded border-2 border-green-400 peer-checked:bg-green-500 peer-checked:border-green-500 flex items-center justify-center transition-colors duration-200">
                                            <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                    </div>
                                    <span class="text-green-800 font-medium group-hover:text-green-700 transition-colors">{{ $sdg->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('admin.proyek.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50 group">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <x-primary-button class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        @keyframes pingSlow {
            0% { transform: scale(1); opacity: 1; }
            75%, 100% { transform: scale(1.5); opacity: 0; }
        }
        @keyframes gradientX {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .animate-fade-in { animation: fadeIn 0.6s ease-out; }
        .animate-bounce-slow { animation: bounceSlow 2s infinite ease-in-out; }
        .animate-ping-slow { animation: pingSlow 1.5s cubic-bezier(0, 0, 0.2, 1) infinite; }
        .animate-gradient-x { background-size: 200% 200%; animation: gradientX 3s ease infinite; }
    </style>
</x-app-layout>