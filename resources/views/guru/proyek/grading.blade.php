<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-3xl text-white leading-tight tracking-tight">
                            Penilaian Proyek: {{ $proyek->title }}
                        </h2>
                        <p class="text-green-100 text-base mt-1 font-medium">Nilai submission kelompok dan berikan feedback</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- Kolom Kiri: Info & Submission -->
                <div class="md:col-span-1 space-y-6">
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-6">
                        <h3 class="text-lg font-bold text-green-800">Detail Submission</h3>
                        <div class="mt-4 space-y-3 text-sm text-gray-700">
                            <p><span class="font-medium text-gray-900">Kelompok:</span> {{ $enrollment->group_name }}</p>
                            <p><span class="font-medium text-gray-900">Ketua:</span> {{ $enrollment->student->name }}</p>
                            <p>
                                <span class="font-medium text-gray-900">Anggota:</span>
                                {{ $enrollment->members->pluck('user.name')->implode(', ') ?: '-' }}
                            </p>
                            @if($submission = $enrollment->submissions->first())
                                <p class="pt-3 border-t border-gray-100">
                                    <span class="font-medium text-gray-900">Dikumpulkan:</span>
                                    {{ $submission->created_at->format('d M Y, H:i') }}
                                </p>
                            @endif
                        </div>

                        @if($submission)
                            <div class="mt-5 pt-4 border-t border-gray-100">
                                <h4 class="font-medium text-gray-800 mb-2">File/Link Submission:</h4>
                                @if($submission->final_submission_file)
                                    <a href="{{ asset('storage/' . $submission->final_submission_file) }}" target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-lg shadow hover:shadow-md transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Unduh File
                                    </a>
                                @elseif($submission->final_submission_link)
                                    <a href="{{ $submission->final_submission_link }}" target="_blank"
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold rounded-lg shadow hover:shadow-md transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.563-1.563m-3.086-3.086l1.563-1.563m0 0l1.563 1.563m-1.563-1.563l-4 4a4 4 0 005.656 5.656" />
                                        </svg>
                                        Buka Link
                                    </a>
                                @endif
                            </div>
                        @endif

                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <form action="{{ route('guru.proyek.grading.requestRevision', $enrollment) }}" method="POST"
                                  onsubmit="return confirm('Anda yakin ingin meminta revisi? Submission saat ini akan dihapus.');">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-lg shadow hover:shadow-md transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Minta Revisi
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Form Penilaian -->
                <div class="md:col-span-2">
                    <form method="POST" action="{{ route('guru.proyek.grading.store', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}"
                          class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-6">
                        @csrf
                        <h3 class="text-lg font-bold text-green-800">Formulir Penilaian</h3>

                        <!-- Rubrik Proyek -->
                        @if($proyek->projectRubric)
                            <div class="mt-6">
                                <h4 class="font-bold text-gray-900 text-base border-b border-green-200/50 pb-3">Rubrik Proyek</h4>
                                <div class="mt-4 space-y-4">
                                    @foreach ($proyek->projectRubric->items as $item)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <label class="font-medium text-gray-800">
                                                {{ $item->name }} <span class="text-xs text-gray-500">(Bobot: {{ $item->weight }}%)</span>
                                            </label>
                                            <div class="w-24">
                                                <input type="number"
                                                       name="grades[project_{{ $item->id }}][score]"
                                                       min="0" max="100"
                                                       required
                                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-center focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                                <input type="hidden" name="grades[project_{{ $item->id }}][gradable_type]" value="App\Models\ProjectRubricItem">
                                                <input type="hidden" name="grades[project_{{ $item->id }}][gradable_id]" value="{{ $item->id }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Rubrik SDG -->
                        @if($proyek->sdgRubrics->isNotEmpty())
                            <div class="mt-8">
                                <h4 class="font-bold text-gray-900 text-base border-b border-green-200/50 pb-3">Rubrik SDG</h4>
                                <div class="mt-4 space-y-5">
                                    @foreach ($proyek->sdgRubrics as $sdgRubric)
                                        <div class="border border-gray-200/60 rounded-xl p-4">
                                            <h5 class="font-semibold text-green-800 mb-3">{{ $sdgRubric->sdg->name }}</h5>
                                            <div class="space-y-4">
                                                @foreach ($sdgRubric->items as $item)
                                                    <div class="flex items-center justify-between">
                                                        <label class="text-sm text-gray-700">
                                                            {{ $item->name }} <span class="text-xs text-gray-500">(Bobot: {{ $item->weight }}%)</span>
                                                        </label>
                                                        <div class="w-20">
                                                            <input type="number"
                                                                   name="grades[sdg_{{ $item->id }}][score]"
                                                                   min="0" max="100"
                                                                   required
                                                                   class="w-full px-2.5 py-1.5 border border-gray-300 rounded text-center text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
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
                        @endif

                        <!-- Feedback Akhir -->
                        <div class="mt-6">
                            <label for="final_feedback" class="block font-medium text-sm text-gray-800 mb-2">Feedback / Catatan Akhir</label>
                            <textarea name="final_feedback"
                                      id="final_feedback"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500"></textarea>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                            <a href="{{ route('guru.proyek.show', $proyek) }}"
                               class="text-sm font-medium text-gray-600 hover:text-gray-800">
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Simpan Nilai
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
    @endpush
</x-app-layout>