<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $lmsMaterial->title }}
        </h2>
    </x-slot>

    {{-- Hapus x-data untuk modal dari sini --}}
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border-b pb-4 mb-6">
                        <a href="{{ route('siswa.lms.index') }}" class="text-sm text-blue-600 hover:underline mb-4 inline-block">&larr; Kembali ke Daftar Materi</a>
                        <h3 class="text-2xl font-bold">{{ $lmsMaterial->title }}</h3>
                        <p class="text-md text-gray-600 mt-1">Oleh: {{ $lmsMaterial->uploader->name ?? 'N/A' }}</p>
                        @if($lmsMaterial->description)
                            <p class="mt-4 text-sm text-gray-800">{{ $lmsMaterial->description }}</p>
                        @endif
                    </div>

                    <h4 class="text-lg font-semibold text-gray-900 mb-4">Daftar Konten</h4>
                    <div class="space-y-3">
                        @php $previousContentCompleted = true; @endphp
                        @forelse ($lmsMaterial->contents as $content)
                            @php
                                $isCompleted = in_array($content->id, $completedContentIds);
                                $isLocked = !$previousContentCompleted;
                            @endphp

                            <div class="flex items-center justify-between p-4 border rounded-md {{ $isLocked ? 'bg-gray-200 opacity-60' : 'bg-white' }}">
                                <div class="flex items-center">
                                    {{-- Ikon --}}
                                    @if($isCompleted)
                                        <svg class="h-6 w-6 text-green-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @elseif($isLocked)
                                        <svg class="h-6 w-6 text-gray-400 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    @elseif($content->type == 'quiz')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    @else
                                        <svg class="h-6 w-6 text-blue-500 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    @endif

                                    <div>
                                        <p class="font-medium {{ $isLocked ? 'text-gray-500' : 'text-gray-800' }}">{{ $content->title }}</p>
                                    </div>
                                </div>

                                {{-- Tombol Aksi --}}
                                @if(!$isLocked)
                                    <div class="flex items-center gap-2">
                                        {{-- ▼▼▼ PERUBAHAN DI SINI ▼▼▼ --}}
                                        @if($content->type == 'quiz' && $content->quiz)
                                            <a href="{{ route('siswa.lms.content.show', $content) }}" class="inline-block rounded-lg bg-blue-600 px-3 py-2 text-xs font-medium text-white transition hover:bg-blue-700">
                                                Kerjakan Kuis
                                            </a>
                                        @else
                                            <a href="{{ route('siswa.lms.content.show', $content) }}" class="inline-block rounded-lg bg-gray-200 px-3 py-2 text-xs font-medium text-gray-700 transition hover:bg-gray-300">
                                                Buka
                                            </a>
                                        @endif
                                        {{-- ▲▲▲ AKHIR PERUBAHAN ▲▲▲ --}}

                                        @if(!$isCompleted && $content->type !== 'quiz')
                                            <form action="{{ route('siswa.lms.content.complete', $content) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="inline-block rounded-lg bg-green-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-green-600">
                                                    Selesai
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            @php $previousContentCompleted = $isCompleted; @endphp
                        @empty
                            <div class="text-center text-gray-500 p-4">Belum ada konten untuk materi ini.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- Hapus seluruh blok modal dari sini --}}
    </div>
</x-app-layout>
