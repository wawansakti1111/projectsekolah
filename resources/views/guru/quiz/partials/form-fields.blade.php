{{-- resources/views/guru/quiz/partials/form-fields.blade.php --}}

{{-- ## BAGIAN 1: INFORMASI KUIS ## --}}
<div class="space-y-6">
    <div>
        <x-input-label for="title" value="Judul Kuis" />
        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $quiz->title ?? null)" required autofocus />
    </div>
    <div>
        <x-input-label for="description" value="Deskripsi (Opsional)" />
        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $quiz->description ?? null) }}</textarea>
    </div>
    <div>
        <x-input-label for="lms_material_id" value="Kaitkan dengan Materi LMS (Opsional)" />
        <select name="lms_material_id" id="lms_material_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
            <option value="">-- Tidak Dikaitkan --</option>
            @foreach ($materials as $material)
                <option value="{{ $material->id }}" @selected(old('lms_material_id', $preselectedMaterialId ?? ($quiz->lms_material_id ?? null)) == $material->id)>
                    {{ $material->title }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- ## BAGIAN 2: PENGATURAN KUIS ## --}}
<h3 class="text-lg font-medium text-gray-900 border-b pb-4 pt-6">Pengaturan Kuis</h3>
<div class="mt-6 space-y-6">
    {{-- ▼▼▼ INPUT STATUS YANG HILANG SEBELUMNYA ▼▼▼ --}}
    <div>
        <x-input-label for="status" value="Status Kuis" />
        <select name="status" id="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
            {{-- Default ke 'active' saat membuat baru, atau gunakan status yang ada saat mengedit --}}
            <option value="active" @selected(old('status', $quiz->status ?? 'active') == 'active')>Aktif (Tampilkan ke siswa)</option>
            <option value="draft" @selected(old('status', $quiz->status ?? 'active') == 'draft')>Draft (Disembunyikan dari siswa)</option>
        </select>
    </div>

    <div>
        <x-input-label for="duration" value="Batas Waktu Pengerjaan (menit)" />
        <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" :value="old('duration', $quiz->duration ?? null)" placeholder="Contoh: 30. Kosongkan jika tidak ada batas waktu."/>
    </div>
    <div class="space-y-3">
        <label for="allow_multiple_attempts" class="flex items-center">
            <input type="checkbox" id="allow_multiple_attempts" name="allow_multiple_attempts" value="1" @checked(old('allow_multiple_attempts', $quiz->allow_multiple_attempts ?? false)) class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <span class="ms-2 text-sm text-gray-600">Izinkan siswa mengerjakan lebih dari sekali.</span>
        </label>
        <label for="shuffle_questions" class="flex items-center">
            <input type="checkbox" id="shuffle_questions" name="shuffle_questions" value="1" @checked(old('shuffle_questions', $quiz->shuffle_questions ?? false)) class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <span class="ms-2 text-sm text-gray-600">Acak urutan pertanyaan untuk setiap siswa.</span>
        </label>
        <label for="show_correct_answers" class="flex items-center">
            <input type="checkbox" id="show_correct_answers" name="show_correct_answers" value="1" @checked(old('show_correct_answers', $quiz->show_correct_answers ?? true)) class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <span class="ms-2 text-sm text-gray-600">Tampilkan ulasan jawaban benar/salah setelah siswa selesai.</span>
        </label>
    </div>
</div>
