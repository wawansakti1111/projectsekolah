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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Proyek Saya') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola proyek yang Anda ikuti</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden"
         x-data="{ openModal: false, submission: {} }">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8">
                    <header class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Daftar Proyek Anda
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">Berikut adalah daftar proyek yang Anda daftarkan.</p>
                    </header>

                    <!-- Responsive Card List (instead of table) -->
                    <div class="space-y-5">
                        @forelse ($enrollments as $enrollment)
                            <div class="group p-5 bg-white rounded-2xl border border-green-100 hover:border-green-300 hover:shadow-md transition-all duration-300 animate-fade-in-up">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-gray-900 text-lg">{{ $enrollment->project->title }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">Oleh: {{ $enrollment->project->teacher->name ?? 'N/A' }}</p>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-3">
                                        <!-- Status Badge -->
                                        <span class="px-3 py-1.5 rounded-full text-xs font-medium whitespace-nowrap
                                            @if($enrollment->status == 'pending') bg-gray-100 text-gray-800 @endif
                                            @if($enrollment->status == 'approved') bg-green-100 text-green-800 @endif
                                            @if($enrollment->status == 'submitted') bg-emerald-100 text-emerald-800 @endif
                                            @if($enrollment->status == 'revision_needed') bg-amber-100 text-amber-800 @endif
                                            @if($enrollment->status == 'graded') bg-blue-100 text-blue-800 @endif
                                            @if($enrollment->status == 'rejected') bg-red-100 text-red-800 @endif
                                        ">
                                            {{ Str::of($enrollment->status)->replace('_', ' ')->title() }}
                                        </span>

                                        <!-- Action Button -->
                                        <div>
                                            @if ($enrollment->status == 'approved')
                                                <a href="{{ route('siswa.proyek.submit', $enrollment->id) }}" 
                                                   class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-medium text-white bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 rounded-lg shadow-sm hover:shadow transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Submit Proyek
                                                </a>
                                            @elseif ($enrollment->status == 'revision_needed')
                                                <a href="{{ route('siswa.proyek.submit', $enrollment->id) }}" 
                                                   class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-medium text-white bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 rounded-lg shadow-sm hover:shadow transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Unggah Revisi
                                                </a>
                                            @elseif ($enrollment->status == 'submitted' && $enrollment->submissions->first())
                                                <button type="button"
                                                        @click="openModal = true; submission = {{ json_encode($enrollment->submissions->first()) }}"
                                                        class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-medium text-white bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 rounded-lg shadow-sm hover:shadow transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Lihat Detail
                                                </button>
                                            @elseif ($enrollment->status == 'graded')
                                                <a href="#" 
                                                   class="inline-flex items-center gap-1.5 px-4 py-2 text-xs font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 rounded-lg shadow-sm hover:shadow transition-all">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Lihat Nilai
                                                </a>
                                            @else
                                                <span class="text-gray-500 px-4 py-2">-</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500 animate-fade-in">
                                <div class="relative inline-block">
                                    <svg class="w-16 h-16 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <div class="absolute -top-1 -right-1 h-3 w-3 bg-green-400 rounded-full animate-ping"></div>
                                </div>
                                <p class="mt-4 font-medium text-lg">Anda belum mendaftar ke proyek apa pun</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($enrollments->hasPages())
                        <div class="mt-8 flex justify-center">
                            <div class="inline-flex rounded-2xl shadow-lg p-1 bg-white/60 backdrop-blur border border-gray-200">
                                {{ $enrollments->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Detail Submission -->
        <div x-show="openModal" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div @click.outside="openModal = false" 
                 class="relative bg-white/90 backdrop-blur-sm rounded-2xl shadow-2xl w-full max-w-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-5">
                        <h3 class="text-xl font-bold text-gray-900">Detail Submission</h3>
                        <button @click="openModal = false" 
                                class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="space-y-4 text-sm">
                        <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                            <p class="text-xs text-green-600 font-medium mb-1">Tanggal Submit</p>
                            <p class="font-medium text-gray-900" 
                               x-text="new Date(submission.created_at).toLocaleString('id-ID', { 
                                   year: 'numeric', 
                                   month: 'long', 
                                   day: 'numeric',
                                   hour: '2-digit',
                                   minute: '2-digit'
                               })">
                            </p>
                        </div>

                        <template x-if="submission.final_submission_file">
                            <div class="p-4 bg-blue-50 rounded-xl border border-blue-100">
                                <p class="text-xs text-blue-600 font-medium mb-2">File Proyek</p>
                                <a :href="`/storage/${submission.final_submission_file}`" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-2 text-blue-700 hover:text-blue-900 font-medium group">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span x-text="submission.final_submission_file.split('/').pop()" class="underline group-hover:text-blue-900"></span>
                                </a>
                            </div>
                        </template>

                        <template x-if="submission.final_submission_link">
                            <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-100">
                                <p class="text-xs text-emerald-600 font-medium mb-2">Link Tambahan</p>
                                <a :href="submission.final_submission_link" 
                                   target="_blank" 
                                   class="inline-flex items-center gap-2 text-emerald-700 hover:text-emerald-900 font-medium group break-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    <span x-text="submission.final_submission_link" class="underline group-hover:text-emerald-900"></span>
                                </a>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fade In Animation -->
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        .animate-fade-in-up:nth-child(1) { animation-delay: 0.0s; }
        .animate-fade-in-up:nth-child(2) { animation-delay: 0.05s; }
        .animate-fade-in-up:nth-child(3) { animation-delay: 0.1s; }
        .animate-fade-in-up:nth-child(4) { animation-delay: 0.15s; }
        .animate-fade-in-up:nth-child(5) { animation-delay: 0.2s; }
        .animate-fade-in-up:nth-child(6) { animation-delay: 0.25s; }
    </style>
</x-app-layout>