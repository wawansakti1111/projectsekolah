<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Kuis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Daftar Kuis Anda</h3>
                            <p class="mt-1 text-sm text-gray-600">Kelola semua kuis yang telah Anda buat.</p>
                        </div>
                        <a href="{{ route('guru.quiz.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Buat Kuis Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Judul Kuis</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Materi Terkait</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Total Pertanyaan</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse ($quizzes as $quiz)
                                    <tr>
                                        <td class="px-4 py-2 font-medium">{{ $quiz->title }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $quiz->lmsMaterial->title ?? '-' }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $quiz->questions_count }} Pertanyaan</td>
                                        <td class="px-4 py-2 text-right">
                                            <div class="flex justify-end items-center gap-2">
                                                <a href="{{ route('guru.quiz.show', $quiz) }}" class="inline-block rounded-lg bg-blue-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-blue-600">
                                                    Manage
                                                </a>
                                                <a href="{{ route('guru.quiz.edit', $quiz) }}" class="inline-block rounded-lg bg-gray-200 px-3 py-2 text-xs font-medium text-gray-700 transition hover:bg-gray-300">
                                                    Edit
                                                </a>
                                                <a href="{{ route('guru.quiz.analytics', $quiz) }}" class="inline-block rounded-lg bg-blue-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-blue-600">
                                                Analitik
                                                </a>
                                                <form method="POST" action="{{ route('guru.quiz.destroy', $quiz) }}" onsubmit="return confirm('Anda yakin ingin menghapus kuis ini beserta semua pertanyaannya?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-block rounded-lg bg-red-500 px-3 py-2 text-xs font-medium text-white transition hover:bg-red-600">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center text-gray-500 py-4">Anda belum membuat kuis.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $quizzes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
