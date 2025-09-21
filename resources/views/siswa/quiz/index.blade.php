{{-- resources/views/siswa/quiz/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Kuis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-4">
                @forelse ($quizzes as $quiz)
                    <div class="p-6 bg-white shadow-sm sm:rounded-lg flex justify-between items-center">
                        <div>
                            <h3 class="font-semibold text-lg text-gray-900">{{ $quiz->title }}</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Jumlah Soal: {{ $quiz->questions_count }} |
                                Materi Terkait: <span class="font-medium">{{ $quiz->lmsMaterial->title ?? 'Umum' }}</span>
                            </p>
                        </div>
                        <div>
                            <a href="{{ route('siswa.quiz.start', $quiz) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none">
                                Kerjakan Kuis
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 bg-white text-center text-gray-500 shadow-sm sm:rounded-lg">
                        Belum ada kuis yang tersedia saat ini.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $quizzes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
