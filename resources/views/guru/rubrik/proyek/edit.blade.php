<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Rubrik Proyek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('guru.rubrik.proyek.update', $rubric->id) }}" x-data="{ items: @js($rubric->items) }">
                        @csrf
                        @method('PUT')

                        <!-- Pilih Proyek -->
                        <div>
                            <x-input-label for="project_id" value="Pilih Proyek" />
                            <select name="project_id" id="project_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id', $rubric->project_id) == $project->id)>
                                    {{ $project->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mt-6">Indikator Penilaian Proyek</h3>

                        <!-- Form Indikator Dinamis -->
                        <div class="mt-4 space-y-4">
                            <template x-for="(item, index) in items" :key="item.id">
                                <div class="flex items-center space-x-4">
                                    <div class="w-2/3">
                                        <label :for="'item-name-' + index" class="block font-medium text-sm text-gray-700">Nama Indikator</label>
                                        <input type="text" :name="'items[' + index + '][name]'" :id="'item-name-' + index" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" x-model="item.name" required>
                                    </div>
                                    <div class="w-1/3">
                                        <label :for="'item-weight-' + index" class="block font-medium text-sm text-gray-700">Bobot (%)</label>
                                        <input type="number" :name="'items[' + index + '][weight]'" :id="'item-weight-' + index" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" x-model="item.weight" min="1" max="100" required>
                                    </div>
                                    <button type="button" @click="items.splice(index, 1)" class="mt-5 text-red-500 hover:text-red-700">&times;</button>
                                </div>
                            </template>
                        </div>

                        <x-secondary-button type="button" @click="items.push({ name: '', weight: 1 })" class="mt-4">
                            + Tambah Indikator
                        </x-secondary-button>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('guru.rubrik.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">Batal</a>
                            <x-primary-button class="ms-4">Update Rubrik</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
