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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Tambah Akun Kepala Sekolah') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Buat akun baru untuk kepala sekolah</p>
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

                    <form method="POST" action="{{ route('admin.kepsek.store') }}" class="space-y-6">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Nama Lengkap
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                   required autofocus />
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                Username
                            </label>
                            <input type="text"
                                   name="username"
                                   value="{{ old('username') }}"
                                   class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                   required />
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email (Opsional) -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Email (Opsional)
                            </label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300" />
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Password
                            </label>
                            <input type="password"
                                   name="password"
                                   class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                   required />
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('admin.manajemen.index') }}"
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
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>