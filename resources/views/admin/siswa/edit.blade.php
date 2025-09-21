<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Akun Siswa: ') . $siswa->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.siswa.update', $siswa->id) }}">
                        @csrf
                        @method('PUT')

                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $siswa->name)" required autofocus />

                        <div class="mt-4">
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $siswa->username)" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="class_id" :value="__('Kelas')" />
                            <select name="class_id" id="class_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}" @selected(old('class_id', $siswa->class_id) == $item->id)>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email (Opsional)')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $siswa->email)" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password Baru (Kosongkan jika tidak diubah)')" />
                            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.manajemen.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">{{ __('Update') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
