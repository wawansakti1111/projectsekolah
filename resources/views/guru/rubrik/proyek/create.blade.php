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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Buat Rubrik Penilaian SDG') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Buat rubrik penilaian berbasis Tujuan Pembangunan Berkelanjutan</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Link CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 2.75rem;
            border-radius: 0.5rem;
            border: 2px solid #d1fae5;
            transition: all 0.3s ease;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.75rem;
            padding-left: 0.75rem;
            color: #065f46;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 2.625rem;
        }
        .select2-dropdown {
            border-radius: 0.5rem;
            border: 2px solid #d1fae5;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.2);
        }
    </style>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <form method="POST" action="{{ route('guru.rubrik.sdg.store') }}"
                          x-data="sdgRubricForm(@js($projects), @js(old('project_id')))"
                          x-init="init()"
                          class="space-y-6">
                        @csrf

                        <!-- Error Umum -->
                        @if ($errors->any() && !session('toast_error'))
                            <div class="p-4 mb-6 bg-red-50 border-l-4 border-red-400 text-red-700 rounded-r-lg animate-fade-in">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Harap perbaiki kesalahan input di bawah ini.</span>
                                </div>
                            </div>
                        @endif

                        <!-- Pilih Proyek -->
                        <div class="space-y-2">
                            <label for="project_id" class="text-green-800 font-semibold flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Pilih Proyek
                            </label>
                            <select name="project_id" id="project_id" class="block w-full border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 py-3 text-base" required>
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                        </div>

                        <!-- Judul Indikator -->
                        <div class="pt-6 border-t border-green-200">
                            <h3 class="text-xl font-bold text-green-800">Indikator Penilaian SDG</h3>
                            <p class="text-green-600 text-sm mt-1">Tambahkan satu atau lebih SDG, pastikan total bobot per SDG adalah 100%.</p>
                        </div>

                        <!-- Dynamic SDG Rubrics -->
                        <div x-show="selectedProjectId" class="mt-6 space-y-6">
                            <template x-for="(sdgRubric, sdgIndex) in sdgRubrics" :key="sdgIndex">
                                <div class="p-5 border-2 border-green-100 rounded-2xl bg-green-50/30 relative group">
                                    <button type="button" @click="removeSdgRubric(sdgIndex)" x-show="sdgRubrics.length > 1" 
                                            class="absolute top-3 right-3 text-red-500 hover:text-red-700 font-bold text-xl w-8 h-8 flex items-center justify-center rounded-full hover:bg-red-100 transition-colors">
                                        &times;
                                    </button>

                                    <div class="mb-4" wire:ignore>
                                        <label :for="'sdg-id-' + sdgIndex" class="block font-medium text-green-800 mb-2">Pilih SDG</label>
                                        <select :name="'sdgRubrics[' + sdgIndex + '][sdg_id]'" :id="'sdg-id-' + sdgIndex" 
                                                class="sdg-select block w-full border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 py-3 text-base" 
                                                x-model="sdgRubric.sdg_id" required>
                                            <option value="">-- Pilih SDG --</option>
                                            <template x-for="sdg in getFilteredSdgs(sdgIndex)" :key="sdg.id">
                                                <option :value="sdg.id" x-text="sdg.name"></option>
                                            </template>
                                        </select>
                                    </div>

                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-4 pt-4 border-t border-green-200">
                                        <h4 class="font-semibold text-green-800">Indikator Penilaian</h4>
                                        <div class="mt-2 sm:mt-0 text-sm font-bold" 
                                             :class="calculateTotalWeight(sdgRubric.items) !== 100 ? 'text-red-600' : 'text-green-600'">
                                            Total Bobot: <span x-text="calculateTotalWeight(sdgRubric.items)"></span>%
                                        </div>
                                    </div>

                                    <div class="mt-4 space-y-4">
                                        <template x-for="(item, itemIndex) in sdgRubric.items" :key="itemIndex">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 items-end">
                                                <div>
                                                    <label :for="'sdg-item-name-' + sdgIndex + '-' + itemIndex" class="block text-sm font-medium text-green-800">Nama Indikator</label>
                                                    <input type="text" 
                                                           :name="`sdgRubrics[${sdgIndex}][items][${itemIndex}][name]`" 
                                                           x-model="item.name" 
                                                           class="block w-full mt-1 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 py-2.5 text-base" 
                                                           required>
                                                </div>
                                                <div class="flex items-end gap-2">
                                                    <div class="flex-1">
                                                        <label :for="'sdg-item-weight-' + sdgIndex + '-' + itemIndex" class="block text-sm font-medium text-green-800">Bobot (%)</label>
                                                        <input type="number" 
                                                               :name="`sdgRubrics[${sdgIndex}][items][${itemIndex}][weight]`" 
                                                               x-model.number="item.weight" 
                                                               class="block w-full mt-1 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 py-2.5 text-base" 
                                                               required min="1">
                                                    </div>
                                                    <button type="button" @click="removeItem(sdgIndex, itemIndex)" x-show="sdgRubric.items.length > 1"
                                                            class="px-3 py-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 text-sm font-medium transition-colors">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                    <button type="button" @click="addItem(sdgIndex)" 
                                            class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-green-100 to-emerald-100 hover:from-green-200 hover:to-emerald-200 text-green-800 font-medium rounded-xl transition-all duration-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Tambah Indikator
                                    </button>
                                </div>
                            </template>
                        </div>

                        <!-- Tombol Tambah SDG -->
                        <div x-show="selectedProjectId" class="pt-4">
                            <button type="button" @click="addSdgRubric()" 
                                    x-bind:disabled="sdgRubrics.length >= availableSdgs.length && availableSdgs.length > 0"
                                    class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah SDG
                            </button>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('guru.rubrik.index') }}" 
                               class="inline-flex items-center justify-center px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50 group">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <x-primary-button class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Rubrik
                            </x-primary-button>
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
        window.initialSdgRubricsData = @json(old('sdgRubrics'));

        function sdgRubricForm(projects, oldProjectId) {
            return {
                projects: projects,
                selectedProjectId: oldProjectId || '',
                availableSdgs: [],
                sdgRubrics: [],

                init() {
                    let self = this;
                    $('#project_id').select2({ 
                        placeholder: '-- Pilih Proyek --',
                        width: '100%',
                        dropdownAutoWidth: true
                    })
                    .val(this.selectedProjectId).trigger('change')
                    .on('change', function(e) { self.selectedProjectId = $(this).val(); });

                    this.$watch('selectedProjectId', (newVal) => { this.updateAvailableSdgs(newVal); });
                    this.updateAvailableSdgs(this.selectedProjectId);

                    // Re-hidrasi data lama
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
                    this.$nextTick(() => {
                        $('.sdg-select').each(function(index) {
                            var el = $(this);
                            if (el.data('select2')) { el.select2('destroy'); }
                            el.select2({ 
                                placeholder: '-- Pilih SDG --',
                                width: '100%'
                            })
                            .val(self.sdgRubrics[index] ? self.sdgRubrics[index].sdg_id : null)
                            .on('change', (e) => {
                                if (self.sdgRubrics[index]) { self.sdgRubrics[index].sdg_id = e.target.value; }
                            });
                        });
                    });
                },

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

    <!-- CUSTOM ANIMATIONS -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulseSlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .animate-fade-in { animation: fadeIn 0.6s ease-out; }
        .animate-pulse-slow { animation: pulseSlow 1.5s infinite; }
    </style>
</x-app-layout>