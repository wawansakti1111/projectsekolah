<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Proyek Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('guru.proyek.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Buat Proyek Baru
                    </a>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left">Judul Proyek</th>
                                    <th class="px-4 py-2 font-medium text-left">Mata Pelajaran</th>
                                    <th class="px-4 py-2 font-medium text-left">Materi</th>
                                    <th class="px-4 py-2 font-medium text-left">SDGs</th>
                                    <th class="px-4 py-2 font-medium text-left">Deadline</th> {{-- Kolom baru --}}
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($projects as $project)
                                    <tr>
                                        <td class="px-4 py-2 font-medium">{{ $project->title }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $project->subject->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-gray-700">
                                            @if ($project->attachment_path)
                                                <a href="{{ asset('storage/' . $project->attachment_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                                    Lihat File
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-gray-700">
                                            @foreach ($project->sdgs as $sdg)
                                                <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-xs">{{ $sdg->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="px-4 py-2 text-gray-700">
                                            @if($project->deadline)
                                                {{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}
                                            @else
                                                -
                                            @endif
                                        </td> {{-- Tampilkan deadline atau tanda "-" jika kosong --}}
                                        <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                                {{-- ▼▼▼ TOMBOL MANAGE BARU ▼▼▼ --}}
                                                <a href="{{ route('guru.proyek.show', $project->id) }}" class="inline-block rounded-md bg-white px-4 py-2 text-sm text-blue-500 hover:text-blue-700 focus:relative">
                                                    Manage
                                                </a>
                                                <a href="{{ route('guru.proyek.edit', $project->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('guru.proyek.destroy', $project->id) }}" id="delete-form-guru-project-{{ $project->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="guru-project-{{ $project->id }}">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center text-gray-500 py-4">Anda belum membuat proyek.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
