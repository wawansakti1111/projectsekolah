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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-extrabold text-3xl md:text-4xl text-white leading-tight tracking-tight">
                            {{ __('Analitik Materi Ajar (LMS)') }}
                        </h2>
                        <p class="text-green-100 text-base mt-1 font-medium">Pantau perkembangan siswa dalam menyelesaikan materi</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-8">

            @forelse ($analyticsData as $data)
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 overflow-hidden animate-fadeInUp hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6 md:p-7">
                        <header class="mb-6">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M9 11a2 2 0 11-4 0 2 2 0 014 0zm0 0v-2a2 2 0 012-2m-2 2H5" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900 leading-tight">{{ $data['material']->title }}</h2>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Total <span class="font-semibold text-green-700">{{ $data['total_contents'] }}</span> konten • Progress siswa
                                    </p>
                                </div>
                            </div>
                        </header>

                        <div class="overflow-x-auto -mx-2 px-2">
                            <table class="min-w-full text-sm">
                                <thead>
                                    <tr class="text-left text-xs font-semibold text-green-800 uppercase tracking-wider">
                                        <th class="py-3 px-4">Nama Siswa</th>
                                        <th class="py-3 px-4">Progress</th>
                                        <th class="py-3 px-4 text-right">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @forelse ($data['progress_by_siswa'] as $siswaId => $progress)
                                        @php
                                            $percentage = ($progress['completed_count'] / max($data['total_contents'], 1)) * 100;
                                        @endphp
                                        <tr class="hover:bg-green-50/40 transition-colors group">
                                            <td class="py-4 px-4 font-medium text-gray-900 group-hover:text-green-800">
                                                {{ $progress['name'] }}
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="w-full bg-gray-200 rounded-full h-2">
                                                    <div 
                                                        class="bg-gradient-to-r from-emerald-500 to-teal-500 h-full rounded-full transition-all duration-700 ease-out"
                                                        style="width: {{ round($percentage) }}%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                <span class="inline-flex items-center gap-1 font-medium">
                                                    <span class="text-gray-700">{{ $progress['completed_count'] }}/{{ $data['total_contents'] }}</span>
                                                    <span class="text-emerald-700">({{ round($percentage) }}%)</span>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-10 px-4 text-center">
                                                <div class="flex flex-col items-center justify-center gap-3 text-gray-500">
                                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <p class="text-sm font-medium">Belum ada siswa yang memulai materi ini.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg border border-green-100 p-10 text-center animate-fadeInUp">
                    <div class="max-w-md mx-auto">
                        <div class="w-16 h-16 mx-auto bg-green-50 rounded-full flex items-center justify-center mb-5">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Data Analitik</h3>
                        <p class="text-gray-600 max-w-prose">
                            Anda belum membuat materi ajar atau belum ada progress dari siswa.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>
    </div>

    @push('scripts')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        /* Gunakan Figtree sesuai layout Anda */
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
    @endpush
</x-app-layout>