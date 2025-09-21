<div class="space-y-6">
    {{-- Kartu Skor Akhir --}}
    <div class="p-6 text-center">
        <h3 class="text-lg font-medium text-gray-900">Skor Anda</h3>
        <p class="text-6xl font-bold text-blue-600 mt-2">{{ round($attempt->score) }}</p>
        <p class="text-gray-600 mt-2">Anda menjawab benar {{ $attempt->correct_answers }} dari {{ $attempt->total_questions }} pertanyaan.</p>
    </div>

    {{-- ▼▼▼ BLOK TOMBOL AKSI BARU ▼▼▼ --}}
    <div class="px-6 pb-6 text-center space-x-4">
        @if ($attempt->quiz->allow_multiple_attempts)
            <a href="{{ route('siswa.lms.content.show', ['lmsContent' => $lmsContent->id, 'action' => 'take']) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                Ulangi Kuis
            </a>
        @endif

        @if($nextContent)
            <a href="{{ route('siswa.lms.content.show', $nextContent->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                Lanjut ke Materi Berikutnya
            </a>
        @endif
    </div>

    {{-- Kartu Ulasan Jawaban (kondisional) --}}
    @if ($attempt->quiz->show_correct_answers)
        <div>
            <header class="border-t pt-6">
                <h2 class="text-lg font-medium text-gray-900">Ulasan Jawaban</h2>
                <p class="mt-1 text-sm text-gray-600">Periksa kembali jawaban Anda di bawah ini.</p>
            </header>
            <div class="mt-6 space-y-6">
                @foreach ($attempt->quiz->questions as $index => $question)
                    <div class="p-4 border rounded-md bg-gray-50 text-left">
                        <p class="font-semibold text-gray-900">{{ $index + 1 }}. {!! $question->question_text !!}</p>

                        @if ($question->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Soal" class="max-w-xs rounded-md border">
                            </div>
                        @endif

                        <div class="mt-4 space-y-2">
                            @php
                                $studentAnswer = $attempt->answers->firstWhere('quiz_question_id', $question->id);
                            @endphp
                            @foreach ($question->options as $option)
                                @php
                                    $isCorrectAnswer = $option->is_correct;
                                    $isSelectedByStudent = $studentAnswer && $studentAnswer->quiz_option_id == $option->id;

                                    $highlightClass = '';
                                    if ($isCorrectAnswer) {
                                        $highlightClass = 'border-green-500 bg-green-50 text-green-800'; // Jawaban benar
                                    } elseif ($isSelectedByStudent && !$isCorrectAnswer) {
                                        $highlightClass = 'border-red-500 bg-red-50 text-red-800'; // Jawaban siswa yang salah
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
                                    <span class="text-sm">{!! $option->option_text !!}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
