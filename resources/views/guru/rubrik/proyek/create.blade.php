<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Rubrik Penilaian SDG') }}
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

                    {{-- ▼▼▼ PERUBAHAN: Argumen old('sdgRubrics') dihapus dari sini ▼▼▼ --}}
                    <form method="POST" action="{{ route('guru.rubrik.sdg.store') }}"
                          x-data="sdgRubricForm(@js($projects), @js(old('project_id')))"
                          x-init="init()">
                        @csrf

                        {{-- Menampilkan error validasi umum --}}
                        @if ($errors->any() && !session('toast_error'))
                            <div class="mb-4 p-3 rounded-md bg-red-50 text-red-700 text-sm font-medium">
                                Harap perbaiki kesalahan input di bawah ini.
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="project_id" class="block font-medium text-sm text-gray-700">Pilih Proyek</label>
                            <select name="project_id" id="project_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                        </div>

                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mt-6">Indikator Penilaian SDG</h3>
                        <p class="text-sm text-gray-600 mb-4">Tambahkan satu atau lebih SDG, pastikan total bobot per SDG adalah 100%.</p>

                        <div x-show="selectedProjectId" class="mt-4 space-y-6">
                            <template x-for="(sdgRubric, sdgIndex) in sdgRubrics" :key="sdgIndex">
                                <div class="p-4 border rounded-lg bg-gray-50 relative">
                                    <button type="button" @click="removeSdgRubric(sdgIndex)" x-show="sdgRubrics.length > 1" class="absolute top-2 right-2 text-red-500 hover:text-red-700 font-bold text-xl">&times;</button>

                                    <div class="mb-4" wire:ignore>
                                        <label :for="'sdg-id-' + sdgIndex" class="block font-medium text-sm text-gray-700 mb-2">Pilih SDG</label>
                                        <select :name="'sdgRubrics[' + sdgIndex + '][sdg_id]'" :id="'sdg-id-' + sdgIndex" class="sdg-select block w-full border-gray-300 rounded-md shadow-sm" x-model="sdgRubric.sdg_id" required>
                                            <option value="">-- Pilih SDG --</option>
                                            <template x-for="sdg in getFilteredSdgs(sdgIndex)" :key="sdg.id">
                                                <option :value="sdg.id" x-text="sdg.name"></option>
                                            </template>
                                        </select>
                                    </div>

                                    <div class="flex justify-between items-center mt-4 pt-2 border-t">
                                        <h4 class="font-semibold text-sm">Indikator Penilaian</h4>
                                        <div class="text-sm font-medium text-gray-700">Total Bobot: <span x-text="calculateTotalWeight(sdgRubric.items)" :class="calculateTotalWeight(sdgRubric.items) !== 100 ? 'text-red-500 font-bold' : 'text-green-500 font-bold'"></span>%</div>
                                    </div>
                                    <div class="mt-2 space-y-2">
                                        <template x-for="(item, itemIndex) in sdgRubric.items" :key="itemIndex">
                                            <div class="flex items-end gap-4">
                                                <div class="flex-grow">
                                                    <label :for="'sdg-item-name-' + sdgIndex + '-' + itemIndex" class="block font-medium text-sm text-gray-700 text-xs">Nama Indikator</label>
                                                    <input type="text" :name="`sdgRubrics[${sdgIndex}][items][${itemIndex}][name]`" x-model="item.name" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                                </div>
                                                <div class="w-1/4">
                                                    <label :for="'sdg-item-weight-' + sdgIndex + '-' + itemIndex" class="block font-medium text-sm text-gray-700 text-xs">Bobot (%)</label>
                                                    <input type="number" :name="`sdgRubrics[${sdgIndex}][items][${itemIndex}][weight]`" x-model.number="item.weight" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required min="1">
                                                </div>
                                                <button type="button" @click="removeItem(sdgIndex, itemIndex)" x-show="sdgRubric.items.length > 1" class="px-3 py-2 bg-red-100 text-red-600 rounded-md hover:bg-red-200 text-sm">&times;</button>
                                            </div>
                                        </template>
                                    </div>
                                    <x-secondary-button type="button" @click="addItem(sdgIndex)" class="mt-3 text-xs">+ Tambah Indikator</x-secondary-button>
                                </div>
                            </template>
                        </div>

                        <div x-show="selectedProjectId">
                            <x-secondary-button type="button" @click="addSdgRubric()" x-bind:disabled="sdgRubrics.length >= availableSdgs.length && availableSdgs.length > 0">
                                + Tambah SDG
                            </x-secondary-button>
                        </div>

                        <div class="flex items-center justify-end mt-6 border-t pt-6">
                            <a href="{{ route('guru.rubrik.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                            <x-primary-button class="ms-4">Simpan Rubrik</x-primary-button>
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
        // ▼▼▼ PERBAIKAN LOGIKA INISIALISASI JAVASCRIPT ▼▼▼
        window.initialSdgRubricsData = @json(old('sdgRubrics'));

        function sdgRubricForm(projects, oldProjectId) {
            return {
                projects: projects,
                selectedProjectId: oldProjectId || '',
                availableSdgs: [],
                sdgRubrics: [],

                init() {
                    let self = this;
                    $('#project_id').select2({ placeholder: '-- Pilih Proyek --' })
                        .val(this.selectedProjectId).trigger('change')
                        .on('change', function(e) { self.selectedProjectId = $(this).val(); });

                    this.$watch('selectedProjectId', (newVal) => { this.updateAvailableSdgs(newVal); });
                    this.updateAvailableSdgs(this.selectedProjectId);

                    // Logika re-hidrasi data lama
                    let initialData = window.initialSdgRubricsData;
                    if (Array.isArray(initialData) && initialData.length > 0) {
                        this.sdgRubrics = initialData;
                    } else {
                        this.sdgRubrics = [{ sdg_id: '', items: [{ name: '', weight: '' }] }];
                    }
                },

                updateAvailableSdgs(projectId) {
                    if (projectId) {
                        const selectedProject = this.projects.find(p => p.id == projectId);
                        this.availableSdgs = selectedProject ? selectedProject.sdgs : [];
                    } else {
                        this.availableSdgs = [];
                    }
                    // Re-init select2 untuk dropdown sdg yang dinamis
                    this.$nextTick(() => {
                        $('.sdg-select').each(function(index) {
                            var el = $(this);
                            if (el.data('select2')) { el.select2('destroy'); }
                            el.select2({ placeholder: '-- Pilih SDG --' })
                                .val(self.sdgRubrics[index] ? self.sdgRubrics[index].sdg_id : null)
                                .on('change', (e) => {
                                    if (self.sdgRubrics[index]) { self.sdgRubrics[index].sdg_id = e.target.value; }
                                });
                        });
                    });
                },

                // Fungsi untuk memfilter SDG yang sudah dipilih
                getFilteredSdgs(currentIndex) {
                    const selectedIds = this.sdgRubrics
                        .map((rubric, index) => (index !== currentIndex) ? rubric.sdg_id : null)
                        .filter(id => id);
                    return this.availableSdgs.filter(sdg => !selectedIds.includes(String(sdg.id)));
                },

                addSdgRubric() {
                    this.sdgRubrics.push({ sdg_id: '', items: [{ name: '', weight: '' }] });
                    this.$nextTick(() => { this.updateAvailableSdgs(this.selectedProjectId); });
                },
                removeSdgRubric(index) {
                    if (this.sdgRubrics.length > 1) { this.sdgRubrics.splice(index, 1); }
                },
                addItem(sdgIndex) {
                    this.sdgRubrics[sdgIndex].items.push({ name: '', weight: '' });
                },
                removeItem(sdgIndex, itemIndex) {
                    if (this.sdgRubrics[sdgIndex].items.length > 1) { this.sdgRubrics[sdgIndex].items.splice(itemIndex, 1); }
                },
                calculateTotalWeight(items) {
                    if (!Array.isArray(items)) return 0;
                    return items.reduce((sum, item) => sum + Number(item.weight || 0), 0);
                }
            }
        }
    </script>
    @endpush
</x-app-layout>
