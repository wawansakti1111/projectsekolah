<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Nilai Proyek: {{ $proyek->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-6 bg-white shadow sm:rounded-lg text-center">
                <h3 class="text-base font-medium text-gray-500 uppercase tracking-wider">Skor Akhir Proyek</h3>
                <p class="mt-1 text-6xl font-bold text-blue-600">{{ round($grade->score) }}</p>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Hasil Penilaian Kelompok: {{ $enrollment->group_name }}</h3>
                        <p class="mt-1 text-sm text-gray-600">Ketua: {{ $enrollment->student->name }}</p>
                    </div>
                    <a href="{{ route('guru.proyek.show', $proyek) }}" class="text-sm text-blue-600 hover:underline">Kembali ke Detail Proyek</a>
                </div>

                {{-- Bagian Rubrik Proyek --}}
                <div class="mt-6">
                    <div class="flex justify-between items-center border-b pb-2">
                        <h4 class="font-semibold text-gray-800">Rincian Nilai Rubrik Proyek</h4>
                        {{-- ▼▼▼ TOTAL NILAI RUBRIK PROYEK ▼▼▼ --}}
                        @php
                            $projectSubtotal = 0;
                            if ($proyek->projectRubric) {
                                foreach ($proyek->projectRubric->items as $item) {
                                    $itemGrade = $itemGrades->where('gradable_type', 'App\Models\ProjectRubricItem')->firstWhere('gradable_id', $item->id);
                                    if ($itemGrade) {
                                        $projectSubtotal += ($itemGrade->score * $item->weight) / 100;
                                    }
                                }
                            }
                        @endphp
                        <h4 class="font-semibold text-gray-800">Total: {{ round($projectSubtotal) }}</h4>
                    </div>
                    <div class="mt-4 space-y-3">
                        @if ($proyek->projectRubric)
                            @foreach ($proyek->projectRubric->items as $item)
                                <div class="grid grid-cols-5 gap-4 items-center">
                                    <p class="col-span-4 text-sm text-gray-700">{{ $item->name }} (Bobot: {{ $item->weight }}%)</p>
                                    <div class="col-span-1">
                                        @php
                                            $itemGrade = $itemGrades->where('gradable_type', 'App\Models\ProjectRubricItem')->firstWhere('gradable_id', $item->id);
                                        @endphp
                                        <p class="text-center font-bold text-lg text-gray-800 p-2 bg-gray-100 rounded-md">
                                            {{ $itemGrade ? $itemGrade->score : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Bagian Rubrik SDG --}}
                <div class="mt-6">
                    <h4 class="font-semibold text-gray-800 border-b pb-2">Rincian Nilai Rubrik SDG</h4>
                    <div class="mt-4 space-y-6">
                         @foreach ($proyek->sdgRubrics as $sdgRubric)
                            <div class="p-4 bg-gray-50 rounded-md">
                                {{-- ▼▼▼ TOTAL NILAI PER SDG ▼▼▼ --}}
                                @php
                                    $sdgSubtotal = 0;
                                    foreach ($sdgRubric->items as $item) {
                                        $itemGrade = $itemGrades->where('gradable_type', 'App\Models\SdgRubricItem')->firstWhere('gradable_id', $item->id);
                                        if ($itemGrade) {
                                            $sdgSubtotal += ($itemGrade->score * $item->weight) / 100;
                                        }
                                    }
                                @endphp
                                <div class="flex justify-between items-center border-b border-gray-300 pb-2 mb-3">
                                    <p class="font-semibold text-sm text-gray-800">{{ $sdgRubric->sdg->name }}</p>
                                    <p class="font-semibold text-sm text-gray-800">Total: {{ round($sdgSubtotal) }}</p>
                                </div>
                                <div class="space-y-3">
                                    @foreach ($sdgRubric->items as $item)
                                    <div class="grid grid-cols-5 gap-4 items-center">
                                        <p class="col-span-4 text-sm text-gray-700">{{ $item->name }} (Bobot: {{ $item->weight }}%)</p>
                                        <div class="col-span-1">
                                            @php
                                                $itemGrade = $itemGrades->where('gradable_type', 'App\Models\SdgRubricItem')->firstWhere('gradable_id', $item->id);
                                            @endphp
                                            <p class="text-center font-bold text-lg text-gray-800 p-2 bg-gray-100 rounded-md">
                                                {{ $itemGrade ? $itemGrade->score : 'N/A' }}
                                            </p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                         @endforeach
                    </div>
                </div>

                {{-- Feedback Akhir --}}
                <div class="mt-6 border-t pt-4">
                    <h4 class="block font-medium text-sm text-gray-700">Feedback / Catatan Akhir</h4>
                    <div class="mt-2 p-4 bg-gray-50 rounded-md text-sm text-gray-800">
                        {!! nl2br(e($grade->feedback)) ?: '<i class="text-gray-500">Tidak ada feedback yang diberikan.</i>' !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
