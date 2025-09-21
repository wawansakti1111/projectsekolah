{{-- resources/views/siswa/proyek/my-projects.blade.php --}}

{{-- ▼▼▼ 1. Inisialisasi x-data di elemen pembungkus ▼▼▼ --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proyek Saya') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openModal: false, submission: {} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">Daftar Proyek Anda</h2>
                        <p class="mt-1 text-sm text-gray-600">Berikut adalah daftar proyek yang Anda daftarkan.</p>
                    </header>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left">Judul Proyek</th>
                                    <th class="px-4 py-2 font-medium text-left">Guru</th>
                                    <th class="px-4 py-2 font-medium text-left">Status</th>
                                    <th class="px-4 py-2 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($enrollments as $enrollment)
                                    <tr>
                                        <td class="px-4 py-2 font-medium align-top">{{ $enrollment->project->title }}</td>
                                        <td class="px-4 py-2 text-gray-700 align-top">{{ $enrollment->project->teacher->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-gray-700 align-top">
                                            <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                                @if($enrollment->status == 'pending') bg-gray-100 text-gray-800 @endif
                                                @if($enrollment->status == 'approved') bg-blue-100 text-blue-800 @endif
                                                @if($enrollment->status == 'submitted') bg-emerald-100 text-emerald-800 @endif
                                                @if($enrollment->status == 'revision_needed') bg-amber-100 text-amber-800 @endif
                                                @if($enrollment->status == 'graded') bg-indigo-100 text-indigo-800 @endif
                                                @if($enrollment->status == 'rejected') bg-red-100 text-red-800 @endif
                                            ">
                                                {{ Str::of($enrollment->status)->replace('_', ' ')->title() }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2 text-right align-top">
                                            {{-- ▼▼▼ 2. Tombol Pemicu Modal ▼▼▼ --}}
                                            @if ($enrollment->status == 'approved')
                                                <a href="{{ route('siswa.proyek.submit', $enrollment->id) }}" class="inline-block rounded-lg px-4 py-2 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700">Submit Proyek</a>
                                            @elseif ($enrollment->status == 'revision_needed')
                                                <a href="{{ route('siswa.proyek.submit', $enrollment->id) }}" class="inline-block rounded-lg px-4 py-2 text-xs font-medium text-white bg-amber-500 hover:bg-amber-600">Unggah Revisi</a>
                                            @elseif ($enrollment->status == 'submitted' && $enrollment->submissions->first())
                                                <button type="button"
                                                   @click="openModal = true; submission = {{ json_encode($enrollment->submissions->first()) }}"
                                                   class="inline-block rounded-lg bg-gray-600 px-4 py-2 text-xs font-medium text-white hover:bg-gray-700">Lihat Detail</button>
                                            @elseif ($enrollment->status == 'graded')
                                                <a href="#" class="inline-block rounded-lg bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">Lihat Nilai</a>
                                            @else
                                                <span class="text-gray-500 px-4 py-2">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-gray-500 py-4">Anda belum mendaftar ke proyek apa pun.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $enrollments->links() }}
                    </div>
                </section>
            </div>
        </div>

        {{-- ▼▼▼ 3. Struktur Modal HTML ▼▼▼ --}}
        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto bg-black bg-opacity-50 flex items-center justify-center" style="display: none;">
            <div @click.outside="openModal = false" class="relative bg-white rounded-lg shadow-xl w-full max-w-lg mx-4">
                <div class="p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 border-b pb-2">Detail Submission Anda</h3>
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
                    <x-secondary-button @click="openModal = false">Tutup</x-secondary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
