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
                            {{ $lmsMaterial->title }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Jelajahi semua konten materi ini</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8">
                    <!-- Header -->
                    <div class="border-b border-green-100 pb-6 mb-8">
                        <a href="{{ route('siswa.lms.index') }}" 
                           class="inline-flex items-center gap-1.5 text-green-600 hover:text-green-800 font-medium mb-4 group">
                            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Daftar Materi
                        </a>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $lmsMaterial->title }}</h3>
                        <p class="text-md text-gray-600 mt-2">Oleh: {{ $lmsMaterial->uploader->name ?? 'N/A' }}</p>
                        @if($lmsMaterial->description)
                            <p class="mt-4 text-gray-700 leading-relaxed">{{ $lmsMaterial->description }}</p>
                        @endif
                    </div>

                    <!-- Daftar Konten -->
                    <h4 class="text-xl font-bold text-gray-900 mb-5 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        Daftar Konten
                    </h4>

                    <div class="space-y-4">
                        @php $previousContentCompleted = true; @endphp
                        @forelse ($lmsMaterial->contents as $content)
                            @php
                                $isCompleted = in_array($content->id, $completedContentIds);
                                $isLocked = !$previousContentCompleted;
                            @endphp

                            <div class="group p-5 bg-white rounded-2xl border-2 transition-all duration-300 
                                {{ $isLocked 
                                    ? 'border-gray-200 bg-gray-100/50 opacity-80' 
                                    : 'border-green-200/50 hover:border-green-300 hover:shadow-md' }}">
                                
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <!-- Info Konten -->
                                    <div class="flex items-start gap-4 flex-1">
                                        <!-- Ikon Status -->
                                        <div class="flex-shrink-0 mt-0.5">
                                            @if($isCompleted)
                                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            @elseif($isLocked)
                                                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                </div>
                                            @elseif($content->type == 'quiz')
                                                <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Judul -->
                                        <div>
                                            <p class="font-semibold text-gray-900 {{ $isLocked ? 'text-gray-500' : '' }}">
                                                {{ $content->title }}
                                            </p>
                                            <div class="flex items-center gap-2 mt-1">
                                                @if($isLocked)
                                                    <span class="inline-flex items-center gap-1 text-xs text-gray-500">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                        </svg>
                                                        Terkunci
                                                    </span>
                                                @elseif($isCompleted)
                                                    <span class="inline-flex items-center gap-1 text-xs text-green-600 font-medium">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Selesai
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 text-xs text-blue-600 font-medium">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                        </svg>
                                                        Belum Dikerjakan
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    @if(!$isLocked)
                                        <div class="flex flex-wrap gap-2">
                                            @if($content->type == 'quiz' && $content->quiz)
                                                <a href="{{ route('siswa.lms.content.show', $content) }}" 
                                                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white text-sm font-medium rounded-xl shadow-sm hover:shadow transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                    </svg>
                                                    Kerjakan Kuis
                                                </a>
                                            @else
                                                <a href="{{ route('siswa.lms.content.show', $content) }}" 
                                                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-sm font-medium rounded-xl shadow-sm hover:shadow transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                                    </svg>
                                                    Buka
                                                </a>
                                            @endif

                                            @if(!$isCompleted && $content->type !== 'quiz')
                                                <form action="{{ route('siswa.lms.content.complete', $content) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" 
                                                            class="inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white text-sm font-medium rounded-xl shadow-sm hover:shadow transition-all">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Selesai
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @php $previousContentCompleted = $isCompleted; @endphp
                        @empty
                            <div class="text-center py-12 text-gray-500 animate-fade-in">
                                <div class="relative inline-block">
                                    <svg class="w-16 h-16 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <div class="absolute -top-1 -right-1 h-3 w-3 bg-green-400 rounded-full animate-ping"></div>
                                </div>
                                <p class="mt-4 font-medium text-lg">Belum ada konten untuk materi ini</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>