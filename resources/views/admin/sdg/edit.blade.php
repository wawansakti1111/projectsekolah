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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Edit Data SDG') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Perbarui Tujuan Pembangunan Berkelanjutan</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <form method="POST" action="{{ route('admin.sdg.update', $sdg->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama SDG -->
                        <div class="space-y-2 group">
                            <x-input-label for="name" :value="__('Nama SDG')" class="text-green-800 font-semibold flex items-center gap-2" />
                            <div class="relative">
                                <x-text-input 
                                    id="name" 
                                    class="block w-full border-2 border-green-300 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 pl-10 py-3 text-base group-hover:border-green-400"
                                    type="text" 
                                    name="name" 
                                    :value="old('name', $sdg->name)" 
                                    required 
                                    autofocus 
                                />
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-green-500">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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

                        <!-- Deskripsi (Opsional) -->
                        <div class="space-y-2 group">
                            <x-input-label for="description" :value="__('Deskripsi (Opsional)')" class="text-green-800 font-semibold flex items-center gap-2" />
                            <div class="relative">
                                <textarea 
                                    name="description" 
                                    id="description" 
                                    rows="4" 
                                    class="block w-full border-2 border-green-300 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 pl-10 py-3 text-base resize-none group-hover:border-green-400"
                                >{{ old('description', $sdg->description) }}</textarea>
                                <div class="absolute left-3 top-4 text-green-500">
                                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>
                                </div>
                            </div>
                            @if($errors->has('description'))
                                <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-r-lg animate-fade-in">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 mr-2 mt-0.5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>{{ $errors->first('description') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('admin.sdg.index') }}" class="inline-flex items-center gap-2 px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50 group">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <x-primary-button class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4 4m4-4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                                {{ __('Update') }}
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
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .animate-fade-in { animation: fadeIn 0.6s ease-out; }
        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
    </style>
</x-app-layout>