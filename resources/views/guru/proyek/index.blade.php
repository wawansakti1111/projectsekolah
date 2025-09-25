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
                            {{ __('Manajemen Proyek Saya') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola proyek pembelajaran yang Anda buat</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <!-- Tombol Tambah -->
                    <a href="{{ route('guru.proyek.create') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 group">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Buat Proyek Baru
                    </a>

                    <!-- Tabel Responsif -->
                    <div class="mt-8 overflow-x-auto rounded-xl border-2 border-green-100 bg-white/60 backdrop-blur">
                        <table class="min-w-full divide-y divide-green-100 text-sm">
                            <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Judul Proyek</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Mata Pelajaran</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Materi</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">SDGs</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Deadline</th>
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
                                        <td class="px-6 py-5">{{ $project->subject->name ?? '–' }}</td>
                                        <td class="px-6 py-5">
                                            @if($project->attachment_path)
                                                <a href="{{ asset('storage/' . $project->attachment_path) }}" target="_blank" 
                                                   class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 hover:bg-green-200 transition-colors">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                    </svg>
                                                    File
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs">–</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex flex-wrap gap-1">
                                                @forelse ($project->sdgs as $sdg)
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                        {{ $sdg->name }}
                                                    </span>
                                                @empty
                                                    <span class="text-gray-400 text-xs">–</span>
                                                @endforelse
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            @if($project->deadline)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                                    {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-xs">–</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                <a href="{{ route('guru.proyek.show', $project->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>
                                                    Manage
                                                </a>
                                                <a href="{{ route('guru.proyek.edit', $project->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-emerald-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('guru.proyek.destroy', $project->id) }}" id="delete-form-guru-project-{{ $project->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                            data-form-id="guru-project-{{ $project->id }}">
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
                                        <td colspan="6" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                                <p class="text-lg font-medium">Anda belum membuat proyek.</p>
                                                <p class="text-sm">Mulai dengan menekan tombol <strong>“Buat Proyek Baru”</strong>.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($projects->hasPages())
                        <div class="mt-8 flex justify-center">
                            {{ $projects->links() }}
                        </div>
                    @endif

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