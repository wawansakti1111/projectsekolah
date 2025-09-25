<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            Manage Proyek: {{ $proyek->title }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola pendaftaran, submission, dan penilaian kelompok</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-6" x-data="{ isModalOpen: false, submission: {} }">

            @if (session('status'))
                <div class="p-4 bg-emerald-100 text-emerald-800 rounded-xl shadow-sm border border-emerald-200">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Tabel 1: Permintaan Pendaftaran Baru --}}
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8">
                    <header class="mb-6">
                        <h2 class="text-xl font-bold text-green-800">Permintaan Pendaftaran Baru</h2>
                        <p class="mt-1 text-green-600 text-sm">Daftar kelompok yang membutuhkan persetujuan Anda.</p>
                    </header>
                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <table class="min-w-full divide-y divide-green-100 text-sm">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Nama Kelompok</th>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Ketua</th>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Anggota</th>
                                    <th class="px-4 py-3 text-right font-semibold text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100">
                                @forelse ($enrollments->where('status', 'pending') as $enrollment)
                                    <tr class="hover:bg-green-50/50 transition-colors">
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $enrollment->group_name }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $enrollment->student->name }}</td>
                                        <td class="px-4 py-3 text-gray-700">
                                            {{ $enrollment->members->pluck('user.name')->implode(', ') ?: '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('guru.enrollment.approve', $enrollment) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white text-xs font-medium rounded-lg shadow transition-all duration-200 hover:scale-105">
                                                        Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('guru.enrollment.reject', $enrollment) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white text-xs font-medium rounded-lg shadow transition-all duration-200 hover:scale-105">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Tidak ada permintaan pendaftaran baru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tabel 2: Kelompok yang Disetujui --}}
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8">
                    <header class="mb-6">
                        <h2 class="text-xl font-bold text-green-800">Kelompok yang Disetujui</h2>
                        <p class="mt-1 text-green-600 text-sm">Daftar kelompok yang sudah terdaftar dalam proyek ini.</p>
                    </header>
                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <table class="min-w-full divide-y divide-green-100 text-sm">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Nama Kelompok</th>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Ketua & Anggota</th>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Status</th>
                                    <th class="px-4 py-3 text-right font-semibold text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100">
                                @forelse ($enrollments->whereNotIn('status', ['pending', 'rejected']) as $enrollment)
                                    <tr class="hover:bg-green-50/50 transition-colors">
                                        <td class="px-4 py-3 align-top font-medium text-gray-900">{{ $enrollment->group_name }}</td>
                                        <td class="px-4 py-3 align-top text-gray-700">
                                            <b>{{ $enrollment->student->name }} (Ketua)</b><br>
                                            <span class="text-xs text-gray-600">{{ $enrollment->members->pluck('user.name')->implode(', ') }}</span>
                                        </td>
                                        <td class="px-4 py-3 align-top">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($enrollment->status == 'approved') bg-blue-100 text-blue-800 @endif
                                                @if($enrollment->status == 'submitted') bg-emerald-100 text-emerald-800 @endif
                                                @if($enrollment->status == 'revision_needed') bg-amber-100 text-amber-800 @endif
                                                @if($enrollment->status == 'graded') bg-gray-200 text-gray-800 @endif
                                            ">
                                                {{ Str::of($enrollment->status)->replace('_', ' ')->title() }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 align-top text-right">
                                            <div class="flex flex-wrap justify-end gap-2">
                                                @if($enrollment->submissions->isNotEmpty())
                                                    <button type="button"
                                                        @click="isModalOpen = true; submission = {{ json_encode($enrollment->submissions->first()) }}"
                                                        class="px-3 py-1.5 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white text-xs font-medium rounded-lg shadow transition-all duration-200 hover:scale-105">
                                                        Lihat Submission
                                                    </button>
                                                @endif

                                                @if($enrollment->status == 'submitted')
                                                    <a href="{{ route('guru.proyek.grading.show', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}"
                                                       class="px-3 py-1.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white text-xs font-medium rounded-lg shadow transition-all duration-200 hover:scale-105">
                                                        Beri Nilai
                                                    </a>
                                                @elseif($enrollment->status == 'graded')
                                                    <a href="{{ route('guru.proyek.grading.result', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}"
                                                       class="px-3 py-1.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-xs font-medium rounded-lg shadow transition-all duration-200 hover:scale-105">
                                                        Lihat Nilai
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada kelompok yang disetujui.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tabel 3: Riwayat Pendaftar Ditolak (Opsional - bisa ditambahkan dengan gaya yang sama) --}}
            {{-- ... --}}

        </div>
    </div>

    {{-- Modal Submission --}}
    <div x-show="isModalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div @click.outside="isModalOpen = false" class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-bold text-green-800">Detail Submission</h3>
                    <button @click="isModalOpen = false" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-4 space-y-4 text-sm text-gray-700">
                    <p><strong class="text-green-700">Tanggal Submit:</strong> 
                        <span x-text="new Date(submission.created_at).toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' })"></span>
                    </p>

                    <div x-show="submission.final_submission_file">
                        <p class="font-medium text-green-700">File Proyek:</p>
                        <a :href="`/storage/${submission.final_submission_file}`" target="_blank"
                           class="text-emerald-600 hover:text-emerald-800 underline break-all">
                            <span x-text="submission.final_submission_file.split('/').pop()"></span>
                        </a>
                    </div>

                    <div x-show="submission.final_submission_link">
                        <p class="font-medium text-green-700">Link Tambahan:</p>
                        <a :href="submission.final_submission_link" target="_blank"
                           class="text-emerald-600 hover:text-emerald-800 underline break-all"
                           x-text="submission.final_submission_link">
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <button @click="isModalOpen = false"
                        class="px-4 py-2 bg-gradient-to-r from-gray-600 to-gray-700 text-white font-medium rounded-lg hover:from-gray-700 hover:to-gray-800 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>