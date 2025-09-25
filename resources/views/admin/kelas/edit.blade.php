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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Edit Kelas: ') . $kelas->name }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Perbarui informasi kelas dan wali kelas</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-2xl sm:rounded-3xl border border-green-200/50">
                <div class="p-6 md:p-8 text-gray-900">

                    <form method="POST" action="{{ route('admin.kelas.update', $kelas->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kelas -->
                        <div>
                            <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Nama Kelas
                            </label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $kelas->name) }}"
                                   class="w-full px-4 py-3.5 border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300"
                                   required autofocus />
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dropdown Wali Kelas (Dengan Preview Nama) -->
                        <div x-data="{ 
                            open: false, 
                            selected: {{ old('user_id', $kelas->user_id) ? (int) old('user_id', $kelas->user_id) : 'null' }},
                            gurus: @js($gurus->map(fn($g) => ['id' => $g->id, 'name' => $g->name])->values()),
                            getSelectedName() {
                                if (!this.selected) return '-- Pilih Wali Kelas --';
                                const guru = this.gurus.find(g => g.id === this.selected);
                                return guru ? guru.name : '-- Tidak ditemukan --';
                            }
                        }" @click.away="open = false" class="relative">
                            <label class="block text-sm font-medium text-green-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Wali Kelas
                            </label>
                            <div @click="open = !open"
                                 class="w-full px-4 py-3.5 bg-white border-2 border-green-200 rounded-xl flex items-center justify-between cursor-pointer transition-all duration-300 hover:border-green-400 focus:outline-none"
                                 :class="open ? 'border-green-500 ring-4 ring-green-500/20' : ''"
                                 required>
                                <span x-text="getSelectedName()" 
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
                                <template x-for="guru in gurus" :key="guru.id">
                                    <div @click="selected = guru.id; open = false"
                                         class="px-4 py-3 text-gray-900 cursor-pointer hover:bg-emerald-50 transition-colors flex items-center">
                                        <span x-text="guru.name"></span>
                                        <svg x-show="selected == guru.id" class="ml-auto w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </template>
                            </div>
                            <input type="hidden" name="user_id" :value="selected" required>
                            @error('user_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex flex-col sm:flex-row sm:items-center justify-end gap-4 pt-6 border-t border-green-200">
                            <a href="{{ route('admin.manajemen.index') }}"
                               class="inline-flex items-center justify-center px-6 py-3 text-green-600 hover:text-green-800 font-semibold rounded-xl border-2 border-green-300 hover:border-green-400 transition-all duration-300 hover:bg-green-50 group">
                                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Batal
                            </a>
                            <button type="submit"
                                    class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>