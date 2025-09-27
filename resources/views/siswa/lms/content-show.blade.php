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
                        <h2 class="font-bold text-3xl text-white leading-tight truncate">
                            <a href="{{ route('siswa.lms.show', $lmsContent->material) }}" class="text-white hover:text-emerald-100 hover:underline transition-colors">
                                {{ $lmsContent->material->title }}
                            </a>
                            <span class="text-green-200 font-medium mx-2">/</span>
                            <span class="text-white">{{ $lmsContent->title }}</span>
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Pelajari semua materi di bawah ini</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden"
         x-data="{ isImageModalOpen: false, imageUrl: '' }">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Sidebar Navigasi -->
                <div class="lg:col-span-1 animate-fade-in-up">
                    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-green-200/50 overflow-hidden">
                        <div class="p-5 border-b border-green-100">
                            <a href="{{ route('siswa.lms.show', $lmsContent->material) }}" 
                               class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-800 group">
                                <svg class="h-4 w-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Daftar Konten
                            </a>
                        </div>
                        <div class="p-5">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                Navigasi
                            </h3>
                            <nav class="space-y-2">
                                @foreach ($lmsContent->material->contents as $contentItem)
                                    @php $isActive = ($contentItem->id === $lmsContent->id); @endphp
                                    <a href="{{ route('siswa.lms.content.show', $contentItem) }}"
                                       class="flex items-start gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ $isActive ? 'bg-green-50 border border-green-200 text-green-800 shadow-sm' : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                                        @if($contentItem->type == 'quiz')
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $isActive ? 'bg-purple-100 text-purple-600' : 'bg-gray-100 text-gray-400' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @elseif($contentItem->type == 'file')
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $isActive ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-400' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor">
                                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $isActive ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-400' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor">
                                                    <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <span class="truncate">{{ $contentItem->title }}</span>
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Konten Utama -->
                <div class="lg:col-span-3 animate-fade-in-up delay-100">
                    <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-green-200/50 flex flex-col min-h-[80vh] overflow-hidden">
                        <!-- Header Konten -->
                        <div class="p-6 md:p-7 border-b border-green-100 bg-white/60">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $lmsContent->title }}</h3>
                            @if($lmsContent->description)
                                <p class="mt-3 text-gray-700 leading-relaxed">
                                    {!! nl2br(e($lmsContent->description)) !!}
                                </p>
                            @endif
                        </div>

                        <!-- Body: Daftar File/Materi -->
                        <div class="p-6 md:p-7 flex-grow overflow-y-auto">
                            @php
                                $hasFiles = $lmsContent->files && $lmsContent->files->isNotEmpty();
                                $hasLinks = $lmsContent->links && $lmsContent->links->isNotEmpty();
                                $hasVideos = $lmsContent->videos && $lmsContent->videos->isNotEmpty();
                                $hasAny = $hasFiles || $hasLinks || $hasVideos;
                            @endphp

                            @if ($hasAny)
                                <div class="space-y-4">
                                    <!-- Files -->
                                    @if($hasFiles)
                                        @foreach($lmsContent->files as $file)
                                            <div class="flex items-start gap-4 p-4 bg-blue-50/60 rounded-xl border border-blue-200/50 hover:bg-blue-100/60 transition-colors">
                                                <div class="w-10 h-10 flex-shrink-0 rounded-lg bg-blue-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-grow min-w-0">
                                                    <p class="font-medium text-gray-900 truncate">{{ $file->original_name ?? 'File Materi' }}</p>
                                                    <p class="text-sm text-blue-700 mt-1">
                                                        {{ \Illuminate\Support\Str::limit($file->mime_type, 30) }} • 
                                                        {{ \Illuminate\Support\Str::of($file->size)->replaceMatches('/(\d+)(\d{3})$/', '$1.$2 KB') }}
                                                    </p>
                                                </div>
                                                <a href="{{ asset('storage/' . $file->path) }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center gap-1 text-sm font-semibold text-blue-700 hover:text-blue-900 group">
                                                    Buka
                                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

                                    <!-- Links -->
                                    @if($hasLinks)
                                        @foreach($lmsContent->links as $link)
                                            <div class="flex items-start gap-4 p-4 bg-purple-50/60 rounded-xl border border-purple-200/50 hover:bg-purple-100/60 transition-colors">
                                                <div class="w-10 h-10 flex-shrink-0 rounded-lg bg-purple-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.563-1.563m-3.086-3.086l1.563-1.563m0 0l1.563 1.563m-1.563-1.563l-4 4a4 4 0 005.656 5.656" />
                                                    </svg>
                                                </div>
                                                <div class="flex-grow min-w-0">
                                                    <p class="font-medium text-gray-900 truncate">{{ $link->title ?? 'Link Eksternal' }}</p>
                                                    <p class="text-sm text-purple-700 mt-1 truncate">{{ $link->url }}</p>
                                                </div>
                                                <a href="{{ $link->url }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center gap-1 text-sm font-semibold text-purple-700 hover:text-purple-900 group">
                                                    Buka
                                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

                                    <!-- Videos -->
                                    @if($hasVideos)
                                        @foreach($lmsContent->videos as $video)
                                            <div class="flex items-start gap-4 p-4 bg-red-50/60 rounded-xl border border-red-200/50 hover:bg-red-100/60 transition-colors">
                                                <div class="w-10 h-10 flex-shrink-0 rounded-lg bg-red-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="flex-grow min-w-0">
                                                    <p class="font-medium text-gray-900 truncate">{{ $video->title ?? 'Video Materi' }}</p>
                                                    <p class="text-sm text-red-700 mt-1">Video pembelajaran</p>
                                                </div>
                                                <button @click="imageUrl = '{{ $video->thumbnail_url }}'; isImageModalOpen = true"
                                                        class="inline-flex items-center gap-1 text-sm font-semibold text-red-700 hover:text-red-900 group">
                                                    Putar
                                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1.5a2.5 2.5 0 110 5H9V10z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <!-- Fallback ke mode lama jika tidak ada file/link -->
                                @if ($view_mode === 'start')
                                    @include('siswa.quiz.partials.start-content')
                                @elseif ($view_mode === 'take')
                                    @include('siswa.quiz.partials.take-content')
                                @elseif ($view_mode === 'result')
                                    @include('siswa.quiz.partials.result-content')
                                @elseif ($view_mode === 'embed' && isset($embedUrl))
                                    @include('siswa.lms.partials.content-embed')
                                @else
                                    <div class="flex items-center justify-center h-full text-center py-12 text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-green-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                            <p class="text-lg font-medium">Tidak ada materi tersedia</p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Navigasi Bawah -->
                        <div class="p-6 md:p-7 border-t border-green-100 bg-white/60">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                <div>
                                    @if ($previousContent)
                                        <a href="{{ route('siswa.lms.content.show', $previousContent) }}" 
                                           class="inline-flex items-center gap-2 px-5 py-2.5 text-green-600 font-medium rounded-xl border-2 border-green-200 hover:border-green-300 hover:bg-green-50 transition-all group">
                                            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                            </svg>
                                            Sebelumnya
                                        </a>
                                    @endif
                                </div>
                                <div>
                                    @if ($nextContent)
                                        <form method="POST" action="{{ route('siswa.lms.content.completeAndNext', $lmsContent) }}">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all group">
                                                Selesai & Lanjutkan
                                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('siswa.lms.content.complete', $lmsContent) }}" data-turbo="false">
                                            @csrf
                                            <button type="submit" 
                                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Tandai Selesai
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Gambar/Video -->
        <div x-show="isImageModalOpen" 
             x-cloak 
             @keydown.escape.window="isImageModalOpen = false"
             class="fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center p-4">
            <div @click.outside="isImageModalOpen = false" 
                 class="relative max-w-screen-xl max-h-[90vh]">
                <img :src="imageUrl" 
                     alt="Pratinjau" 
                     class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl border border-white/20">
                <button @click="isImageModalOpen = false" 
                        class="absolute -top-4 -right-4 bg-white text-gray-800 rounded-full p-2.5 shadow-xl hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .delay-100 {
            animation-delay: 0.1s;
        }
    </style>
</x-app-layout>