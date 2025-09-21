<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mulai Kuis: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center space-y-4">
                    <h1 class="text-2xl font-bold">{{ $quiz->title }}</h1>

                    @if($quiz->description)
                        <p class="text-gray-600 text-sm">{{ $quiz->description }}</p>
                    @endif

                    <div class="flex justify-around items-center p-4 bg-gray-50 rounded-md text-sm">
                        <div>
                            <span class="block text-xs text-gray-500 uppercase">Total Pertanyaan</span>
                            <span class="font-semibold text-lg">{{ $quiz->questions()->count() }} Soal</span>
                        </div>
                        <div>
                            <span class="block text-xs text-gray-500 uppercase">Materi Terkait</span>
                            <span class="font-semibold text-lg">{{ $quiz->lmsMaterial->title ?? 'Umum' }}</span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-500 pt-4">
                        Anda siap untuk memulai kuis ini? Pastikan Anda sudah mempelajari materi terkait.
                    </p>

                    <form method="POST" action="{{ route('siswa.quiz.processStart', $quiz) }}">
                        @csrf
                        <x-primary-button class="w-full justify-center py-3 text-base">
                            Mulai Pengerjaan Kuis
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
