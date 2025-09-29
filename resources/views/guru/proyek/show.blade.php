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
                        <h2 class="font-extrabold text-3xl md:text-4xl text-white leading-tight tracking-tight">
                            Manage Proyek: {{ $proyek->title }}
                        </h2>
                        <p class="text-green-100 text-base mt-1 font-medium">Kelola pendaftaran, submission, dan penilaian kelompok</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-8" x-data="{ isModalOpen: false, submission: {} }">

            @if (session('status'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-xl font-medium animate-fadeIn">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Permintaan Pendaftaran Baru -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 overflow-hidden">
                <div class="p-6 md:p-7">
                    <header class="mb-5">
                        <h2 class="text-xl font-bold text-green-800">Permintaan Pendaftaran Baru</h2>
                        <p class="mt-1 text-sm text-green-600">Daftar kelompok yang menunggu persetujuan Anda.</p>
                    </header>
                    <div class="overflow-x-auto -mx-2 px-2">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs font-semibold text-green-800 uppercase tracking-wider">
                                <tr>
                                    <th class="py-3 px-4">Nama Kelompok</th>
                                    <th class="py-3 px-4">Ketua</th>
                                    <th class="py-3 px-4">Anggota</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($enrollments->where('status', 'pending') as $enrollment)
                                    <tr class="hover:bg-green-50/40 transition-colors">
                                        <td class="py-4 px-4 font-medium text-gray-900">{{ $enrollment->group_name }}</td>
                                        <td class="py-4 px-4 text-gray-700">{{ $enrollment->student->name }}</td>
                                        <td class="py-4 px-4 text-gray-700">
                                            {{ $enrollment->members->pluck('user.name')->implode(', ') ?: '-' }}
                                        </td>
                                        <td class="py-4 px-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('guru.enrollment.approve', $enrollment) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-3.5 py-1.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white text-xs font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                                                        Setujui
                                                    </button>
                                                </form>
                                                <form action="{{ route('guru.enrollment.reject', $enrollment) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="px-3.5 py-1.5 bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white text-xs font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                                                        Tolak
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 px-4 text-center text-gray-500 italic">Tidak ada permintaan pendaftaran baru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kelompok yang Disetujui -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 overflow-hidden">
                <div class="p-6 md:p-7">
                    <header class="mb-5">
                        <h2 class="text-xl font-bold text-green-800">Kelompok yang Disetujui</h2>
                        <p class="mt-1 text-sm text-green-600">Daftar kelompok aktif dalam proyek ini.</p>
                    </header>
                    <div class="overflow-x-auto -mx-2 px-2">
                        <table class="min-w-full text-sm">
                            <thead class="text-left text-xs font-semibold text-green-800 uppercase tracking-wider">
                                <tr>
                                    <th class="py-3 px-4">Nama Kelompok</th>
                                    <th class="py-3 px-4">Ketua & Anggota</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($enrollments->whereNotIn('status', ['pending', 'rejected']) as $enrollment)
                                    <tr class="hover:bg-green-50/40 transition-colors">
                                        <td class="py-4 px-4 align-top font-medium text-gray-900">{{ $enrollment->group_name }}</td>
                                        <td class="py-4 px-4 align-top text-gray-700">
                                            <div class="font-medium">{{ $enrollment->student->name }} <span class="text-green-700">(Ketua)</span></div>
                                            @if($enrollment->members->isNotEmpty())
                                                <div class="text-xs text-gray-600 mt-1">
                                                    {{ $enrollment->members->pluck('user.name')->implode(', ') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 align-top">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($enrollment->status == 'approved') bg-blue-100 text-blue-800 @endif
                                                @if($enrollment->status == 'submitted') bg-emerald-100 text-emerald-800 @endif
                                                @if($enrollment->status == 'revision_needed') bg-amber-100 text-amber-800 @endif
                                                @if($enrollment->status == 'graded') bg-gray-200 text-gray-800 @endif
                                            ">
                                                {{ Str::of($enrollment->status)->replace('_', ' ')->title() }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-4 align-top text-right">
                                            <div class="flex flex-wrap justify-end gap-2">
                                                @if($enrollment->submissions->isNotEmpty())
                                                    <button type="button"
                                                        @click="isModalOpen = true; submission = {{ json_encode($enrollment->submissions->first()) }}"
                                                        class="px-3.5 py-1.5 bg-gray-700 hover:bg-gray-800 text-white text-xs font-medium rounded-lg shadow-sm hover:shadow transition">
                                                        Lihat Submission
                                                    </button>
                                                @endif

                                                @if($enrollment->status == 'submitted')
                                                    <a href="{{ route('guru.proyek.grading.show', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}"
                                                       class="px-3.5 py-1.5 bg-gradient-to-r from-emerald-600 to-green-600 hover:from-emerald-700 hover:to-green-700 text-white text-xs font-medium rounded-lg shadow-sm hover:shadow transition">
                                                        Beri Nilai
                                                    </a>
                                                @elseif($enrollment->status == 'graded')
                                                    <a href="{{ route('guru.proyek.grading.result', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}"
                                                       class="px-3.5 py-1.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-xs font-medium rounded-lg shadow-sm hover:shadow transition">
                                                        Lihat Nilai
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-6 px-4 text-center text-gray-500 italic">Belum ada kelompok yang disetujui.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal Submission -->
    <div x-show="isModalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-4">
        <div @click.outside="isModalOpen = false" class="bg-white rounded-2xl shadow-xl w-full max-w-lg">
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h3 class="text-xl font-bold text-green-800">Detail Submission</h3>
                    <button @click="isModalOpen = false" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-5 space-y-4 text-sm text-gray-700">
                    <p>
                        <span class="font-medium text-green-700">Tanggal Submit:</span><br>
                        <span x-text="new Date(submission.created_at).toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' })"></span>
                    </p>

                    <template x-if="submission.final_submission_file">
                        <div>
                            <p class="font-medium text-green-700 mb-1">File Proyek:</p>
                            <a :href="`/storage/${submission.final_submission_file}`" target="_blank"
                               class="text-emerald-600 hover:text-emerald-800 underline break-all block">
                                <span x-text="submission.final_submission_file.split('/').pop()"></span>
                            </a>
                        </div>
                    </template>

                    <template x-if="submission.final_submission_link">
                        <div>
                            <p class="font-medium text-green-700 mb-1">Link Tambahan:</p>
                            <a :href="submission.final_submission_link" target="_blank"
                               class="text-emerald-600 hover:text-emerald-800 underline break-all block"
                               x-text="submission.final_submission_link">
                            </a>
                        </div>
                    </template>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-4 flex justify-end">
                <button @click="isModalOpen = false"
                        class="px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white font-medium rounded-lg transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- CUSTOM STYLES -->
    <style>
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-pulse-slow { animation: pulseSlow 1.8s infinite; }
        .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
        [x-cloak] { display: none !important; }

        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</x-app-layout>