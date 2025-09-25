<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3 animate-pulse">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                </svg>
                <div class="absolute -top-1 -right-1 h-3 w-3 bg-green-400 rounded-full animate-ping"></div>
            </div>
            <h2 class="font-extrabold text-3xl bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">
                {{ __('Tambah Mata Pelajaran Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-sm overflow-hidden shadow-xl sm:rounded-3xl border border-green-200/50">
                <div class="p-8 md:p-10 text-gray-900 space-y-8">

                    <!-- Form Title -->
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-green-800">Tambah Mata Pelajaran Baru</h3>
                        <p class="text-green-600 mt-1">Masukkan nama mata pelajaran untuk menambahkan ke sistem.</p>
                    </div>

                    <!-- Form -->
                    <form method="POST" action="{{ route('admin.subject.store') }}" class="space-y-6">
                        @csrf

                        <!-- Input Field -->
                        <div class="space-y-4">
                            <label for="name" class="block text-sm font-medium text-green-800">Nama Mata Pelajaran</label>
                            <div class="relative group">
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus 
                                    class="block w-full px-4 py-4 border-2 border-green-300 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 pl-12 text-base font-medium shadow-sm hover:shadow-md"
                                />
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-green-500">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            </div>

                            @if($errors->has('name'))
                                <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-r-lg animate-fade-in">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 mt-0.5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ $errors->first('name') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('admin.proyek.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50">
                                <svg class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>

                            <!-- ✅ TOMBOL SIMPAN DIPERBAIKI -->
                            <x-primary-button class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>