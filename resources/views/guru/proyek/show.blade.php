{{-- ▼▼▼ 1. Tambahkan x-data untuk mengontrol modal ▼▼▼ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Proyek: {{ $proyek->title }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ isModalOpen: false, submission: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="p-4 bg-emerald-100 text-emerald-700 shadow sm:rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Tabel 1: Permintaan Pendaftaran Baru --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Permintaan Pendaftaran Baru</h2>
                        <p class="mt-1 text-sm text-gray-600">Daftar kelompok yang membutuhkan persetujuan Anda.</p>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-left text-gray-900">Nama Kelompok</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-left text-gray-900">Ketua</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-left text-gray-900">Anggota</th>
                                    <th class="whitespace-nowrap px-4 py-2 text-right font-medium text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($enrollments->where('status', 'pending') as $enrollment)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $enrollment->group_name }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $enrollment->student->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">
                                            {{ $enrollment->members->pluck('user.name')->implode(', ') ?: '-' }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 text-right">
                                            <div class="flex justify-end items-center gap-2">
                                                <form action="{{ route('guru.enrollment.approve', $enrollment) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="inline-block rounded bg-emerald-600 px-3 py-1 text-xs font-medium text-white hover:bg-emerald-700">Setujui</button>
                                                </form>
                                                <form action="{{ route('guru.enrollment.reject', $enrollment) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="inline-block rounded bg-red-600 px-3 py-1 text-xs font-medium text-white hover:bg-red-700">Tolak</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-gray-500 py-4">Tidak ada permintaan pendaftaran baru.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            {{-- Tabel 2: Kelompok yang Disetujui --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Kelompok yang Disetujui</h2>
                        <p class="mt-1 text-sm text-gray-600">Daftar kelompok yang sudah terdaftar dalam proyek ini.</p>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                             <thead>
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-left text-gray-900">Nama Kelompok</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-left text-gray-900">Ketua & Anggota</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-left text-gray-900">Status</th>
                                    <th class="whitespace-nowrap px-4 py-2 text-right font-medium text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                             <tbody class="divide-y divide-gray-200">
                                @forelse ($enrollments->whereNotIn('status', ['pending', 'rejected']) as $enrollment)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 align-top font-medium text-gray-900">{{ $enrollment->group_name }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 align-top text-gray-700">
                                            <b>{{ $enrollment->student->name }} (Ketua)</b><br>
                                            <span class="text-xs">{{ $enrollment->members->pluck('user.name')->implode(', ') }}</span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 align-top text-gray-700">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($enrollment->status == 'approved') bg-blue-100 text-blue-800 @endif
                                                @if($enrollment->status == 'submitted') bg-emerald-100 text-emerald-800 @endif
                                                @if($enrollment->status == 'revision_needed') bg-amber-100 text-amber-800 @endif
                                                @if($enrollment->status == 'graded') bg-gray-200 text-gray-800 @endif
                                            ">
                                                {{ Str::of($enrollment->status)->replace('_', ' ')->title() }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-2 align-top text-right">
                                            <div class="flex justify-end items-center gap-2">
                                                {{-- ▼▼▼ 2. Perbarui Tombol Lihat Submission ▼▼▼ --}}
                                                @if($enrollment->submissions->isNotEmpty())
                                                    <button type="button"
                                                        @click="isModalOpen = true; submission = {{ json_encode($enrollment->submissions->first()) }}"
                                                        class="inline-block rounded-lg bg-gray-600 px-3 py-2 text-xs font-medium text-white transition hover:bg-gray-700">
                                                        Lihat Submission
                                                    </button>
                                                @endif

                                                @if($enrollment->status == 'submitted')
                                                    <a href="{{ route('guru.proyek.grading.show', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}" class="inline-block rounded-lg bg-emerald-600 px-3 py-2 text-xs font-medium text-white transition hover:bg-emerald-700">
                                                        Beri Nilai
                                                    </a>
                                                @elseif($enrollment->status == 'graded')
                                                    <a href="{{ route('guru.proyek.grading.result', ['proyek' => $proyek, 'enrollment' => $enrollment]) }}" class="inline-block rounded-lg bg-indigo-600 px-3 py-2 text-xs font-medium text-white transition hover:bg-indigo-700">
                                                        Lihat Nilai
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-gray-500 py-4">Belum ada kelompok yang disetujui.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            {{-- Tabel 3: Riwayat Pendaftar Ditolak (Tidak ada perubahan) --}}
            {{-- ... --}}
        </div>

        {{-- ▼▼▼ 3. Tambahkan Komponen Modal di Sini ▼▼▼ --}}
        <div x-show="isModalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div @click.outside="isModalOpen = false" class="bg-white rounded-lg shadow-xl w-full max-w-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Detail Submission</h3>
                    <div class="space-y-3 text-sm">
                        <p><strong>Tanggal Submit:</strong> <span x-text="new Date(submission.created_at).toLocaleString('id-ID', { dateStyle: 'long', timeStyle: 'short' })"></span></p>

                        <div x-show="submission.final_submission_file">
                             <p class="font-medium">File Proyek:</p>
                             <a :href="`/storage/${submission.final_submission_file}`" target="_blank" class="text-blue-500 hover:underline break-all" x-text="submission.final_submission_file.split('/').pop()"></a>
                        </div>

                        <div x-show="submission.final_submission_link">
                             <p class="font-medium">Link Tambahan:</p>
                             <a :href="submission.final_submission_link" target="_blank" class="text-blue-500 hover:underline break-all" x-text="submission.final_submission_link"></a>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-end">
                    <x-secondary-button @click="isModalOpen = false">Tutup</x-secondary-button>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
