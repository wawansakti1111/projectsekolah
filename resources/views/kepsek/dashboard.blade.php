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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0H8v0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight">
                            {{ __('Dashboard Kepala Sekolah') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1">Ikhtisar kinerja sekolah dan proyek berbasis SDG</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Elemen dekoratif latar -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-cyan-100 rounded-full opacity-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            {{-- === KARTU STATISTIK UTAMA === --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/50 text-center transform transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl animate-fade-in-scale">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-green-100 to-emerald-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-green-700 uppercase tracking-wide">Total Siswa</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalSiswa }}</p>
                </div>

                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/50 text-center transform transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl animate-fade-in-scale delay-100">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-emerald-100 to-teal-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-emerald-700 uppercase tracking-wide">Total Guru</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalGuru }}</p>
                </div>

                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/50 text-center transform transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl animate-fade-in-scale delay-200">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-teal-100 to-cyan-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-teal-700 uppercase tracking-wide">Proyek Berjalan</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $proyekBerjalan }}</p>
                </div>

                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/50 text-center transform transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl animate-fade-in-scale delay-300">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-cyan-100 to-blue-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-8 h-8 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M9 11a2 2 0 114 0m-4 0V9a2 2 0 012-2m0 0V5a2 2 0 012-2m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-cyan-700 uppercase tracking-wide">Total Proyek</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalProyek }}</p>
                </div>
            </div>

            {{-- === STATISTIK PROYEK PER SDG – FULL WARNA RESMI PBB === --}}
            <div class="mb-12 animate-fade-in-up">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-100 to-emerald-100 rounded-xl flex items-center justify-center mr-3 shadow-sm">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Statistik Proyek per SDG</h3>
                </div>

                @if($sdgProjectCounts->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                        @foreach ($sdgProjectCounts as $sdg)
                            @php
                                $id = (int) $sdg->id;
                                $color = $officialSdgColors[$id] ?? '#6B7280';
                                $iconPath = asset("build/assets/{$id}.png");
                            @endphp

                            <div class="rounded-2xl overflow-hidden shadow-lg transform transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl animate-fade-in-scale group"
                                 style="animation-delay: {{ ($loop->index + 4) * 100 }}ms; background-color: {{ $color }};">
                                <div class="p-5 text-white">
                                    <div class="flex justify-center mb-3">
                                        <img 
                                            src="{{ $iconPath }}" 
                                            alt="SDG {{ $id }}" 
                                            class="w-16 h-16 object-contain drop-shadow-md transition-transform duration-300 group-hover:scale-110"
                                            onerror="this.style.display='none'"
                                        >
                                    </div>
                                    <h4 class="text-sm font-bold text-center mb-2 leading-tight opacity-95">
                                        {{ \Illuminate\Support\Str::limit($sdg->name, 36) }}
                                    </h4>
                                    <div class="mt-3 pt-3 border-t border-white/20">
                                        <p class="text-2xl font-extrabold text-white text-center">
                                            {{ $sdg->projects_count }}
                                        </p>
                                        <p class="text-xs opacity-90 text-center mt-1">Proyek Terkait</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl border border-green-200/50 p-12 text-center animate-fade-in-up">
                        <div class="inline-flex w-20 h-20 bg-green-100 rounded-full items-center justify-center mb-5">
                            <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-medium text-gray-600">Belum Ada Data SDG</h4>
                        <p class="text-gray-500 mt-2">Tidak ada proyek yang dikaitkan dengan SDG saat ini.</p>
                    </div>
                @endif
            </div>

            {{-- === KONTEN UTAMA (GRAFIK & TABEL) === --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in-up" style="animation-delay: 0.5s;">

                {{-- KOLOM KIRI (LEBIH LEBAR) --}}
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/30 transform transition-all hover:shadow-2xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Distribusi Proyek per SDG</h3>
                        <div class="h-96"><canvas id="sdgProjectsChart"></canvas></div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/30 transform transition-all hover:shadow-2xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">5 Proyek Terbaru</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50/70">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nama Proyek</th>
                                        <th scope="col" class="px-6 py-3">SDG Terkait</th>
                                        <th scope="col" class="px-6 py-3">Dibuat Oleh</th>
                                        <th scope="col" class="px-6 py-3">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200/50">
                                    @forelse($latestProjects as $project)
                                    <tr class="hover:bg-green-50/50 transition-colors">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $project->title }}</th>
                                        <td class="px-6 py-4">
                                            @if($project->sdgs->isNotEmpty())
                                                @php $firstSdg = $project->sdgs->first(); @endphp
                                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full text-white"
                                                      style="background-color: {{ $officialSdgColors[$firstSdg->id] ?? '#E5243B' }};">
                                                    {{ $firstSdg->name }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">{{ $project->teacher->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $project->created_at->format('d M Y') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada proyek yang dibuat.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (LEBIH SEMPIT) --}}
                <div class="space-y-8">
                    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/30 transform transition-all hover:shadow-2xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Status Penyelesaian Proyek</h3>
                        <div class="h-64 relative">
                            <canvas id="projectStatusChart"></canvas>
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <div class="text-center">
                                    <p class="text-4xl font-bold text-green-600">{{ $completionPercentage }}%</p>
                                    <p class="text-sm text-gray-500">Selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/30 transform transition-all hover:shadow-2xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">5 Kelas Teraktif</h3>
                        <ul class="space-y-3">
                            @forelse($activeClasses as $class)
                            <li class="flex justify-between items-center text-sm p-3 bg-gray-50/50 rounded-lg hover:bg-green-50/50 transition-colors">
                                <span class="font-medium text-gray-700">{{ $class->name }}</span>
                                <span class="font-bold text-gray-900">{{ $class->submission_count }} Submissions</span>
                            </li>
                            @empty
                            <li class="text-sm text-gray-500 text-center py-4">Belum ada aktivitas kelas.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="bg-white/80 backdrop-blur-xl p-6 rounded-3xl shadow-xl border border-green-200/30 transform transition-all hover:shadow-2xl">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Rata-rata Skor SDG per Kelas</h3>
                        <ul class="space-y-3">
                            @forelse($classSdgScores as $score)
                            <li class="flex justify-between items-center text-sm p-3 bg-gray-50/50 rounded-lg hover:bg-blue-50/50 transition-colors">
                                <span class="font-medium text-gray-700">{{ $score->name }}</span>
                                <span class="font-bold text-blue-600">{{ number_format($score->average_score, 1) }}</span>
                            </li>
                            @empty
                            <li class="text-sm text-gray-500 text-center py-4">Belum ada skor yang tercatat.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.92) translateY(10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-scale {
            animation: fadeInScale 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
            opacity: 0;
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Grafik Batang Proyek per SDG – DENGAN WARNA RESMI PBB
        const sdgCtx = document.getElementById('sdgProjectsChart').getContext('2d');
        new Chart(sdgCtx, {
            type: 'bar',
            data: {
                labels: @json($sdgChartLabels),
                datasets: [{
                    label: 'Jumlah Proyek',
                    data: @json($sdgChartData),
                    backgroundColor: @json($sdgColors),
                    borderColor: @json($sdgColors),
                    borderWidth: 1,
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { size: 12, weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true, 
                        ticks: { 
                            precision: 0,
                            color: '#64748B',
                            font: { size: 11 }
                        },
                        grid: { color: 'rgba(0,0,0,0.03)' }
                    },
                    x: { 
                        ticks: { 
                            autoSkip: false, 
                            maxRotation: 45, 
                            minRotation: 45,
                            color: '#475569',
                            font: { size: 10 }
                        },
                        grid: { display: false }
                    }
                }
            }
        });

        // 2. Grafik Donat Status Proyek
        const statusCtx = document.getElementById('projectStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Berjalan'],
                datasets: [{
                    data: @json($projectStatusData),
                    backgroundColor: ['#10B981', '#34D399'],
                    borderWidth: 0,
                    hoverBorderColor: '#fff',
                    hoverBorderWidth: 3,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 14,
                            padding: 16,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: {
                                size: 12,
                                family: 'system-ui, sans-serif'
                            },
                            color: '#475569'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { size: 12, weight: '600' },
                        bodyFont: { size: 12 },
                        padding: 10,
                        cornerRadius: 8,
                    }
                },
                animation: {
                    animateRotate: true,
                    duration: 1200,
                    easing: 'easeOutQuart'
                }
            }
        });
    });
    </script>
    @endpush
</x-app-layout>