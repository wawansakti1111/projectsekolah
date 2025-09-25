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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Dasbor Guru') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Selamat datang di sistem manajemen pembelajaran</p>
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
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 p-6 md:p-8 text-gray-900">
                <h3 class="text-xl font-bold text-green-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="mt-2 text-green-600 text-sm">Akses cepat di bawah akan membantu Anda mengelola tugas.</p>
            </div>

            <!-- Kartu Tombol Akses Cepat Guru -->
            <div class="mt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Proyek Saya -->
                    <a href="{{ route('guru.proyek.index') }}" class="group block">
                        <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 group">
                            <div class="p-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-green-800 text-lg">Proyek Saya</h4>
                                <p class="mt-2 text-green-600 text-sm">Kelola proyek yang Anda buat.</p>
                            </div>
                        </div>
                    </a>

                    <!-- Penilaian Proyek -->
                    <a href="{{ route('guru.proyek.index') }}" class="group block">
                        <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 group">
                            <div class="p-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-green-800 text-lg">Penilaian Proyek</h4>
                                <p class="mt-2 text-green-600 text-sm">Nilai pengajuan proyek siswa.</p>
                            </div>
                        </div>
                    </a>

                    <!-- Materi LMS -->
                    <a href="{{ route('guru.lms.index') }}" class="group block">
                        <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 group">
                            <div class="p-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-green-800 text-lg">Materi LMS</h4>
                                <p class="mt-2 text-green-600 text-sm">Kelola materi ajar Anda.</p>
                            </div>
                        </div>
                    </a>

                    <!-- Daftar Kuis -->
                    <a href="{{ route('guru.quiz.index') }}" class="group block">
                        <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-300 group">
                            <div class="p-6">
                                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md mb-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-green-800 text-lg">Daftar Kuis</h4>
                                <p class="mt-2 text-green-600 text-sm">Buat dan kelola kuis.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- DAFTAR PROYEK AKTIF DENGAN NOTIFIKASI SUBMISSION BARU -->
            <div class="mt-10">
                <h3 class="text-xl font-bold text-green-800 mb-6">Proyek Aktif Saya</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($activeProjects as $project)
                        <a href="{{ route('guru.proyek.show', $project) }}" class="relative block bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 p-6 hover:bg-green-50 transition-all duration-300 group">
                            <h4 class="font-bold text-green-800 text-lg">{{ $project->title }}</h4>
                            @if($project->deadline)
                                <p class="text-sm text-green-600 mt-2">Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}</p>
                            @else
                                <p class="text-sm text-gray-500 mt-2">Tidak ada tenggat waktu</p>
                            @endif
                            <p class="text-sm text-green-600 mt-3">{{ $project->enrollments_count }} Siswa Terdaftar</p>

                            <!-- Notifikasi Submission Baru -->
                            @if($project->new_submissions_count > 0)
                                <div class="absolute top-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-2.5 py-1.5 rounded-full shadow-md animate-pulse">
                                    {{ $project->new_submissions_count }} Baru
                                </div>
                            @endif
                        </a>
                    @empty
                        <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 p-12 text-center">
                            <svg class="w-16 h-16 text-gray-300 mx-auto animate-bounce-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="mt-4 text-gray-500 font-medium">Anda belum memiliki proyek aktif.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            <!-- AKHIR DAFTAR PROYEK AKTIF -->
        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
        .animate-bounce-slow { animation: bounceSlow 2s infinite; }
    </style>
</x-app-layout>