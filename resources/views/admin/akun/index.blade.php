<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-full">
                    <section>
                        <header class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Kepala Sekolah</h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    Manajemen akun untuk kepala sekolah.
                                </p>
                            </div>
                            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah</a>
                        </header>
                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead><tr><th class="px-4 py-2 font-medium text-left text-gray-900">Nama</th><th class="px-4 py-2 font-medium text-left text-gray-900">Username</th></tr></thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($kepseks as $user)
                                        <tr>
                                            <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                            <td class="px-4 py-2 text-gray-700">{{ $user->username }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center text-gray-500 py-4">Tidak ada data.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                        <header class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Guru</h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    Manajemen akun untuk guru.
                                </p>
                            </div>
                            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah</a>
                        </header>
                        <div class="mt-6 overflow-x-auto">
                           <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead><tr><th class="px-4 py-2 font-medium text-left text-gray-900">Nama</th><th class="px-4 py-2 font-medium text-left text-gray-900">Username</th></tr></thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($gurus as $user)
                                        <tr>
                                            <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                            <td class="px-4 py-2 text-gray-700">{{ $user->username }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="2" class="text-center text-gray-500 py-4">Tidak ada data.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                        <header class="flex justify-between items-center">
                            <div>
                                <h2 class="text-lg font-medium text-gray-900">Siswa</h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    Manajemen akun untuk siswa.
                                </p>
                            </div>
                            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">Tambah</a>
                        </header>
                         <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead><tr><th class="px-4 py-2 font-medium text-left text-gray-900">Nama</th><th class="px-4 py-2 font-medium text-left text-gray-900">Username</th><th class="px-4 py-2 font-medium text-left text-gray-900">Kelas</th></tr></thead>
                                <th class="px-4 py-2 font-medium text-left">Status</th>

                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($siswas as $user)
                                        <tr>
                                            <td class="px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                            <td class="px-4 py-2 text-gray-700">{{ $user->username }}</td>
                                            <td class="px-4 py-2 text-gray-700">{{ $user->kelas->name ?? 'N/A' }}</td>
                                            <td class="px-4 py-2">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs {{ $user->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                            {{ ucfirst($user->status) }}
                                            </span>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="text-center text-gray-500 py-4">Tidak ada data.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
            </div>

        </div>
    </div>
</x-app-layout>
