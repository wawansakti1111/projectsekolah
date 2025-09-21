<div class="flex flex-col h-full" x-data="quizTimer({{ $remainingSeconds ?? 0 }})">
    {{-- Timer --}}
    <div x-show="durationInSeconds > 0" class="mb-4 p-4 rounded-lg shadow bg-red-50 border border-red-200">
        <div class="flex justify-center items-center space-x-3 text-red-700 font-bold">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Sisa Waktu: <span x-text="formatTime()"></span></span>
        </div>
    </div>

    <form id="quiz-form" method="POST" action="{{ route('siswa.quiz.submit', $attempt) }}" class="flex flex-col flex-grow min-h-0">
        @csrf

        {{-- Area Soal yang Bisa di-scroll --}}
        <div class="space-y-6 flex-grow overflow-y-auto pr-4 -mr-4">
            @forelse ($questions as $question)
                <div class="bg-gray-50 border border-gray-200 rounded-lg overflow-hidden">
                    <div class="px-6 py-4 bg-white border-b border-gray-200">
                        <p class="font-semibold text-gray-800">Soal #{{ $loop->iteration }}</p>
                    </div>
                    <div class="p-6">
                        @if($question->image)
                        <div class="mb-4">
                            {{-- Gambar dibuat lebih kecil dan bisa di-klik untuk zoom --}}
                            <a href="#" @click.prevent="isImageModalOpen = true; imageUrl = '{{ asset('storage/' . $question->image) }}'">
                            <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Soal {{ $loop->iteration }}" class="max-w-sm rounded-lg shadow-md border hover:opacity-80 transition cursor-zoom-in">
                            </a>
                            <p class="text-xs text-gray-500 mt-1">Klik gambar untuk memperbesar.</p>

                        </div>
                        @endif

                        <div class="prose max-w-none mb-4">{!! $question->question_text !!}</div>

                        <div class="space-y-3 mt-4">
                            @foreach($question->options as $option)
                                <label for="option-{{ $option->id }}" class="flex items-center p-3 border rounded-md hover:bg-indigo-50 cursor-pointer transition-colors">
                                    <input type="radio"
                                           name="answers[{{ $question->id }}]"
                                           id="option-{{ $option->id }}"
                                           value="{{ $option->id }}"
                                           class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                                           required>
                                    <span class="ml-3 text-gray-700">{{ $option->option_text }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-4 bg-yellow-100 border-l-4 border-yellow-400 text-yellow-700">
                    Kuis ini belum memiliki soal.
                </div>
            @endforelse
        </div>

        @if($questions->isNotEmpty())
            <div class="mt-8 text-center pt-6 border-t">
                <x-primary-button type="submit" class="text-lg px-8 py-4">
                    Kumpulkan Jawaban
                </x-primary-button>
            </div>
        @endif
    </form>
</div>

{{-- Script untuk timer --}}
@push('scripts')
<script>
    function quizTimer(initialSeconds) {
        return {
            durationInSeconds: initialSeconds,
            interval: null,
            init() {
                if (this.durationInSeconds > 0) {
                    this.interval = setInterval(() => {
                        this.durationInSeconds--;
                        if (this.durationInSeconds <= 0) {
                            clearInterval(this.interval);
                            document.getElementById('quiz-form').submit();
                        }
                    }, 1000);
                }
            },
            formatTime() {
                if (this.durationInSeconds <= 0) return "00:00";
                const minutes = Math.floor(this.durationInSeconds / 60);
                const seconds = this.durationInSeconds % 60;
                return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }
        }
    }
</script>
@endpush
