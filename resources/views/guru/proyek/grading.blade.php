<x-app-layout>
    <x-slot name="header">
        {{-- DIUBAH: $project -> $proyek --}}
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Penilaian Proyek: {{ $proyek->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Kolom Kiri: Info & Submission --}}
            <div class="md:col-span-1 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">Detail Submission</h3>
                    <div class="mt-4 space-y-2 text-sm">
                        <p><strong>Kelompok:</strong> {{ $enrollment->group_name }}</p>
                        <p><strong>Ketua:</strong> {{ $enrollment->student->name }}</p>
                        <p><strong>Anggota:</strong>
                            {{ $enrollment->members->pluck('user.name')->implode(', ') ?: '-' }}
                        </p>
                        <p class="border-t pt-2 mt-2"><strong>Dikumpulkan pada:</strong> {{ $enrollment->submissions->first()->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    @if($submission = $enrollment->submissions->first())
                    <div class="mt-6">
                        <h4 class="font-medium text-gray-800">File/Link Submission:</h4>
                        @if($submission->final_submission_file)
                            <a href="{{ asset('storage/' . $submission->final_submission_file) }}" target="_blank" class="mt-2 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-md hover:bg-blue-700">
                                Unduh File Submission
                            </a>
                        @elseif($submission->final_submission_link)
                            <a href="{{ $submission->final_submission_link }}" target="_blank" class="mt-2 inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded-md hover:bg-blue-700">
                                Buka Link Submission
                            </a>
                        @endif
                    </div>
                    @endif

                    <div class="mt-6 border-t pt-4">
                         <form action="{{ route('guru.proyek.grading.requestRevision', $enrollment) }}" method="POST" onsubmit="return confirm('Anda yakin ingin meminta revisi? Submission saat ini akan dihapus.');">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full text-center px-4 py-2 bg-amber-500 text-white text-sm font-medium rounded-md hover:bg-amber-600">
                                Minta Revisi
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            {{-- Kolom Kanan: Form Penilaian --}}
            <div class="md:col-span-2">
                {{-- DIUBAH: $project -> $proyek --}}
                <form method="POST" action="{{ route('guru.proyek.grading.store', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    @csrf
                    <h3 class="text-lg font-medium text-gray-900">Formulir Penilaian</h3>

                    {{-- Bagian Rubrik Proyek --}}
                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-800 border-b pb-2">Rubrik Proyek</h4>
                        <div class="mt-4 space-y-4">
                            {{-- DIUBAH: $project -> $proyek --}}
                            @foreach ($proyek->projectRubric->items as $item)
                                <div class="grid grid-cols-4 gap-4 items-center">
                                    <label class="col-span-3 text-sm text-gray-700">{{ $item->name }} (Bobot: {{ $item->weight }}%)</label>
                                    <div class="col-span-1">
                                        <input type="number" name="grades[project_{{ $item->id }}][score]" min="0" max="100" class="block w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                                        <input type="hidden" name="grades[project_{{ $item->id }}][gradable_type]" value="App\Models\ProjectRubricItem">
                                        <input type="hidden" name="grades[project_{{ $item->id }}][gradable_id]" value="{{ $item->id }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bagian Rubrik SDG --}}
                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-800 border-b pb-2">Rubrik SDG</h4>
                        <div class="mt-4 space-y-6">
                             {{-- DIUBAH: $project -> $proyek --}}
                             @foreach ($proyek->sdgRubrics as $sdgRubric)
                                <div class="p-4 bg-gray-50 rounded-md">
                                    <p class="font-semibold text-sm text-gray-800">{{ $sdgRubric->sdg->name }}</p>
                                    <div class="mt-3 space-y-4">
                                        @foreach ($sdgRubric->items as $item)
                                        <div class="grid grid-cols-4 gap-4 items-center">
                                            <label class="col-span-3 text-sm text-gray-700">{{ $item->name }} (Bobot: {{ $item->weight }}%)</label>
                                            <div class="col-span-1">
                                                <input type="number" name="grades[sdg_{{ $item->id }}][score]" min="0" max="100" class="block w-full border-gray-300 rounded-md shadow-sm text-sm" required>
                                                <input type="hidden" name="grades[sdg_{{ $item->id }}][gradable_type]" value="App\Models\SdgRubricItem">
                                                <input type="hidden" name="grades[sdg_{{ $item->id }}][gradable_id]" value="{{ $item->id }}">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                             @endforeach
                        </div>
                    </div>

                    {{-- Feedback Akhir --}}
                    <div class="mt-6">
                        <label for="final_feedback" class="block font-medium text-sm text-gray-700">Feedback / Catatan Akhir</label>
                        <textarea name="final_feedback" id="final_feedback" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                         {{-- DIUBAH: $project -> $proyek --}}
                        <a href="{{ route('guru.proyek.show', $proyek) }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button class="ms-4">
                            Simpan Nilai
                        </x-primary-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
