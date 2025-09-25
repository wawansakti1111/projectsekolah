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
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Manajemen LMS') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola materi pembelajaran dengan mudah</p>
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

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-green-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Materi</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $materials->count() }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-emerald-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total File</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $materials->sum(fn($m) => $m->contents->count()) }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-teal-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pengunggah Unik</p>
                            <p class="text-2xl font-bold text-gray-900 mt-1">{{ $materials->pluck('uploader_id')->unique()->count() }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-teal-100 text-teal-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">

                <div class="p-6 md:p-8">

                    <!-- Tombol Tambah -->
                    <a href="{{ route('admin.lms.create') }}" 
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Materi Baru
                    </a>

                    <!-- Tabel Responsif -->
                    <div class="overflow-x-auto rounded-2xl border border-green-200/50 bg-white/60">
                        <table class="min-w-full divide-y divide-green-100 text-sm">
                            <thead class="bg-green-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Judul Materi</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Mata Pelajaran</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Pengunggah</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Total File</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-50 bg-white">
                                @forelse ($materials as $material)
                                    <tr class="hover:bg-green-50 transition-colors">
                                        <td class="px-6 py-5 font-medium text-gray-900">
                                            <div class="flex items-center gap-3">
                                                <div class="h-2 w-2 rounded-full bg-green-500"></div>
                                                <span>{{ $material->title }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-gray-600">
                                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-green-50 text-green-700 text-xs font-medium border border-green-200">
                                                {{ $material->subject->name ?? '–' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-gray-600">
                                            <div class="flex items-center gap-2">
                                                <div class="h-6 w-6 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center text-white text-xs font-bold">
                                                    {{ substr($material->uploader->name ?? 'N', 0, 1) }}
                                                </div>
                                                {{ $material->uploader->name ?? 'N/A' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-sm font-bold bg-green-100 text-green-800 border border-green-200">
                                                {{ $material->contents->count() }} file
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-right">
                                            <div class="inline-flex rounded-lg bg-gray-50 p-1 border border-gray-200">
                                                <a href="{{ route('admin.lms.show', $material->id) }}" 
                                                   class="inline-flex items-center gap-2 rounded px-3 py-2 text-sm font-medium text-gray-700 hover:text-white hover:bg-gradient-to-r hover:from-green-600 hover:to-emerald-500 transition-all">
                                                    Manage
                                                </a>
                                                <form method="POST" action="{{ route('admin.lms.destroy', $material->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center gap-2 rounded px-3 py-2 text-sm font-medium text-red-600 hover:text-white hover:bg-gradient-to-r hover:from-red-500 hover:to-pink-500 transition-all"
                                                            onclick="return confirm('Yakin ingin menghapus materi ini? Data tidak bisa dikembalikan.')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-20 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-4 text-gray-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-lg font-medium">Belum ada materi</p>
                                                <p class="text-sm max-w-md">Klik tombol <strong>“Tambah Materi Baru”</strong> untuk memulai.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($materials->hasPages())
                        <div class="mt-8 flex justify-center">
                            <div class="inline-flex rounded-xl shadow-sm border border-gray-200">
                                {{ $materials->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>