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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Materi Belajar (LMS)') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Pelajari materi dari guru Anda kapan saja</p>
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

            <!-- Search Bar -->
            <div class="mb-8 animate-fade-in-up">
                <form action="{{ route('siswa.lms.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-grow">
                        <input type="text"
                               name="search"
                               placeholder="Cari materi, mata pelajaran, atau guru..."
                               value="{{ request('search') }}"
                               class="w-full pl-12 pr-4 py-4 rounded-2xl border-2 border-green-200 focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 bg-white/80 backdrop-blur-sm shadow-sm"
                        />
                        <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                                class="px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('siswa.lms.index') }}"
                               class="px-6 py-4 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-2xl hover:bg-green-50 transition-colors duration-300 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Materials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($materials as $material)
                    <div x-data="{ isBookmarked: {{ in_array($material->id, $bookmarkedIds) ? 'true' : 'false' }} }"
                         class="group relative bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-2 transition-all duration-500 transform origin-center animate-fade-in-up">

                        <!-- Bookmark Button -->
                        <form action="{{ route('siswa.lms.bookmark.toggle', $material) }}" method="POST" class="absolute top-4 right-4 z-10">
                            @csrf
                            <button type="submit"
                                    @click.prevent="isBookmarked = !isBookmarked; $el.closest('form').submit()"
                                    class="p-3 rounded-full bg-white/90 backdrop-blur-sm shadow-md hover:shadow-lg transition-all duration-300"
                                    :class="isBookmarked ? 'text-red-500 hover:text-red-600' : 'text-gray-400 hover:text-green-500'">
                                <svg class="w-6 h-6 transition-transform duration-300"
                                     :class="isBookmarked ? 'fill-current scale-110 rotate-12' : 'fill-none'"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </button>
                        </form>

                        <div class="p-6 md:p-8 flex flex-col h-full">
                            <!-- Subject Badge with Icon -->
                            <div class="mb-5">
                                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 text-green-700 text-sm font-medium border border-green-200">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    {{ $material->subject->name ?? 'Umum' }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="font-bold text-xl text-gray-900 mb-4 group-hover:text-green-700 transition-colors line-clamp-2">
                                {{ $material->title }}
                            </h3>

                            <!-- Uploader with Avatar -->
                            <div class="flex items-center gap-3 mb-5">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                    {{ substr($material->uploader->name ?? 'G', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Oleh: {{ $material->uploader->name ?? 'Guru' }}</p>
                                    <div class="flex items-center gap-1.5 mt-1">
                                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span class="text-sm text-gray-600">Guru Pengajar</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-700 text-sm mb-6 flex-grow line-clamp-3">
                                {{ Str::limit($material->description, 120) }}
                            </p>

                            <!-- Stats with Icons -->
                            <div class="flex justify-between text-sm text-gray-600 mb-6 border-t border-green-100 pt-5">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-green-50 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <span>{{ $material->contents->count() }} file</span>
                                </div>
                                @if($material->updated_at)
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <span>{{ $material->updated_at->format('d M Y') }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <a href="{{ route('siswa.lms.show', $material) }}"
                               class="w-full inline-flex items-center justify-center gap-3 px-6 py-3.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02] group/btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                                <span>Buka Materi</span>
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>

                        <!-- Hover glow effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-green-400/8 to-emerald-400/8 opacity-0 group-hover:opacity-20 transition-opacity rounded-3xl pointer-events-none"></div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-200/50 p-16 text-center">
                            <div class="flex flex-col items-center justify-center space-y-6 text-gray-500">
                                <div class="relative">
                                    <svg class="w-24 h-24 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div class="absolute -top-2 -right-2 h-4 w-4 bg-green-400 rounded-full animate-ping"></div>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-gray-700">Belum ada materi</p>
                                    <p class="text-gray-600 mt-2 max-w-md">Materi akan muncul segera setelah guru Anda mengunggahnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($materials->hasPages())
                <div class="mt-12 flex justify-center">
                    <div class="inline-flex rounded-2xl shadow-lg p-1 bg-white/60 backdrop-blur border border-gray-200">
                        {{ $materials->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

    <!-- Staggered Animation -->
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); 
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