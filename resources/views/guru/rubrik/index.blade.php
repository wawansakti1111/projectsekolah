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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Manajemen Rubrik') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola rubrik penilaian proyek & SDG</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 relative z-10">

            @if (session('status'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 border border-green-200 shadow-sm animate-fade-in" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Rubrik Penilaian Proyek -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="border-b-2 border-green-200">
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-green-800">Rubrik Penilaian Proyek</h3>
                                <p class="text-green-600 text-sm">Rubrik umum yang berlaku untuk keseluruhan proyek</p>
                            </div>
                        </div>
                        <a href="{{ route('guru.rubrik.proyek.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Rubrik Proyek
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                        <table class="min-w-full divide-y divide-green-200 text-sm">
                            <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Proyek Terkait</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100 bg-white">
                                @forelse ($projectRubrics as $rubric)
                                    <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                        <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                            <div class="flex items-center gap-3">
                                                <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                {{ $rubric->project->title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                <a href="{{ route('guru.rubrik.proyek.edit', $rubric->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('guru.rubrik.proyek.destroy', $rubric->id) }}" id="delete-form-project-rubric-{{ $rubric->id }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                            data-form-id="project-rubric-{{ $rubric->id }}"
                                                            data-warning="Anda yakin ingin menghapus rubrik proyek ini?">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-lg font-medium">Belum ada rubrik proyek.</p>
                                                <p class="text-sm">Mulai dengan menambahkan rubrik pertama Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Rubrik Penilaian SDG -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="border-b-2 border-green-200">
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-green-800">Rubrik Penilaian SDG</h3>
                                <p class="text-green-600 text-sm">Rubrik spesifik untuk menilai setiap aspek SDG dalam proyek</p>
                            </div>
                        </div>
                        <a href="{{ route('guru.rubrik.sdg.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Rubrik SDG
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                        <table class="min-w-full divide-y divide-green-200 text-sm">
                            <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Proyek Terkait</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">SDG yang Sudah Dibuat Rubrik</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100 bg-white">
                                @forelse ($sdgRubrics as $projectId => $rubrics)
                                    <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                        <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                            <div class="flex items-center gap-3">
                                                <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                {{ $rubrics->first()->project->title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($rubrics as $rubric)
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                        {{ $rubric->sdg->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                <a href="{{ route('guru.rubrik.sdg.edit', $projectId) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('guru.rubrik.sdg.destroy-by-project', $projectId) }}" id="delete-form-sdg-project-{{ $projectId }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                            data-form-id="sdg-project-{{ $projectId }}"
                                                            data-warning="Anda yakin ingin menghapus SEMUA rubrik SDG untuk proyek ini?">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Hapus Semua
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-lg font-medium">Belum ada rubrik SDG.</p>
                                                <p class="text-sm">Mulai dengan menambahkan rubrik SDG pertama Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        @keyframes pingSlow {
            0% { transform: scale(1); opacity: 1; }
            75%, 100% { transform: scale(2); opacity: 0; }
        }

        .animate-fade-in { animation: fadeIn 0.6s ease-out; }
        .animate-bounce-slow { animation: bounceSlow 2s infinite; }
        .animate-ping-slow { animation: pingSlow 1.5s cubic-bezier(0, 0, 0.2, 1) infinite; }
    </style>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function (event) {
                    const formId = this.dataset.formId;
                    const form = document.getElementById(`delete-form-${formId}`);
                    const warningText = this.dataset.warning || 'Data ini akan dihapus secara permanen!';
                    event.preventDefault();
                    Swal.fire({
                        title: 'Anda Yakin?',
                        text: warningText,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#059669',
                        cancelButtonColor: '#dc2626',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed && form) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>