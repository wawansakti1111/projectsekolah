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
                            {{ __('Dashboard Kepala Sekolah') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Ringkasan data sekolah secara real-time</p>
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
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8">
                    <h3 class="text-2xl font-bold mb-8 text-gray-900 flex items-center gap-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        {{ __('Ringkasan Data Sekolah') }}
                    </h3>

                    <!-- Statistik Proyek -->
                    <h4 class="text-xl font-bold mb-5 text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        {{ __('Statistik Proyek') }}
                    </h4>
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mb-10">
                        <!-- Proyek Berjalan -->
                        <div class="group p-6 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 uppercase opacity-90">{{ __('Proyek Berjalan') }}</p>
                                    <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ number_format($totalCounts['Proyek Berjalan']) }}</p>
                                </div>
                                <div class="w-12 h-12 rounded-xl bg-indigo-400/30 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Proyek Selesai -->
                        <div class="group p-6 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up delay-100">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 uppercase opacity-90">{{ __('Proyek Selesai') }}</p>
                                    <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ number_format($totalCounts['Proyek Selesai']) }}</p>
                                </div>
                                <div class="w-12 h-12 rounded-xl bg-emerald-400/30 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Total Proyek -->
                        <div class="group p-6 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up delay-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 uppercase opacity-90">{{ __('Total Proyek') }}</p>
                                    <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ number_format($totalCounts['Total Proyek']) }}</p>
                                </div>
                                <div class="w-12 h-12 rounded-xl bg-purple-400/30 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Umum -->
                    <h4 class="text-xl font-bold mb-5 text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        {{ __('Statistik Akun & Pembelajaran') }}
                    </h4>
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @php
                            $generalCards = [
                                'Siswa' => ['icon' => 'users', 'color' => 'from-red-500 to-red-600', 'iconColor' => 'text-red-200', 'bgIcon' => 'bg-red-400/30'],
                                'Guru' => ['icon' => 'chalkboard-teacher', 'color' => 'from-blue-500 to-blue-600', 'iconColor' => 'text-blue-200', 'bgIcon' => 'bg-blue-400/30'],
                                'Kelas' => ['icon' => 'school', 'color' => 'from-amber-500 to-amber-600', 'iconColor' => 'text-amber-200', 'bgIcon' => 'bg-amber-400/30'],
                                'Mata Pelajaran' => ['icon' => 'book-open', 'color' => 'from-green-500 to-emerald-600', 'iconColor' => 'text-emerald-200', 'bgIcon' => 'bg-emerald-400/30'],
                                'SDG' => ['icon' => 'globe', 'color' => 'from-pink-500 to-pink-600', 'iconColor' => 'text-pink-200', 'bgIcon' => 'bg-pink-400/30'],
                                'Materi LMS' => ['icon' => 'document-text', 'color' => 'from-teal-500 to-teal-600', 'iconColor' => 'text-teal-200', 'bgIcon' => 'bg-teal-400/30'],
                                'Kuis' => ['icon' => 'clipboard-check', 'color' => 'from-orange-500 to-orange-600', 'iconColor' => 'text-orange-200', 'bgIcon' => 'bg-orange-400/30'],
                            ];
                        @endphp

                        @foreach ($generalCards as $label => $config)
                            @if(isset($totalCounts[$label]))
                                <div class="group p-6 bg-gradient-to-br {{ $config['color'] }} rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 animate-fade-in-up">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-700 uppercase opacity-90">{{ $label }}</p>
                                            <p class="text-3xl font-extrabold text-gray-900 mt-1">{{ number_format($totalCounts[$label]) }}</p>
                                        </div>
                                        <div class="w-12 h-12 rounded-xl {{ $config['bgIcon'] }} flex items-center justify-center">
                                            @if($config['icon'] === 'users')
                                                <svg class="w-6 h-6 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                </svg>
                                            @elseif($config['icon'] === 'chalkboard-teacher')
                                                <svg class="w-6 h-6 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            @elseif($config['icon'] === 'school')
                                                <svg class="w-6 h-6 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            @elseif($config['icon'] === 'book-open')
                                                <svg class="w-6 h-6 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                                </svg>
                                            @elseif($config['icon'] === 'globe')
                                                <svg class="w-6 h-6 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif($config['icon'] === 'document-text')
                                                <svg class="w-6 h-6 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            @elseif($config['icon'] === 'clipboard-check')
                                                <svg class="w-6 h-6 {{ $config['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                </svg>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animations -->
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .animate-fade-in-up:nth-child(1) { animation-delay: 0.0s; }
        .animate-fade-in-up:nth-child(2) { animation-delay: 0.05s; }
        .animate-fade-in-up:nth-child(3) { animation-delay: 0.1s; }
        .animate-fade-in-up:nth-child(4) { animation-delay: 0.15s; }
        .animate-fade-in-up:nth-child(5) { animation-delay: 0.2s; }
        .animate-fade-in-up:nth-child(6) { animation-delay: 0.25s; }
        .animate-fade-in-up:nth-child(7) { animation-delay: 0.3s; }
        .animate-fade-in-up:nth-child(8) { animation-delay: 0.35s; }
        .delay-100 { animation-delay: 0.1s !important; }
        .delay-200 { animation-delay: 0.2s !important; }
    </style>
</x-app-layout>