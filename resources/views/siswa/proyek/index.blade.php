<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Proyek Tersedia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">            {{-- Search and Filter Form --}}
            <div class="mb-6">
                <form action="{{ route('siswa.proyek.index') }}" method="GET" class="flex items-center space-x-4">
                    <input type="text" name="search" placeholder="Cari proyek..." value="{{ request('search') }}"
                        class="form-input block w-full rounded-md border-gray-300 shadow-sm">

                    <select name="subject_id" class="form-select block rounded-md border-gray-300 shadow-sm">
                        <option value="">Semua Mata Pelajaran</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Filter
                    </button>
                    <a href="{{ route('siswa.proyek.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">Reset</a>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <div class="p-6 text-gray-900 flex-grow">
                            <h3 class="font-semibold text-lg">{{ $project->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Oleh: {{ $project->teacher->name ?? 'N/A' }}
                            </p>
                            <p class="text-sm text-gray-500">{{ $project->subject->name ?? 'N/A' }}</p>

                            @if($project->deadline)
                                <p class="text-xs text-red-600 mt-2 font-semibold">
                                    Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}
                                </p>
                            @endif

                            <p class="mt-4 text-sm">{{ Str::limit($project->description, 100) }}</p>

                            <div class="mt-4">
                                @foreach ($project->sdgs as $sdg)
                                    <span class="inline-block bg-gray-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-1 mb-1">{{ $sdg->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-6 bg-gray-50 border-t border-gray-200">
                            <a href="{{ route('siswa.proyek.show', $project->id) }}" class="w-full text-center inline-flex items-center justify-center px-4 py-2 bg-white border border-blue-600 rounded-md font-semibold text-xs text-blue-600 uppercase tracking-widest hover:bg-blue-600 hover:text-white">
                                Lihat Detail & Daftar
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Saat ini belum ada proyek yang tersedia.</p>
                @endforelse
            </div>
            <div class="mt-6">
                {{ $projects->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
