<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pertanyaan Kuis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                {{-- ▼▼▼ PERBAIKAN DI BARIS INI: 'option_text' diubah menjadi 'text' agar sesuai dengan x-model="option.text" ▼▼▼ --}}
                <section x-data="{
                    options: @js(old('options', $question->options->map(fn($opt) => ['text' => $opt->option_text, 'is_correct' => $opt->is_correct]))),
                    addOption() { this.options.push({ text: '', is_correct: false }); },
                    removeOption(index) { if (this.options.length > 2) { this.options.splice(index, 1); } },
                    setCorrect(selectedIndex) {
                        this.options.forEach((option, index) => {
                            option.is_correct = (index === selectedIndex);
                        });
                    }
                }">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Edit Pertanyaan</h2>
                    </header>

                    <form method="POST" action="{{ route('guru.quiz.questions.update', $question) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="question_text" value="Teks Pertanyaan" />
                            <textarea id="question_text" name="question_text" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>{{ old('question_text', $question->question_text) }}</textarea>
                        </div>

                        <div>
                            <x-input-label for="image" value="Gambar (Opsional)" />
                            <input type="file" id="image" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                            @if ($question->image)
                                <p class="mt-2 text-xs text-gray-500">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="max-w-xs rounded-md mt-1">
                            @endif
                        </div>

                        <div>
                            <x-input-label value="Pilihan Jawaban (Pilih satu jawaban benar)" />
                            <div class="mt-2 space-y-3">
                                <template x-for="(option, index) in options" :key="index">
                                    <div class="flex items-center gap-4">
                                        <input type="radio" name="correct_option_index" x-bind:value="index" @change="setCorrect(index)" x-bind:checked="option.is_correct" class="form-radio text-blue-600 focus:ring-blue-500">
                                        {{-- Input ini mengharapkan 'option.text' --}}
                                        <input type="text" x-bind:name="`options[${index}][option_text]`" x-model="option.text" class="block w-full border-gray-300 rounded-md shadow-sm" placeholder="Teks Jawaban" required>
                                        <input type="hidden" x-bind:name="`options[${index}][is_correct]`" x-bind:value="option.is_correct ? 1 : 0">
                                        <button type="button" @click="removeOption(index)" x-show="options.length > 2" class="text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
                                    </div>
                                </template>
                            </div>
                            <x-secondary-button type="button" @click="addOption" class="mt-3 text-xs">+ Tambah Pilihan</x-secondary-button>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('guru.quiz.show', $question->quiz_id) }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button class="ms-4">Simpan Perubahan</x-primary-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
