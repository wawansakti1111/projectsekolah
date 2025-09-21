<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materi Tersimpan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <form action="{{ route('siswa.lms.bookmarks') }}" method="GET" class="flex items-center space-x-2">
                    <input type="text" name="search" placeholder="Cari materi tersimpan..." value="{{ request('search') }}"
                        class="form-input block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('siswa.lms.bookmarks') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors duration-200">Reset</a>
                    @endif
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($materials as $material)
                    <div class="relative bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <form action="{{ route('siswa.lms.bookmark.toggle', $material) }}" method="POST" class="absolute top-2 right-2 z-10">
                            @csrf
                            <button type="submit" class="p-2 rounded-full {{ in_array($material->id, $bookmarkedIds) ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-500' }} hover:bg-blue-100 hover:text-blue-600 transition">
                                <svg class="h-5 w-5" fill="{{ in_array($material->id, $bookmarkedIds) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                            </button>
                        </form>

                        <div class="p-6 text-gray-900 flex-grow">
                            <h3 class="font-semibold text-lg text-gray-900">{{ $material->title }}</h3>
                            <p class="mt-1 text-sm text-gray-600">Dibuat oleh: {{ $material->uploader->name ?? 'N/A' }}</p>
                            <p class="mt-1 text-xs text-gray-500">{{ $material->subject->name ?? 'Umum' }}</p>
                            <p class="mt-4 text-sm text-gray-700">{{ Str::limit($material->description, 100) }}</p>
                        </div>
                        <div class="px-6 pb-4 border-t border-gray-200 mt-4">
                            <a href="{{ route('siswa.lms.show', $material) }}" class="block w-full text-center mt-4 px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                Lihat Materi
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 p-6 bg-white text-center text-gray-500 shadow-sm sm:rounded-lg">
                        Anda belum menyimpan materi apa pun.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $materials->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
