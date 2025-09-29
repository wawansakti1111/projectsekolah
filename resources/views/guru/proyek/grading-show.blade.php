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
                            Detail Nilai Proyek: {{ $proyek->title }}
                        </h2>
                        <p class="text-green-100 text-base mt-1 font-medium">Lihat rincian penilaian proyek kelompok Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-8">

            <!-- Skor Akhir -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-6 text-center">
                <h3 class="text-sm font-semibold text-green-700 uppercase tracking-wider">Skor Akhir Proyek</h3>
                <p class="mt-2 text-5xl md:text-6xl font-extrabold text-green-800">{{ round($grade->score) }}</p>
            </div>

            <!-- Detail Kelompok & Navigasi -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Hasil Penilaian Kelompok: {{ $enrollment->group_name }}</h3>
                        <p class="mt-1 text-sm text-gray-600">Ketua: {{ $enrollment->student->name }}</p>
                    </div>
                    <a href="{{ route('guru.proyek.show', $proyek) }}" 
                       class="inline-flex items-center gap-1 text-sm font-medium text-green-600 hover:text-green-800 group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Detail Proyek
                    </a>
                </div>
            </div>

            <!-- Rubrik Proyek -->
            @if ($proyek->projectRubric)
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b pb-4 mb-4">
                        <h4 class="font-bold text-green-800 text-lg">Rincian Nilai Rubrik Proyek</h4>
                        @php
                            $projectSubtotal = 0;
                            foreach ($proyek->projectRubric->items as $item) {
                                $itemGrade = $itemGrades->where('gradable_type', 'App\Models\ProjectRubricItem')->firstWhere('gradable_id', $item->id);
                                if ($itemGrade) {
                                    $projectSubtotal += ($itemGrade->score * $item->weight) / 100;
                                }
                            }
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-sm font-bold rounded-full">
                            Total: {{ round($projectSubtotal) }}
                        </span>
                    </div>
                    <div class="space-y-4">
                        @foreach ($proyek->projectRubric->items as $item)
                            @php
                                $itemGrade = $itemGrades->where('gradable_type', 'App\Models\ProjectRubricItem')->firstWhere('gradable_id', $item->id);
                            @endphp
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">{{ $item->name }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Bobot: {{ $item->weight }}%</p>
                                </div>
                                <div class="text-center min-w-[60px]">
                                    <span class="block text-lg font-bold text-green-700">
                                        {{ $itemGrade ? $itemGrade->score : '–' }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Rubrik SDG -->
            @if ($proyek->sdgRubrics->isNotEmpty())
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-6">
                    <h4 class="font-bold text-green-800 text-lg mb-5">Rincian Nilai Rubrik SDG</h4>
                    <div class="space-y-5">
                        @foreach ($proyek->sdgRubrics as $sdgRubric)
                            @php
                                $sdgSubtotal = 0;
                                foreach ($sdgRubric->items as $item) {
                                    $itemGrade = $itemGrades->where('gradable_type', 'App\Models\SdgRubricItem')->firstWhere('gradable_id', $item->id);
                                    if ($itemGrade) {
                                        $sdgSubtotal += ($itemGrade->score * $item->weight) / 100;
                                    }
                                }
                            @endphp
                            <div class="border border-gray-200/60 rounded-xl p-4">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3">
                                    <h5 class="font-semibold text-gray-900">{{ $sdgRubric->sdg->name }}</h5>
                                    <span class="inline-flex items-center px-2.5 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full mt-1 sm:mt-0">
                                        {{ round($sdgSubtotal) }}
                                    </span>
                                </div>
                                <div class="space-y-3 mt-3 pt-3 border-t border-gray-100">
                                    @foreach ($sdgRubric->items as $item)
                                        @php
                                            $itemGrade = $itemGrades->where('gradable_type', 'App\Models\SdgRubricItem')->firstWhere('gradable_id', $item->id);
                                        @endphp
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-700">{{ $item->name }} ({{ $item->weight }}%)</span>
                                            <span class="font-bold text-gray-900 min-w-[32px] text-right">
                                                {{ $itemGrade ? $itemGrade->score : '–' }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Feedback Akhir -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-6">
                <h4 class="font-bold text-green-800 text-lg mb-3">Feedback / Catatan Akhir</h4>
                <div class="p-4 bg-gray-50 rounded-lg text-gray-800 prose max-w-none">
                    {!! nl2br(e($grade->feedback)) ?: '<span class="text-gray-500 italic">Tidak ada feedback yang diberikan.</span>' !!}
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