<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Rubrik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            {{-- ## KARTU UNTUK RUBRIK PENILAIAN PROYEK ## --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Rubrik Penilaian Proyek</h2>
                            <p class="mt-1 text-sm text-gray-600">Rubrik umum yang berlaku untuk keseluruhan proyek.</p>
                        </div>
                        <a href="{{ route('guru.rubrik.proyek.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Tambah Rubrik Proyek
                        </a>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Proyek Terkait</th>
                                    <th class="px-4 py-2 text-right font-medium text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($projectRubrics as $rubric)
                                <tr>
                                    <td class="px-4 py-2 font-medium text-gray-900">{{ $rubric->project->title }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('guru.rubrik.proyek.edit', $rubric->id) }}" class="inline-block rounded-lg bg-blue-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-blue-600">Edit</a>
                                            <form method="POST" action="{{ route('guru.rubrik.proyek.destroy', $rubric->id) }}" id="delete-form-project-rubric-{{ $rubric->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="delete-button inline-block rounded-lg bg-gray-200 px-3 py-2 text-xs font-medium text-gray-700 transition hover:bg-red-500 hover:text-white"
                                                        data-form-id="project-rubric-{{ $rubric->id }}"
                                                        data-warning="Anda yakin ingin menghapus rubrik proyek ini?">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="2" class="text-center text-gray-500 py-4">Belum ada rubrik proyek.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            {{-- ## KARTU UNTUK RUBRIK PENILAIAN SDG ## --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex justify-between items-start">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Rubrik Penilaian SDG</h2>
                            <p class="mt-1 text-sm text-gray-600">Rubrik spesifik untuk menilai setiap aspek SDG dalam proyek.</p>
                        </div>
                        <a href="{{ route('guru.rubrik.sdg.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Tambah Rubrik SDG
                        </a>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Proyek Terkait</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">SDG yang Sudah Dibuat Rubrik</th>
                                    <th class="px-4 py-2 text-right font-medium text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($sdgRubrics as $projectId => $rubrics)
                                <tr>
                                    <td class="px-4 py-2 font-medium text-gray-900 align-top">
                                        {{ $rubrics->first()->project->title }}
                                    </td>
                                    <td class="px-4 py-2 text-gray-700 align-top">
                                        @foreach ($rubrics as $rubric)
                                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-xs font-semibold text-gray-800 mr-1 mb-1">
                                            {{ $rubric->sdg->name }}
                                        </span>
                                        @endforeach
                                    </td>
                                    <td class="px-4 py-2 text-right align-top">
                                        <div class="flex justify-end items-center gap-2">
                                            {{-- ▼▼▼ PERUBAHAN PENTING DI SINI ▼▼▼ --}}
                                            <a href="{{ route('guru.rubrik.sdg.edit', $projectId) }}" class="inline-block rounded-lg bg-blue-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-blue-600">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('guru.rubrik.sdg.destroy-by-project', $projectId) }}" id="delete-form-sdg-project-{{ $projectId }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-button inline-block rounded-lg bg-gray-200 px-3 py-2 text-xs font-medium text-gray-700 transition hover:bg-red-500 hover:text-white" data-form-id="sdg-project-{{ $projectId }}" data-warning="Anda yakin ingin menghapus SEMUA rubrik SDG untuk proyek ini?">
                                                    Hapus Semua
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-gray-500 py-4">Belum ada rubrik SDG.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function (event) {
                    const formId = this.dataset.formId;
                    const form = document.getElementById('delete-form-' + formId);
                    const warningText = this.dataset.warning || 'Data ini akan dihapus secara permanen!';
                    event.preventDefault();
                    Swal.fire({
                        title: 'Anda Yakin?',
                        text: warningText,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
