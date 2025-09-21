<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen LMS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('admin.lms.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 mb-4">
                        Tambah Materi Baru
                    </a>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left">Judul Materi</th>
                                    <th class="px-4 py-2 font-medium text-left">Mata Pelajaran</th>
                                    <th class="px-4 py-2 font-medium text-left">Pengunggah</th>
                                    <th class="px-4 py-2 font-medium text-left">Total File</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($materials as $material)
                                    <tr>
                                        <td class="px-4 py-2 font-medium">{{ $material->title }}</td>
                                        <td class="px-4 py-2">{{ $material->subject->name ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $material->uploader->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2">{{ $material->contents->count() }} konten</td>
                                        <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                                {{-- Tombol Manage --}}
                                                <a href="{{ route('admin.lms.show', $material->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                                    Manage
                                                </a>
                                                {{-- Tombol Hapus --}}
                                                <form method="POST" action="{{ route('admin.lms.destroy', $material->id) }}" id="delete-form-lms-{{ $material->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="lms-{{ $material->id }}">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="text-center text-gray-500 py-4">Belum ada materi yang diunggah.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $materials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
