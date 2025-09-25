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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Dashboard') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Pusat kendali sistem manajemen pembelajaran</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- 1. Manajemen LMS -->
                <a href="{{ route('admin.lms.index') }}" class="group block">
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-md">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                    </svg>
                                </div>
                                <span class="inline-block w-8 h-8 rounded-full bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <svg class="w-4 h-4 text-green-600 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-xl font-bold text-green-800">Manajemen LMS</h3>
                                <p class="mt-2 text-green-600 text-sm">Kelola materi pembelajaran digital</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- 2. Manajemen Proyek -->
                <a href="{{ route('admin.proyek.index') }}" class="group block">
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-md">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <span class="inline-block w-8 h-8 rounded-full bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <svg class="w-4 h-4 text-green-600 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-xl font-bold text-green-800">Manajemen Proyek</h3>
                                <p class="mt-2 text-green-600 text-sm">Kelola proyek pembelajaran berbasis SDG</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- 3. Manajemen Mata Pelajaran -->
                <a href="{{ route('admin.subject.index') }}" class="group block">
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-md">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                    </svg>
                                </div>
                                <span class="inline-block w-8 h-8 rounded-full bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <svg class="w-4 h-4 text-green-600 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-xl font-bold text-green-800">Manajemen Mata Pelajaran</h3>
                                <p class="mt-2 text-green-600 text-sm">Kelola kurikulum mata pelajaran</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- 4. Manajemen SDG -->
                <a href="{{ route('admin.sdg.index') }}" class="group block">
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-md">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="inline-block w-8 h-8 rounded-full bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <svg class="w-4 h-4 text-green-600 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-xl font-bold text-green-800">Manajemen SDG</h3>
                                <p class="mt-2 text-green-600 text-sm">Kelola Tujuan Pembangunan Berkelanjutan</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- 5. Pusat Manajemen (Akun & Kelas) -->
                <a href="{{ route('admin.manajemen.index') }}" class="group block">
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-md">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                </div>
                                <span class="inline-block w-8 h-8 rounded-full bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                    <svg class="w-4 h-4 text-green-600 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                            <div class="mt-6">
                                <h3 class="text-xl font-bold text-green-800">Pusat Manajemen</h3>
                                <p class="mt-2 text-green-600 text-sm">Kelola akun pengguna & kelas</p>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- 6. Statistik atau Laporan (Opsional - bisa diganti jika ada) -->
                <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-md">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3l-3-3" />
                            </svg>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="text-xl font-bold text-green-800">Laporan & Statistik</h3>
                            <p class="mt-2 text-green-600 text-sm">Ringkasan aktivitas sistem secara real-time</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
    </style>
</x-app-layout>