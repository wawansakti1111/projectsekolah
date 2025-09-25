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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Manajemen Proyek, Mapel & SDG') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Sistem manajemen pembelajaran terintegrasi</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10">

            <!-- Manajemen Proyek Section -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="border-b-2 border-green-200">
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-green-800">Manajemen Proyek</h3>
                                <p class="text-green-600 text-sm">Kelola semua proyek pembelajaran</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.proyek.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Proyek
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                        <table class="min-w-full divide-y divide-green-200 text-sm">
                            <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Judul Proyek</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Mata Pelajaran</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Guru</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Materi</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Deadline</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">SDGs</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100 bg-white">
                                @forelse ($projects as $project)
                                    <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                        <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                            <div class="flex items-center gap-3">
                                                <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                {{ $project->title }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                {{ $project->subject->name ?? '–' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5">{{ $project->teacher->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-5">
                                            @if($project->attachment_path)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                    </svg>
                                                    Ada File
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">–</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($project->deadline)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">–</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-wrap gap-1">
                                                @forelse ($project->sdgs as $sdg)
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                        {{ $sdg->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-gray-400 text-xs">–</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                <a href="{{ route('admin.proyek.edit', $project->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.proyek.destroy', $project->id) }}" id="delete-form-project-{{ $project->id }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                            data-form-id="project-{{ $project->id }}">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        <td colspan="7" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-lg font-medium">Belum ada proyek yang dibuat.</p>
                                                <p class="text-sm">Mulai dengan menambahkan proyek pertama Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-center">{{ $projects->links() }}</div>
                </div>
            </div>

            <!-- Manajemen Mata Pelajaran Section -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="border-b-2 border-green-200">
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-green-800">Manajemen Mata Pelajaran</h3>
                                <p class="text-green-600 text-sm">Kelola kurikulum mata pelajaran</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.subject.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Mapel
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                        <table class="min-w-full divide-y divide-green-200 text-sm">
                            <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Nama Mata Pelajaran</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100 bg-white">
                                @forelse ($subjects as $subject)
                                    <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                        <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                            <div class="flex items-center gap-3">
                                                <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                {{ $subject->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                <a href="{{ route('admin.subject.edit', $subject->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.subject.destroy', $subject->id) }}" id="delete-form-subject-{{ $subject->id }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                            data-form-id="subject-{{ $subject->id }}">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                                </svg>
                                                <p class="text-lg font-medium">Belum ada mata pelajaran.</p>
                                                <p class="text-sm">Mulai dengan menambahkan mata pelajaran pertama Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-center">{{ $subjects->links() }}</div>
                </div>
            </div>

            <!-- Manajemen SDG Section -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="border-b-2 border-green-200">
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-green-800">Manajemen SDG</h3>
                                <p class="text-green-600 text-sm">Kelola Tujuan Pembangunan Berkelanjutan</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.sdg.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah SDG
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                        <table class="min-w-full divide-y divide-green-200 text-sm">
                            <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Nama SDG</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100 bg-white">
                                @forelse ($sdgs as $sdg)
                                    <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                        <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                            <div class="flex items-center gap-3">
                                                <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                {{ $sdg->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                <a href="{{ route('admin.sdg.edit', $sdg->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.sdg.destroy', $sdg->id) }}" id="delete-form-sdg-{{ $sdg->id }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                            data-form-id="sdg-{{ $sdg->id }}">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-lg font-medium">Belum ada SDG yang dibuat.</p>
                                                <p class="text-sm">Mulai dengan menambahkan SDG pertama Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-center">{{ $sdgs->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        @keyframes bounceSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        @keyframes pingSlow {
            0% { transform: scale(1); opacity: 1; }
            75%, 100% { transform: scale(2); opacity: 0; }
        }

        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
        .animate-bounce-slow { animation: bounceSlow 2s infinite; }
        .animate-ping-slow { animation: pingSlow 1.5s cubic-bezier(0, 0, 0.2, 1) infinite; }
    </style>
</x-app-layout>