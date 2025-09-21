    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mengerjakan: {{ $quiz->title }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <form method="POST" action="{{ route('siswa.quiz.submit', $attempt) }}">
                    @csrf
                    <div class="space-y-6">
                        @foreach ($quiz->questions as $index => $question)
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <section>
                                    <header>
                                        <p class="font-semibold text-gray-800">Pertanyaan {{ $index + 1 }}</p>
                                        <p class="mt-2 text-lg text-gray-900">{{ $question->question_text }}</p>
                                    </header>

                                    @if ($question->image)
                                        <div class="mt-4">
                                            <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="max-w-full lg:max-w-md rounded-md border">
                                        </div>
                                    @endif

                                    <div class="mt-6 space-y-4">
                                        @foreach ($question->options as $option)
                                            <label for="option-{{ $option->id }}" class="flex items-center p-4 border rounded-md cursor-pointer hover:bg-gray-50 transition">
                                                <input type="radio" id="option-{{ $option->id }}" name="answers[{{ $question->id }}]" value="{{ $option->id }}" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                                                <span class="ms-3 text-sm text-gray-700">{{ $option->option_text }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </section>
                            </div>
                        @endforeach

                        <div class="flex items-center justify-end p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <x-primary-button class="text-base px-6 py-3">
                                {{ __('Kumpulkan Jawaban') }}
                            </x-primary-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>
