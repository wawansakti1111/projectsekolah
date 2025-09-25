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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Daftar Proyek Tersedia') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Temukan proyek menarik untuk diikuti</p>
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

            <!-- Search & Filter -->
            <div class="mb-8 animate-fade-in-up">
                <form action="{{ route('siswa.proyek.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="relative flex-grow">
                        <input type="text"
                               name="search"
                               placeholder="Cari proyek..."
                               value="{{ request('search') }}"
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl border-2 border-green-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm"
                        />
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <div class="relative flex-grow">
                        <select name="subject_id"
                                class="w-full pl-4 pr-10 py-3.5 rounded-xl border-2 border-green-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm appearance-none">
                            <option value="">Semua Mata Pelajaran</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-6 py-3.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            Filter
                        </button>
                        <a href="{{ route('siswa.proyek.index') }}"
                           class="px-6 py-3.5 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-green-50 transition-colors duration-300">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                @forelse ($projects as $project)
                    <div class="group relative bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 transform animate-fade-in-up">

                        <div class="p-6 md:p-7 flex flex-col h-full">
                            <!-- Title -->
                            <h3 class="font-bold text-xl text-gray-900 mb-3 group-hover:text-green-700 transition-colors line-clamp-2">
                                {{ $project->title }}
                            </h3>

                            <!-- Teacher & Subject -->
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                        <span class="text-green-700 text-xs font-bold">
                                            {{ substr($project->teacher->name ?? 'G', 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $project->teacher->name ?? 'Guru' }}</span>
                                </div>
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium border border-green-200">
                                    {{ $project->subject->name ?? 'Umum' }}
                                </span>
                            </div>

                            <!-- Deadline -->
                            @if($project->deadline)
                                <div class="flex items-center gap-1.5 mb-4">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium text-red-600">
                                        Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                                    </span>
                                </div>
                            @endif

                            <!-- Description -->
                            <p class="text-gray-700 text-sm mb-5 flex-grow line-clamp-3">
                                {{ Str::limit($project->description, 120) }}
                            </p>

                            <!-- SDGs Tags -->
                            @if($project->sdgs->isNotEmpty())
                                <div class="mb-6 flex flex-wrap gap-2">
                                    @foreach ($project->sdgs as $sdg)
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-medium border border-emerald-200">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $sdg->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Action Button -->
                            <a href="{{ route('siswa.proyek.show', $project->id) }}"
                               class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 hover:scale-[1.02] group/btn">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                                <span>Lihat & Daftar</span>
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>

                        <!-- Hover glow -->
                        <div class="absolute inset-0 bg-gradient-to-br from-green-400/5 to-emerald-400/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-3xl pointer-events-none"></div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-200/50 p-16 text-center">
                            <div class="flex flex-col items-center justify-center space-y-6 text-gray-500">
                                <div class="relative">
                                    <svg class="w-24 h-24 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <div class="absolute -top-2 -right-2 h-4 w-4 bg-green-400 rounded-full animate-ping"></div>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-700">Belum ada proyek</p>
                                    <p class="text-gray-600 mt-2 max-w-md">Proyek akan muncul segera setelah guru mengunggahnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($projects->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="inline-flex rounded-2xl shadow-lg p-1 bg-white/60 backdrop-blur border border-gray-200">
                        {{ $projects->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- Simple Fade-In Animation -->
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .animate-fade-in-up:nth-child(1) { animation-delay: 0.0s; }
        .animate-fade-in-up:nth-child(2) { animation-delay: 0.1s; }
        .animate-fade-in-up:nth-child(3) { animation-delay: 0.2s; }
        .animate-fade-in-up:nth-child(4) { animation-delay: 0.3s; }
        .animate-fade-in-up:nth-child(5) { animation-delay: 0.4s; }
        .animate-fade-in-up:nth-child(6) { animation-delay: 0.5s; }
        .animate-fade-in-up:nth-child(7) { animation-delay: 0.6s; }
        .animate-fade-in-up:nth-child(8) { animation-delay: 0.7s; }
        .animate-fade-in-up:nth-child(9) { animation-delay: 0.8s; }
    </style>
</x-app-layout>