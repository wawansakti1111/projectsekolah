<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hasil Kuis: {{ $attempt->quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Kartu Skor Akhir --}}
            <div class="p-6 bg-white shadow sm:rounded-lg text-center">
                <h3 class="text-lg font-medium text-gray-900">Skor Anda</h3>
                <p class="text-6xl font-bold text-blue-600 mt-2">{{ $attempt->score }}</p>
                <p class="text-gray-600 mt-2">Anda menjawab benar {{ $attempt->correct_answers }} dari {{ $attempt->total_questions }} pertanyaan.</p>
                <a href="{{ route('siswa.quiz.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Kembali
                </a>
                @if ($attempt->quiz->allow_multiple_attempts)
                <form method="POST" action="{{ route('siswa.quiz.processStart', $attempt->quiz) }}">
                @csrf
                <x-primary-button type="submit">
                Kerjakan Ulang Kuis
                </x-primary-button>
                </form>
                @endif

            </div>

            {{-- ▼▼▼ KARTU ULASAN JAWABAN (DENGAN KONDISI) ▼▼▼ --}}
            @if ($attempt->quiz->show_correct_answers)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Ulasan Jawaban</h2>
                            <p class="mt-1 text-sm text-gray-600">Periksa kembali jawaban Anda di bawah ini.</p>
                        </header>

                        <div class="mt-6 space-y-6">
                            @foreach ($attempt->quiz->questions as $index => $question)
                                <div class="p-4 border rounded-md">
                                    <p class="font-semibold text-gray-900">{{ $index + 1 }}. {{ $question->question_text }}</p>
                                    @if ($question->image)
                                        <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="mt-2 max-w-xs rounded-md border">
                                    @endif

                                    <div class="mt-4 space-y-2">
                                        @php
                                            $studentAnswer = $attempt->answers->firstWhere('question_id', $question->id);
                                        @endphp

                                        @foreach ($question->options as $option)
                                            @php
                                                $isCorrectAnswer = $option->is_correct;
                                                $isSelectedByStudent = $studentAnswer && $studentAnswer->question_option_id == $option->id;

                                                $highlightClass = '';
                                                if ($isCorrectAnswer) {
                                                    $highlightClass = 'border-green-500 bg-green-50 text-green-800'; // Jawaban benar
                                                } elseif ($isSelectedByStudent && !$isCorrectAnswer) {
                                                    $highlightClass = 'border-red-500 bg-red-50 text-red-800'; // Jawaban siswa yang salah
                                                } else {
                                                    $highlightClass = 'border-gray-200'; // Opsi normal
                                                }
                                            @endphp

                                            <div class="flex items-center p-3 border rounded-md {{ $highlightClass }}">
                                                @if ($isCorrectAnswer)
                                                    <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                @elseif ($isSelectedByStudent)
                                                    <svg class="h-5 w-5 text-red-500 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                @else
                                                    <div class="w-5 h-5 mr-2 flex-shrink-0"></div>
                                                @endif
                                                <span class="text-sm">{{ $option->option_text }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            @endif
            {{-- ▲▲▲ AKHIR KARTU ULASAN JAWABAN ▲▲▲ --}}
        </div>
    </div>
</x-app-layout>
