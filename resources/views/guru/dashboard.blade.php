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
                        <h2 class="font-extrabold text-3xl md:text-4xl text-white leading-tight tracking-tight">
                            {{ __('Dasbor Guru') }}
                        </h2>
                        <p class="text-green-100 text-base mt-1 font-medium">Selamat datang di sistem manajemen pembelajaran</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-10">

            <!-- Welcome Card -->
            <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-sm border border-green-100/60 p-6 md:p-7">
                <h3 class="text-xl font-bold text-green-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="mt-1 text-green-600">Akses cepat di bawah akan membantu Anda mengelola tugas.</p>
            </div>

            <!-- Akses Cepat -->
            <div>
                <h3 class="text-xl font-bold text-green-800 mb-5">Akses Cepat</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @php
                        $quickLinks = [
                            ['title' => 'Proyek Saya', 'desc' => 'Kelola proyek yang Anda buat.', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10', 'route' => route('guru.proyek.index')],
                            ['title' => 'Penilaian Proyek', 'desc' => 'Nilai pengajuan proyek siswa.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'route' => route('guru.proyek.index')],
                            ['title' => 'Materi LMS', 'desc' => 'Kelola materi ajar Anda.', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z', 'route' => route('guru.lms.index')],
                            ['title' => 'Daftar Kuis', 'desc' => 'Buat dan kelola kuis.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'route' => route('guru.quiz.index')],
                        ];
                    @endphp

                    @foreach ($quickLinks as $link)
                        <a href="{{ $link['route'] }}" class="block group">
                            <div class="bg-white/95 backdrop-blur-sm rounded-xl border border-gray-200/60 p-5 h-full transition-all duration-300 hover:border-green-400 hover:shadow-md hover:-translate-y-1">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center mb-4 flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}" />
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 group-hover:text-green-800">{{ $link['title'] }}</h4>
                                <p class="mt-2 text-sm text-gray-600">{{ $link['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Proyek Aktif -->
            <div>
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-green-800">Proyek Aktif Saya</h3>
                    @if($activeProjects->isNotEmpty())
                        <span class="text-sm font-medium text-gray-500">{{ $activeProjects->count() }} proyek</span>
                    @endif
                </div>

                @if($activeProjects->isNotEmpty())
                    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($activeProjects as $project)
                            <a href="{{ route('guru.proyek.show', $project) }}" class="block group">
                                <div class="bg-white/95 backdrop-blur-sm rounded-xl border border-gray-200/60 p-5 h-full transition-all duration-300 hover:border-green-400 hover:shadow-md">
                                    <div class="flex justify-between items-start gap-2">
                                        <h4 class="font-semibold text-gray-900 group-hover:text-green-800 line-clamp-2 flex-1">{{ $project->title }}</h4>
                                        @if($project->new_submissions_count > 0)
                                            <span class="inline-flex items-center justify-center bg-gradient-to-r from-green-500 to-emerald-600 text-white text-[10px] font-bold px-2 py-1 rounded-full min-w-[22px] h-6 flex-shrink-0 animate-pulse">
                                                {{ $project->new_submissions_count }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($project->deadline)
                                        <p class="text-xs text-green-600 mt-3 flex items-center">
                                            <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                                        </p>
                                    @else
                                        <p class="text-xs text-gray-500 mt-3">Tidak ada deadline</p>
                                    @endif

                                    <p class="text-xs text-gray-600 mt-2">
                                        {{ $project->enrollments_count }} siswa terdaftar
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="mt-6 bg-white/95 backdrop-blur-sm rounded-xl border border-gray-200/60 p-10 text-center">
                        <div class="w-14 h-14 mx-auto bg-green-50 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <p class="text-gray-600 font-medium">Anda belum memiliki proyek aktif.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        .animate-pulse-slow {
            animation: pulseSlow 1.8s infinite;
        }

        /* Gunakan Figtree dari Bunny.net */
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</x-app-layout>