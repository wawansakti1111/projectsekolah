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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Pusat Manajemen') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Dashboard Administrasi Sekolah</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 relative z-10">

            <!-- Manajemen Kelas Section -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="border-b-2 border-green-200">
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-green-800">Manajemen Kelas</h3>
                                <p class="text-green-600 text-sm">Kelola data kelas dengan mudah dan efisien</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.kelas.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Kelas
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                        <table class="min-w-full divide-y divide-green-200 text-sm">
                            <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Nama Kelas</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Wali Kelas</th>
                                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-green-100 bg-white">
                                @forelse ($kelasList as $kelas)
                                    <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                        <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                            <div class="flex items-center gap-3">
                                                <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                {{ $kelas->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">{{ $kelas->homeroomTeacher->name ?? 'Belum Diatur' }}</td>
                                        <td class="px-6 py-5 text-center">
                                            <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                <a href="{{ route('admin.kelas.edit', $kelas->id) }}" 
                                                   class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form method="POST" action="{{ route('admin.kelas.destroy', $kelas->id) }}" id="delete-form-{{ $kelas->id }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" 
                                                            class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                            data-form-id="{{ $kelas->id }}">
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
                                        <td colspan="3" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                                <p class="text-lg font-medium">Tidak ada data kelas.</p>
                                                <p class="text-sm">Mulai dengan menambahkan kelas pertama Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 flex justify-center">{{ $kelasList->links() }}</div>
                </div>
            </div>

            <!-- Manajemen Akun Pengguna Section -->
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50 hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 group">
                <div class="border-b-2 border-green-200">
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-green-800">Manajemen Akun Pengguna</h3>
                                <p class="text-green-600 text-sm">Kelola semua akun pengguna sistem</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-8">
                    <!-- Kepala Sekolah Subsection -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-green-800">Kepala Sekolah</h4>
                            </div>
                            <a href="{{ route('admin.kepsek.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah
                            </a>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                            <table class="min-w-full divide-y divide-green-200 text-sm">
                                <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Nama</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Username</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-green-100 bg-white">
                                    @forelse ($kepseks as $user)
                                        <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                            <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">{{ $user->username }}</td>
                                            <td class="px-6 py-5 text-center">
                                                <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                    <a href="{{ route('admin.kepsek.edit', $user->id) }}" 
                                                       class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.kepsek.destroy', $user->id) }}" id="delete-form-user-{{ $user->id }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" 
                                                                class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                                data-form-id="user-{{ $user->id }}">
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
                                            <td colspan="3" class="px-6 py-16 text-center">
                                                <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                    <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                                    </svg>
                                                    <p class="text-lg font-medium">Tidak ada data.</p>
                                                    <p class="text-sm">Mulai dengan menambahkan kepala sekolah pertama Anda.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-center">{{ $kepseks->links() }}</div>
                    </div>

                    <!-- Guru Subsection -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-green-800">Guru</h4>
                            </div>
                            <a href="{{ route('admin.guru.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah
                            </a>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                            <table class="min-w-full divide-y divide-green-200 text-sm">
                                <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Nama</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Username</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-green-100 bg-white">
                                    @forelse ($gurus as $user)
                                        <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                            <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">{{ $user->username }}</td>
                                            <td class="px-6 py-5 text-center">
                                                <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                    <a href="{{ route('admin.guru.edit', $user->id) }}" 
                                                       class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.guru.destroy', $user->id) }}" id="delete-form-user-{{ $user->id }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" 
                                                                class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                                data-form-id="user-{{ $user->id }}">
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
                                            <td colspan="3" class="px-6 py-16 text-center">
                                                <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                    <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                    <p class="text-lg font-medium">Tidak ada data.</p>
                                                    <p class="text-sm">Mulai dengan menambahkan guru pertama Anda.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-center">{{ $gurus->links() }}</div>
                    </div>

                    <!-- Siswa Subsection -->
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-emerald-100 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-xl font-bold text-green-800">Siswa</h4>
                            </div>
                            <div class="flex items-center gap-3">
                                <form method="POST" action="{{ route('admin.siswa.resetAllKelas') }}" id="delete-form-reset-kelas" class="inline">
                                    @csrf
                                    <button type="button" 
                                            class="delete-button inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105"
                                            data-form-id="reset-kelas">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Reset Kelas
                                    </button>
                                </form>
                                <a href="{{ route('admin.siswa.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah
                                </a>
                            </div>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-green-200 bg-white/60 backdrop-blur">
                            <table class="min-w-full divide-y divide-green-200 text-sm">
                                <thead class="bg-gradient-to-r from-green-50 to-emerald-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Nama</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Username</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Kelas</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-green-800">Status</th>
                                        <th scope="col" class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-green-800">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-green-100 bg-white">
                                    @forelse ($siswas as $user)
                                        <tr class="hover:bg-green-50 transition-colors duration-200 group hover:scale-[1.01] transform origin-center">
                                            <td class="px-6 py-5 font-medium text-gray-900 group-hover:text-green-700">
                                                <div class="flex items-center gap-3">
                                                    <div class="h-3 w-3 rounded-full bg-green-400 animate-ping-slow"></div>
                                                    {{ $user->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-5">{{ $user->username }}</td>
                                            <td class="px-6 py-5">{{ $user->kelas->name ?? 'N/A' }}</td>
                                            <td class="px-6 py-5">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                    {{ ucfirst($user->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 text-center">
                                                <div class="inline-flex rounded-lg bg-gray-50/80 p-1 shadow-sm backdrop-blur-sm border border-gray-200">
                                                    <form method="POST" action="{{ route('admin.siswa.toggleStatus', $user->id) }}" class="inline">
                                                        @csrf
                                                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                                            </svg>
                                                            {{ $user->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('admin.siswa.edit', $user->id) }}" 
                                                       class="inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-gray-600 hover:text-green-700 hover:bg-white transition-all duration-200 group/button hover:scale-105">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('admin.siswa.destroy', $user->id) }}" id="delete-form-user-{{ $user->id }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" 
                                                                class="delete-button inline-flex items-center gap-1.5 rounded-md px-3.5 py-2 text-sm font-medium text-red-500 hover:text-red-700 hover:bg-red-50 transition-all duration-200 group/button hover:scale-105"
                                                                data-form-id="user-{{ $user->id }}">
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
                                            <td colspan="5" class="px-6 py-16 text-center">
                                                <div class="flex flex-col items-center justify-center space-y-4 text-gray-400">
                                                    <svg class="h-16 w-16 text-gray-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                                    </svg>
                                                    <p class="text-lg font-medium">Tidak ada data.</p>
                                                    <p class="text-sm">Mulai dengan menambahkan siswa pertama Anda.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-center">{{ $siswas->links() }}</div>
                    </div>
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

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const formId = this.dataset.formId;
                    const form = document.getElementById(`delete-form-${formId}`);
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#059669',
                        cancelButtonColor: '#dc2626',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed && form) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
    @endpush
</x-app-layout>