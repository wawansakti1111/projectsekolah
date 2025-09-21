{{-- Notifikasi --}}
@if (session('status'))
    <div class="p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-100" role="alert">{{ session('status') }}</div>
@endif
@if ($errors->any())
    <div class="p-4 mb-6 text-sm text-red-800 rounded-lg bg-red-100" role="alert"><ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

{{-- Layout 2 Kolom --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- KOLOM KIRI: MANAJEMEN PERTANYAAN --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Kartu untuk menambah pertanyaan baru --}}
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <section x-data="{
                options: [ { text: '', is_correct: true }, { text: '', is_correct: false } ],
                addOption() { this.options.push({ text: '', is_correct: false }); },
                removeOption(index) { if (this.options.length > 2) { this.options.splice(index, 1); } },
                setCorrect(selectedIndex) {
                    this.options.forEach((option, index) => {
                        option.is_correct = (index === selectedIndex);
                    });
                }
            }">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Tambah Pertanyaan Baru</h2>
                </header>

                <form method="POST" action="{{ route('guru.quiz.questions.store', $quiz) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="question_text" value="Teks Pertanyaan" />
                        <textarea id="question_text" name="question_text" rows="3" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>{{ old('question_text') }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="image" value="Gambar (Opsional)" />
                        <input type="file" id="image" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                    </div>

                    <div>
                        <x-input-label value="Pilihan Jawaban (Pilih satu jawaban benar)" />
                        <div class="mt-2 space-y-3">
                            <template x-for="(option, index) in options" :key="index">
                                <div class="flex items-center gap-4">
                                    <input type="radio" name="correct_option_index" x-bind:value="index" @change="setCorrect(index)" x-bind:checked="option.is_correct" class="form-radio text-blue-600 focus:ring-blue-500">
                                    <input type="text" x-bind:name="`options[${index}][option_text]`" x-model="option.text" class="block w-full border-gray-300 rounded-md shadow-sm" placeholder="Teks Jawaban" required>
                                    <input type="hidden" x-bind:name="`options[${index}][is_correct]`" x-bind:value="option.is_correct ? 1 : 0">
                                    <button type="button" @click="removeOption(index)" x-show="options.length > 2" class="text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
                                </div>
                            </template>
                        </div>
                        <x-secondary-button type="button" @click="addOption" class="mt-3 text-xs">+ Tambah Pilihan</x-secondary-button>
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button>Simpan Pertanyaan</x-primary-button>
                    </div>
                </form>
            </section>
        </div>

        {{-- Kartu untuk daftar pertanyaan --}}
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <section>
                <header class="flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Daftar Pertanyaan ({{ $quiz->questions->count() }})</h2>
                    </div>
                    {{-- Tombol ini hanya muncul jika tidak di dalam modal --}}
                    @if(request('view') !== 'modal')
                         <a href="{{ route('guru.quiz.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Kembali ke Daftar Kuis</a>
                    @endif
                </header>
                <div class="mt-6 space-y-4">
                    @forelse ($quiz->questions as $index => $question)
                        <div class="p-4 border rounded-md">
                            <div class="flex justify-between items-start">
                                <div class="flex-grow">
                                    <p class="font-semibold">{{ $index + 1 }}. {{ $question->question_text }}</p>
                                    @if ($question->image)
                                        <div class="mt-2"><img src="{{ asset('storage/' . $question->image) }}" alt="Gambar Pertanyaan" class="max-w-xs rounded-md"></div>
                                    @endif
                                    <ul class="mt-2 space-y-1 text-sm list-disc list-inside ml-4">
                                        @foreach ($question->options as $option)
                                            <li class="{{ $option->is_correct ? 'text-green-600 font-bold' : 'text-gray-700' }}">
                                                {{ $option->option_text }}
                                                @if ($option->is_correct)<span class="text-xs italic">(Jawaban Benar)</span>@endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="flex space-x-2 flex-shrink-0 ml-4">
                                    <a href="{{ route('guru.quiz.questions.edit', $question) }}" class="inline-block rounded-lg bg-gray-200 px-3 py-2 text-xs font-medium text-gray-700 transition hover:bg-gray-300">Edit</a>
                                    <form method="POST" action="{{ route('guru.quiz.questions.destroy', $question) }}" on="return confirm('Anda yakin ingin menghapus pertanyaan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="" class="inline-block rounded-lg bg-red-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-red-600">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-4 border rounded-md">Belum ada pertanyaan di kuis ini.</div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>

    {{-- KOLOM KANAN: PENGATURAN KUIS --}}
    <div class="lg:col-span-1">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Pengaturan Kuis</h2>
                    <p class="mt-1 text-sm text-gray-600">Ubah detail dan aturan untuk kuis ini.</p>
                </header>
                <form method="POST" action="{{ route('guru.quiz.update', $quiz) }}" class="mt-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        @include('guru.quiz.partials.create-form-fields')
                    </div>
                    <div class="flex items-center justify-end mt-6 pt-6 border-t">
                        <x-primary-button>
                            {{ __('Simpan Pengaturan') }}
                        </x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
