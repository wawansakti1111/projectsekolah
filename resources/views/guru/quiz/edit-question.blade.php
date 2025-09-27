## 1. File View (Tampilan Form)

Ini adalah file yang menampilkan form pengisian soal, di mana input untuk pilihan jawaban dan kunci jawaban ditambahkan.

* **File:** `resources/views/guru/quiz/edit-question.blade.php`

```php
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quiz') }}
        </h2>
        <x-slot name="breadcrumb">
            <h5 class="flex items-center space-x-2 text-gray-500 text-sm">
                <span>Quiz</span>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span>Bank Soal</span>
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span>{{ isset($question->id) ? 'Edit Soal' : 'Tambah Soal' }}</span>
            </h5>
        </x-slot>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-6">{{ isset($question->id) ? 'Edit Soal' : 'Tambah Soal Baru' }}</h3>

                    <form method="POST" action="{{ isset($question->id) ? route('guru.questions.update', $question->id) : route('guru.questions.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($question->id))
                            @method('PUT')
                        @endif

                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                        <div class="mb-4">
                            <x-input-label for="question" :value="__('Pertanyaan')" />
                            <textarea id="question" name="question" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('question', $question->question ?? '') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('question')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Foto (Optional)')" />
                            <input id="image" name="image" type="file" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" />
                            <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            @if(isset($question) && $question->image)
                                <p class="text-sm text-gray-500 mt-2">Gambar saat ini: <a href="{{ Storage::url($question->image) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Lihat Gambar</a></p>
                            @endif
                        </div>

                        {{-- START: BLOCK BARU UNTUK PILIHAN JAWABAN DAN KUNCI --}}
                        <div class="mt-6 p-4 sm:p-8 bg-gray-50 shadow sm:rounded-lg border border-gray-200">
                            <h4 class="text-lg font-semibold border-b pb-2 mb-4 text-gray-700">{{ __('Pilihan Jawaban (A, B, C, D) dan Kunci') }}</h4>

                            @php
                                // Mengambil data lama atau data dari relasi options jika ada
                                $options = old('options', $question->options ?? collect());
                                $labels = ['A', 'B', 'C', 'D'];
                                // Untuk mode edit, cari index jawaban yang benar
                                $correct_index_model = isset($question) ? $question->options->search(function($option) { return $option->is_correct == 1; }) : null;
                                $correct_option_index = old('correct_option_index', $correct_index_model);
                            @endphp

                            @foreach ($labels as $index => $label)
                                <div class="flex items-center space-x-4 mb-4 p-3 border rounded-lg bg-white">
                                    <div class="flex-grow">
                                        <x-input-label for="option_{{ $label }}" :value="__('Pilihan ' . $label)" />
                                        <x-text-input 
                                            id="option_{{ $label }}" 
                                            name="options[{{ $index }}][text]" 
                                            type="text" 
                                            class="mt-1 block w-full" 
                                            {{-- Menghandle data lama dari form validation atau data dari model untuk mode edit --}}
                                            :value="$options->get($index)['text'] ?? ($options->get($index)->option_text ?? '')" 
                                            required 
                                            placeholder="Masukkan teks untuk Pilihan {{ $label }}"
                                        />
                                        <x-input-error class="mt-2" :messages="$errors->get('options.' . $index . '.text')" />
                                    </div>

                                    <div class="flex-shrink-0 pt-6">
                                        <label for="is_correct_{{ $label }}" class="inline-flex items-center cursor-pointer">
                                            <input 
                                                id="is_correct_{{ $label }}" 
                                                name="correct_option_index" 
                                                type="radio" 
                                                class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500" 
                                                value="{{ $index }}" 
                                                {{-- Logika checked untuk mode edit atau old() --}}
                                                {{ $correct_option_index == $index ? 'checked' : '' }}
                                                required
                                            >
                                            <span class="ml-2 text-sm font-medium text-gray-700">{{ __('Kunci Jawaban') }}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            <x-input-error class="mt-2" :messages="$errors->get('correct_option_index')" />
                        </div>
                        {{-- END: BLOCK BARU UNTUK PILIHAN JAWABAN DAN KUNCI --}}

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('guru.quizzes.show', $quiz->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-3">
                                {{ __('Batal') }}
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Soal') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>