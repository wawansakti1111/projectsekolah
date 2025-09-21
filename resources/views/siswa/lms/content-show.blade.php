<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight truncate">
            <a href="{{ route('siswa.lms.show', $lmsContent->material) }}" class="text-blue-600 hover:underline">{{ $lmsContent->material->title }}</a>
            <span class="text-gray-500 font-medium mx-2">/</span>
            <span class="text-gray-900">{{ $lmsContent->title }}</span>
        </h2>
    </x-slot>

    {{-- ▼▼▼ Inisialisasi Alpine.js untuk modal gambar ▼▼▼ --}}
    <div class="py-12" x-data="{ isImageModalOpen: false, imageUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                {{-- Kolom 1: Sidebar Navigasi Konten --}}
                <div class="lg:col-span-1">
                    <div class="bg-white p-4 shadow-sm sm:rounded-lg">
                        <a href="{{ route('siswa.lms.show', $lmsContent->material) }}" class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 mb-4">
                           <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                           Daftar Konten
                        </a>
                        <h3 class="font-semibold text-gray-900 mb-2 border-t pt-2">Navigasi</h3>
                        <nav class="space-y-1">
                            @foreach ($lmsContent->material->contents as $contentItem)
                                @php
                                    $isActive = ($contentItem->id === $lmsContent->id);
                                @endphp
                                <a href="{{ route('siswa.lms.content.show', $contentItem) }}"
                                   class="flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors {{ $isActive ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                                    @if($contentItem->type == 'quiz')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 flex-shrink-0 {{ $isActive ? 'text-purple-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @elseif($contentItem->type == 'file')
                                        <svg class="h-5 w-5 mr-3 flex-shrink-0 {{ $isActive ? 'text-blue-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    @else
                                        <svg class="h-5 w-5 mr-3 flex-shrink-0 {{ $isActive ? 'text-red-500' : 'text-gray-400' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    @endif
                                    <span class="truncate">{{ $contentItem->title }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                {{-- Kolom 2: Konten Utama --}}
                <div class="lg:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col min-h-[80vh]">
                        <div class="p-6 text-gray-900 border-b">
                            <h3 class="text-2xl font-bold">{{ $lmsContent->title }}</h3>
                            @if($lmsContent->description)
                                <p class="mt-2 text-sm text-gray-700">{!! nl2br(e($lmsContent->description)) !!}</p>
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            @if ($view_mode === 'start')
                                @include('siswa.quiz.partials.start-content')
                            @elseif ($view_mode === 'take')
                                @include('siswa.quiz.partials.take-content')
                            @elseif ($view_mode === 'result')
                                @include('siswa.quiz.partials.result-content')
                            @elseif ($view_mode === 'embed' && isset($embedUrl))
                                @include('siswa.lms.partials.content-embed')
                            @else
                                <div class="text-center py-12 text-gray-500">Konten tidak tersedia.</div>
                            @endif
                        </div>

                        {{-- Navigasi Next/Previous --}}
                        <div class="flex justify-between items-center p-6 border-t border-gray-200 mt-auto">
                            <div>
                                @if ($previousContent)
                                    <a href="{{ route('siswa.lms.content.show', $previousContent) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                        &larr; Sebelumnya
                                    </a>
                                @endif
                            </div>
                            <div>
                                @if ($nextContent)
                                    <form method="POST" action="{{ route('siswa.lms.content.completeAndNext', $lmsContent) }}">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                            Selesai & Lanjutkan &rarr;
                                        </button>
                                    </form>
                                @else
                                <form method="POST" action="{{ route('siswa.lms.content.complete', $lmsContent) }}" data-turbo="false">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
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


        {{-- Modal untuk Zoom Gambar --}}
        <div x-show="isImageModalOpen" x-cloak @keydown.escape.window="isImageModalOpen = false" class="fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4">
        <div @click.outside="isImageModalOpen = false" class="relative">
        <img :src="imageUrl" alt="Gambar Pertanyaan Diperbesar" class="max-w-screen-xl max-h-[85vh] object-contain rounded-lg">
        <button @click="isImageModalOpen = false" class="absolute -top-2 -right-2 bg-white text-gray-800 rounded-full p-1.5 shadow-lg hover:bg-gray-200">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        </div>
        </div>

    </div>
</x-app-layout>
