<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Proyek, Mapel & SDG') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Manajemen Proyek</h2>
                            <p class="mt-1 text-sm text-gray-600">Manajemen semua proyek yang ada di sistem.</p>
                        </div>
                        <a href="{{ route('admin.proyek.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah Proyek</a>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Judul Proyek</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Mata Pelajaran</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Guru</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Materi</th>
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">Deadline</th> {{-- Kolom baru --}}
                                    <th class="px-4 py-2 font-medium text-left text-gray-900">SDGs Terkait</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($projects as $project)
                                    <tr>
                                        <td class="px-4 py-2 font-medium text-gray-900">{{ $project->title }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $project->subject->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-gray-700">{{ $project->teacher->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-2 text-gray-700">
                                            @if($project->attachment_path)
                                                <a href="{{ asset('storage/' . $project->attachment_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                                    Lihat File
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-gray-700">
                                            @if($project->deadline)
                                                {{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 text-gray-700">
                                            @forelse ($project->sdgs as $sdg)
                                                <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">
                                                    {{ $sdg->name }}
                                                </span>
                                            @empty
                                                -
                                            @endforelse
                                        </td>
                                        <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                                <a href="{{ route('admin.proyek.edit', $project->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">Edit</a>
                                                <form method="POST" action="{{ route('admin.proyek.destroy', $project->id) }}" id="delete-form-project-{{ $project->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="project-{{ $project->id }}">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center text-gray-500 py-4">Tidak ada data proyek.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $projects->links() }}</div>
                </section>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Manajemen Mata Pelajaran</h2>
                            <p class="mt-1 text-sm text-gray-600">Tambah, edit, atau hapus data mata pelajaran.</p>
                        </div>
                        <a href="{{ route('admin.subject.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah Mapel</a>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead><tr><th class="px-4 py-2 font-medium text-left text-gray-900">Nama Mata Pelajaran</th><th class="px-4 py-2"></th></tr></thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($subjects as $subject)
                                    <tr>
                                        <td class="px-4 py-2 font-medium">{{ $subject->name }}</td>
                                        <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                                <a href="{{ route('admin.subject.edit', $subject->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">Edit</a>
                                                <form method="POST" action="{{ route('admin.subject.destroy', $subject->id) }}" id="delete-form-subject-{{ $subject->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="subject-{{ $subject->id }}">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="text-center text-gray-500 py-4">Tidak ada data mata pelajaran.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $subjects->links() }}</div>
                </section>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex justify-between items-center">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Manajemen SDG</h2>
                            <p class="mt-1 text-sm text-gray-600">Manajemen data Tujuan Pembangunan Berkelanjutan (SDGs).</p>
                        </div>
                        <a href="{{ route('admin.sdg.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah SDG</a>
                    </header>
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead><tr><th class="px-4 py-2 font-medium text-left text-gray-900">Nama</th><th class="px-4 py-2"></th></tr></thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($sdgs as $sdg)
                                    <tr>
                                        <td class="px-4 py-2 font-medium">{{ $sdg->name }}</td>
                                        <td class="px-4 py-2 text-right">
                                            <div class="inline-flex rounded-lg border border-gray-100 bg-gray-100 p-1">
                                                <a href="{{ route('admin.sdg.edit', $sdg->id) }}" class="inline-block rounded-md px-4 py-2 text-sm text-gray-500 hover:text-gray-700 focus:relative">Edit</a>
                                                <form method="POST" action="{{ route('admin.sdg.destroy', $sdg->id) }}" id="delete-form-sdg-{{ $sdg->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="delete-button inline-block rounded-md px-4 py-2 text-sm text-red-500 hover:text-red-700 focus:relative" data-form-id="sdg-{{ $sdg->id }}">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="2" class="text-center text-gray-500 py-4">Tidak ada data SDG.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $sdgs->links() }}</div>
                </section>
            </div>

        </div>
    </div>
</x-app-layout>
