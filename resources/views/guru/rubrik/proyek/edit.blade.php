<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Edit Rubrik Proyek') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Perbarui rubrik penilaian proyek yang sudah ada</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <form method="POST" action="{{ route('guru.rubrik.proyek.update', $rubric->id) }}" 
                          x-data="{ items: @js($rubric->items) }" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Dropdown Proyek Modern -->
                        <div x-data="{ open: false, selected: @js(old('project_id', $rubric->project_id)), projects: @js($projects) }"
                             @click.away="open = false"
                             class="relative">
                            <label class="block text-sm font-medium text-green-800 mb-2">Pilih Proyek</label>
                            <div @click="open = !open"
                                 class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                                 :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''">
                                <span x-text="selected ? projects.find(p => p.id == selected)?.title : '-- Pilih Proyek --'"
                                      :class="selected ? 'text-gray-900' : 'text-gray-500'"></span>
                                <svg class="w-5 h-5 text-green-600 transition-transform duration-300"
                                     :class="open ? 'rotate-180' : ''"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>

                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute z-10 mt-1 w-full bg-white border-2 border-green-200 rounded-xl shadow-lg max-h-60 overflow-auto">
                                <template x-for="project in projects" :key="project.id">
                                    <div @click="selected = project.id; open = false"
                                         @mouseenter="this.style.backgroundColor = '#ecfdf5'"
                                         @mouseleave="this.style.backgroundColor = 'white'"
                                         class="px-4 py-3 text-gray-900 cursor-pointer hover:bg-emerald-50 transition-colors flex items-center">
                                        <span x-text="project.title"></span>
                                        <svg x-show="selected == project.id" class="ml-auto w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </template>
                                <div x-show="projects.length === 0" class="px-4 py-3 text-gray-500 italic">
                                    Tidak ada proyek tersedia
                                </div>
                            </div>

                            <input type="hidden" name="project_id" x-model="selected" required>
                            <x-input-error :messages="$errors->get('project_id')" class="mt-2 text-red-600 text-sm" />
                        </div>

                        <hr class="my-6 border-green-200/50">

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <h3 class="text-lg font-bold text-green-800">Indikator Penilaian Proyek</h3>
                            <div class="text-sm font-bold">
                                Total Bobot: 
                                <span x-text="items.reduce((sum, item) => sum + Number(item.weight || 0), 0)"
                                      :class="items.reduce((sum, item) => sum + Number(item.weight || 0), 0) !== 100 ? 'text-red-600' : 'text-green-600'">
                                </span>%
                            </div>
                        </div>

                        <!-- Alert Error -->
                        @if($errors->any())
                            <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm font-medium flex items-start animate-fadeInUp">
                                <svg class="w-5 h-5 text-red-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="space-y-4 mt-4">
                            <template x-for="(item, index) in items" :key="item.id">
                                <div class="flex flex-col sm:flex-row sm:items-end gap-4 p-4 rounded-2xl border-2 border-green-200/60 bg-white/70 backdrop-blur-sm">
                                    <div class="flex-grow">
                                        <label :for="'item-name-' + index" class="block text-sm font-medium text-green-800 mb-2">Nama Indikator</label>
                                        <input type="text"
                                               :name="'items[' + index + '][name]'"
                                               x-model="item.name"
                                               class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                               required>
                                    </div>
                                    <div class="w-full sm:w-1/4">
                                        <label :for="'item-weight-' + index" class="block text-sm font-medium text-green-800 mb-2">Bobot (%)</label>
                                        <input type="number"
                                               :name="'items[' + index + '][weight]'"
                                               x-model.number="item.weight"
                                               min="1" max="100"
                                               class="w-full px-4 py-3 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                               required>
                                    </div>
                                    <button type="button"
                                            @click="items.splice(index, 1)"
                                            x-show="items.length > 1"
                                            class="mt-6 sm:mt-0 w-10 h-10 flex items-center justify-center text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 rounded-xl transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>

                        <button type="button"
                                @click="items.push({ name: '', weight: 1 })"
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-green-700 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 hover:bg-green-50 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Indikator
                        </button>

                        <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-4 pt-6 border-t border-green-200/50">
                            <a href="{{ route('guru.rubrik.index') }}"
                               class="inline-flex items-center justify-center px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50 group">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Update Rubrik
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alert = document.querySelector('.animate-fadeInUp');
            if (alert) {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    alert.style.opacity = '1';
                    alert.style.transform = 'translateY(0)';
                }, 100);
            }
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.3s ease forwards;
        }
    </style>
    @endpush
</x-app-layout>