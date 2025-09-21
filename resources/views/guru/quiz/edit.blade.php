<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Informasi Kuis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('guru.quiz.update', $quiz) }}" class="p-6">
                    @csrf
                    @method('PUT')
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-4">Informasi Kuis</h3>
                    <div class="mt-6 space-y-6">
                        {{-- Judul dan Deskripsi --}}
                        <div>
                            <x-input-label for="title" value="Judul Kuis" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $quiz->title)" required />
                        </div>
                        <div>
                            <x-input-label for="description" value="Deskripsi (Opsional)" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $quiz->description) }}</textarea>
                        </div>
                        <div>
                            <x-input-label for="lms_material_id" value="Kaitkan dengan Materi LMS (Opsional)" />
                            <select name="lms_material_id" id="lms_material_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">-- Tidak Dikaitkan --</option>
                                @foreach ($materials as $material)
                                    <option value="{{ $material->id }}" @selected(old('lms_material_id', $quiz->lms_material_id) == $material->id)>{{ $material->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Pengaturan Kuis --}}
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-4 mt-10">Pengaturan Kuis</h3>
                    <div class="mt-6 space-y-6">
                        <div>
                            <x-input-label for="status" value="Status Kuis" />
                            <select name="status" id="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="draft" @selected($quiz->status == 'draft')>Draft (Disembunyikan dari siswa)</option>
                                <option value="active" @selected($quiz->status == 'active')>Aktif (Tampilkan ke siswa)</option>
                            </select>
                        </div>
                        <div>
                            <x-input-label for="duration" value="Batas Waktu Pengerjaan (menit)" />
                            <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" :value="old('duration', $quiz->duration)" placeholder="Contoh: 30. Kosongkan jika tidak ada batas waktu."/>
                        </div>
                        <div class="space-y-3">
                            <label for="allow_multiple_attempts" class="flex items-center">
                                <input type="checkbox" id="allow_multiple_attempts" name="allow_multiple_attempts" value="1" @checked($quiz->allow_multiple_attempts) class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ms-2 text-sm text-gray-600">Izinkan siswa mengerjakan lebih dari sekali.</span>
                            </label>
                            <label for="shuffle_questions" class="flex items-center">
                                <input type="checkbox" id="shuffle_questions" name="shuffle_questions" value="1" @checked($quiz->shuffle_questions) class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ms-2 text-sm text-gray-600">Acak urutan pertanyaan untuk setiap siswa.</span>
                            </label>
                            <label for="show_correct_answers" class="flex items-center">
                                <input type="checkbox" id="show_correct_answers" name="show_correct_answers" value="1" @checked($quiz->show_correct_answers) class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ms-2 text-sm text-gray-600">Tampilkan ulasan jawaban benar/salah setelah siswa selesai.</span>
                            </label>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-end mt-10 border-t pt-6">
                        {{-- ▼▼▼ PERUBAHAN DI SINI ▼▼▼ --}}
                        <a href="{{ route('guru.quiz.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                        <x-primary-button class="ms-4">
                            {{ __('Simpan Pengaturan Kuis') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
