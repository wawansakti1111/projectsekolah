<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Rubrik SDG untuk Proyek: ') . $project->title }}
        </h2>
        {{-- Link CSS untuk Select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .select2-container .select2-selection--single { height: 2.75rem; border-radius: 0.375rem; border: 1px solid #d1d5db; }
            .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 2.75rem; padding-left: 0.75rem; }
            .select2-container--default .select2-selection--single .select2-selection__arrow { height: 2.625rem; }
            .select2-dropdown { border-radius: 0.375rem; border: 1px solid #d1d5db; }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('guru.rubrik.sdg.update', $project) }}"
                          x-data="sdgRubricForm(@js($projects), @js($project->id), @js($sdgRubrics))"
                          x-init="init()">
                        @csrf
                        @method('PUT')

                        <div class="mb-4" wire:ignore>
                            <label for="project_id" class="block font-medium text-sm text-gray-700">Pilih Proyek</label>
                            <select name="project_id" id="project_id" class="block mt-1 w-full" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($projects as $proj)
                                <option value="{{ $proj->id }}">{{ $proj->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mt-6">Indikator Penilaian SDG</h3>

                        <div x-show="selectedProjectId" class="mt-4 space-y-6">
                            <template x-for="(sdgRubric, sdgIndex) in sdgRubrics" :key="sdgIndex">
                                <div class="p-4 border rounded-lg bg-gray-50 relative">
                                    <button type="button" @click="removeSdgRubric(sdgIndex)" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>

                                    <div class="mb-4" wire:ignore>
                                        <label :for="'sdg-id-' + sdgIndex" class="block font-medium text-sm text-gray-700 mb-2">Pilih SDG</label>
                                        <select :name="'sdgRubrics[' + sdgIndex + '][sdg_id]'" :id="'sdg-id-' + sdgIndex" class="sdg-select block w-full" x-model="sdgRubric.sdg_id" required>
                                            <option value="">-- Pilih SDG --</option>
                                            <template x-for="sdg in getFilteredSdgs(sdgIndex)" :key="sdg.id">
                                                <option :value="sdg.id" x-text="sdg.name"></option>
                                            </template>
                                        </select>
                                    </div>

                                    <h4 class="font-semibold text-sm mt-4">Indikator Penilaian</h4>
                                    <div class="mt-2 space-y-2">
                                        <template x-for="(item, itemIndex) in sdgRubric.items" :key="itemIndex">
                                            <div class="flex items-center space-x-4">
                                                <div class="w-2/3">
                                                    <label :for="'sdg-item-name-' + sdgIndex + '-' + itemIndex" class="block font-medium text-sm text-gray-700">Nama Indikator</label>
                                                    <input type="text" :name="'sdgRubrics[' + sdgIndex + '][items][' + itemIndex + '][name]'" x-model="item.name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                                </div>
                                                <div class="w-1/3">
                                                    <label :for="'sdg-item-weight-' + sdgIndex + '-' + itemIndex" class="block font-medium text-sm text-gray-700">Bobot (%)</label>
                                                    <input type="number" :name="'sdgRubrics[' + sdgIndex + '][items][' + itemIndex + '][weight]'" x-model="item.weight" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" min="1" max="100" required>
                                                </div>
                                                <button type="button" @click="removeItem(sdgIndex, itemIndex)" class="mt-5 text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>
                                            </div>
                                        </template>
                                    </div>
                                    <x-secondary-button type="button" @click="addItem(sdgIndex)" class="mt-4 text-xs">
                                        + Tambah Indikator
                                    </x-secondary-button>
                                </div>
                            </template>
                        </div>

                        <div x-show="selectedProjectId">
                            <x-secondary-button type="button" @click="addSdgRubric" class="mt-6"
                                  x-bind:disabled="sdgRubrics.length >= availableSdgs.length && availableSdgs.length > 0">
                                + Tambah SDG
                            </x-secondary-button>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('guru.rubrik.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">Batal</a>
                            <x-primary-button class="ms-4">Update Rubrik</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // Menggunakan fungsi JavaScript yang sama dengan halaman create
        function sdgRubricForm(projects, currentProjectId, existingRubrics) {
            return {
                projects: projects,
                selectedProjectId: currentProjectId || '',
                availableSdgs: [],
                sdgRubrics: existingRubrics && existingRubrics.length > 0 ? existingRubrics : [],

                getFilteredSdgs(currentIndex) {
                    const selectedIds = this.sdgRubrics
                        .map((rubric, index) => (index !== currentIndex) ? rubric.sdg_id : null)
                        .filter(id => id);
                    return this.availableSdgs.filter(sdg => !selectedIds.includes(String(sdg.id)));
                },

                init() {
                    let self = this;
                    $('#project_id').select2({ placeholder: '-- Pilih Proyek --' })
                        .val(this.selectedProjectId).trigger('change')
                        .on('change', function(e) {
                            self.selectedProjectId = $(this).val();
                        });

                    this.$watch('selectedProjectId', (newVal) => {
                        this.updateAvailableSdgs(newVal);
                    });

                    this.updateAvailableSdgs(this.selectedProjectId);

                    if (this.sdgRubrics.length === 0) {
                        this.addSdgRubric();
                    }
                },

                updateAvailableSdgs(projectId) {
                    let self = this;
                    if (!projectId) {
                        this.availableSdgs = [];
                        return;
                    }
                    const selectedProject = this.projects.find(p => p.id == projectId);
                    this.availableSdgs = selectedProject ? selectedProject.sdgs : [];

                    this.$nextTick(() => {
                        $('.sdg-select').each(function(index) {
                            var el = $(this);
                            if (el.data('select2')) { el.select2('destroy'); }
                            el.select2({ placeholder: '-- Pilih SDG --' })
                                .val(self.sdgRubrics[index] ? self.sdgRubrics[index].sdg_id : null).trigger('change')
                                .on('change', (e) => {
                                    if (self.sdgRubrics[index]) {
                                        self.sdgRubrics[index].sdg_id = e.target.value;
                                    }
                                });
                        });
                    });
                },

                addSdgRubric() {
                    this.sdgRubrics.push({ sdg_id: '', items: [{ name: '', weight: '' }] });
                    this.$nextTick(() => { this.updateAvailableSdgs(this.selectedProjectId); });
                },
                removeSdgRubric(index) { this.sdgRubrics.splice(index, 1); },
                addItem(sdgIndex) { this.sdgRubrics[sdgIndex].items.push({ name: '', weight: '' }); },
                removeItem(sdgIndex, itemIndex) { this.sdgRubrics[sdgIndex].items.splice(itemIndex, 1); }
            }
        }
    </script>
    @endpush
</x-app-layout>
