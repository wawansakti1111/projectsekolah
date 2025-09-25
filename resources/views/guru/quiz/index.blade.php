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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Manajemen Kuis') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Kelola semua kuis yang telah Anda buat</p>
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

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                        <div>
                            <h3 class="text-xl font-bold text-green-800">Daftar Kuis Anda</h3>
                            <p class="mt-1 text-green-600 text-sm">Kelola semua kuis yang telah Anda buat.</p>
                        </div>
                        <a href="{{ route('guru.quiz.create') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Kuis Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto -mx-4 sm:mx-0">
                        <table class="min-w-full divide-y divide-green-100 text-sm">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Judul Kuis</th>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Materi Terkait</th>
                                    <th class="px-4 py-3 text-left font-semibold text-green-800">Total Pertanyaan</th>
                                    <th class="px-4 py-3 text-right font-semibold text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100">
                                @forelse ($quizzes as $quiz)
                                    <tr class="hover:bg-green-50/50 transition-colors">
                                        <td class="px-4 py-4 font-medium text-gray-900">{{ $quiz->title }}</td>
                                        <td class="px-4 py-4 text-gray-700">{{ $quiz->lmsMaterial->title ?? '-' }}</td>
                                        <td class="px-4 py-4 text-gray-700">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $quiz->questions_count }} Pertanyaan
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-right">
                                            <div class="flex flex-wrap justify-end gap-2">
                                                <a href="{{ route('guru.quiz.show', $quiz) }}"
                                                   class="px-3 py-2 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 text-xs font-medium rounded-lg hover:from-blue-200 hover:to-indigo-200 transition flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V5a2 2 0 00-2-2h-7m-9 18l6-6m-6 6l6 6m-6-6H3" />
                                                    </svg>
                                                    Manage
                                                </a>
                                                <a href="{{ route('guru.quiz.edit', $quiz) }}"
                                                   class="px-3 py-2 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 text-xs font-medium rounded-lg hover:from-gray-200 hover:to-gray-300 transition flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <a href="{{ route('guru.quiz.analytics', $quiz) }}"
                                                   class="px-3 py-2 bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 text-xs font-medium rounded-lg hover:from-emerald-200 hover:to-teal-200 transition flex items-center gap-1">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                    </svg>
                                                    Analitik
                                                </a>
                                                <form method="POST" action="{{ route('guru.quiz.destroy', $quiz) }}"
                                                      onsubmit="return confirm('Anda yakin ingin menghapus kuis ini beserta semua pertanyaannya?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="px-3 py-2 bg-gradient-to-r from-red-100 to-rose-100 text-red-700 text-xs font-medium rounded-lg hover:from-red-200 hover:to-rose-200 transition flex items-center gap-1">
                                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        <td colspan="4" class="px-4 py-12 text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2-8V6a2 2 0 00-2-2H7a2 2 0 00-2 2v4m10 0h.01M19 10h.01" />
                                                </svg>
                                                <p class="font-medium">Anda belum membuat kuis.</p>
                                                <p class="text-sm text-gray-500 mt-1">Mulai dengan membuat kuis baru.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($quizzes->hasPages())
                        <div class="mt-8">
                            {{ $quizzes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>