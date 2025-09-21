<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{-- route('users.create') --}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mb-4">
                        Tambah Pengguna
                    </a>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                            <thead class="ltr:text-left rtl:text-right">
                                <tr>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Nama</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Username</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Email</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Peran</th>
                                    <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Kelas</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->username }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->email }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->role->name ?? 'N/A' }}</td>
                                        <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $user->kelas->name ?? 'N/A' }}</td>
                                        <td class="whitespace-nowrap px-4 py-2">
                                            </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data pengguna.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
