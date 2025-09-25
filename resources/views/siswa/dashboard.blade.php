<x-app-layout>
    <x-slot name="header">
        <div class="relative overflow-hidden bg-gradient-to-r from-green-600 via-green-700 to-emerald-600 rounded-2xl shadow-2xl">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-16 -mt-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white opacity-5 rounded-full -ml-12 -mb-12"></div>
            <div class="relative z-10 py-6 px-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm animate-pulse-slow">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-bold text-3xl text-white leading-tight animate-fade-in">
                            {{ __('Dashboard Siswa') }}
                        </h2>
                        <p class="text-green-100 text-sm mt-1 animate-fade-in delay-100">Selamat datang, {{ $user->name }}!</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48 animate-float"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40 animate-float animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Quick Access Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <a href="{{ route('siswa.proyek.index') }}" class="group block p-7 bg-gradient-to-br from-green-600 to-emerald-600 text-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden relative min-h-[200px]">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg">Daftar Proyek</h4>
                        </div>
                        <p class="text-sm opacity-90">Lihat semua proyek yang tersedia.</p>
                    </div>
                </a>

                <a href="{{ route('siswa.proyek.myProjects') }}" class="group block p-7 bg-gradient-to-br from-emerald-600 to-teal-600 text-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden relative min-h-[200px]">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg">Proyek Saya</h4>
                        </div>
                        <p class="text-sm opacity-90">Kelola proyek yang Anda ikuti.</p>
                    </div>
                </a>

                <a href="{{ route('siswa.lms.index') }}" class="group block p-7 bg-gradient-to-br from-green-500 to-emerald-500 text-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden relative min-h-[200px]">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg">Materi Belajar</h4>
                        </div>
                        <p class="text-sm opacity-90">Akses semua materi ajar.</p>
                    </div>
                </a>

                <a href="{{ route('siswa.lms.bookmarks') }}" class="group block p-7 bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden relative min-h-[200px]">
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -skew-x-12 transform -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <h4 class="font-bold text-lg">Bookmarks</h4>
                        </div>
                        <p class="text-sm opacity-90">Materi yang Anda simpan.</p>
                    </div>
                </a>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 mb-10">

                <!-- Active Projects -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-200/50 overflow-hidden hover:shadow-3xl transition-shadow duration-500 animate-fade-in-up min-h-[420px]">
                    <div class="p-7 border-b border-green-100">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            Proyek Aktif Saya
                        </h3>
                    </div>
                    <div class="h-96 overflow-y-auto p-7">
                        @forelse ($activeProjects as $enrollment)
                            <div class="mb-5 p-5 bg-white rounded-2xl border border-green-100 hover:border-green-300 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-fade-in-up">
                                <div class="font-bold text-gray-900 text-lg group-hover:text-green-700">{{ $enrollment->project->title }}</div>
                                <div class="text-sm text-gray-600 mt-2">Oleh: {{ $enrollment->project->teacher->name ?? 'N/A' }}</div>
                                <div class="flex flex-wrap items-center gap-3 mt-4">
                                    <span class="px-3.5 py-1.5 rounded-full text-xs font-medium
                                        @if($enrollment->status == 'approved') bg-green-100 text-green-800 @endif
                                        @if($enrollment->status == 'submitted') bg-emerald-100 text-emerald-800 @endif
                                        @if($enrollment->status == 'revision_needed') bg-amber-100 text-amber-800 @endif
                                    ">
                                        {{ Str::of($enrollment->status)->replace('_', ' ')->title() }}
                                    </span>
                                    @if ($enrollment->project->deadline)
                                        <span class="text-xs font-medium text-red-600 flex items-center gap-1.5">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($enrollment->project->deadline)->format('d M Y') }}
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('siswa.proyek.myProjects') }}" class="mt-4 inline-flex items-center text-sm text-green-600 font-medium hover:text-green-800 group">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1.5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @empty
                            <div class="text-center py-16 text-gray-500 animate-fade-in">
                                <div class="relative inline-block">
                                    <svg class="w-16 h-16 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <div class="absolute -top-1 -right-1 h-3 w-3 bg-green-400 rounded-full animate-ping"></div>
                                </div>
                                <p class="mt-5 font-medium text-lg">Tidak ada proyek aktif</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- LMS Progress -->
                <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-200/50 overflow-hidden hover:shadow-3xl transition-shadow duration-500 animate-fade-in-up delay-200 min-h-[420px]">
                    <div class="p-7 border-b border-green-100">
                        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            Progres Materi Belajar
                        </h3>
                    </div>
                    <div class="h-96 overflow-y-auto p-7">
                        @forelse ($userLmsProgress as $progress)
                            <div class="mb-7 animate-fade-in-up">
                                <div class="font-bold text-gray-900 text-lg mb-2">{{ $progress->title }}</div>
                                <div class="flex justify-between text-sm text-gray-600 mb-3">
                                    <span>{{ $progress->completed_count }} dari {{ $progress->total_count }} konten</span>
                                    <span class="font-bold text-green-600">{{ $progress->percentage }}%</span>
                                </div>
                                <div class="w-full bg-green-100 rounded-full h-3.5 overflow-hidden">
                                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-full rounded-full animate-fill-progress" style="width: {{ $progress->percentage }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-16 text-gray-500 animate-fade-in">
                                <div class="relative inline-block">
                                    <svg class="w-16 h-16 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <div class="absolute -top-1 -right-1 h-3 w-3 bg-green-400 rounded-full animate-ping"></div>
                                </div>
                                <p class="mt-5 font-medium text-lg">Belum mulai belajar</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Project Activity Chart -->
            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-green-200/50 overflow-hidden hover:shadow-3xl transition-shadow duration-500 animate-fade-in-up delay-300">
                <div class="p-6 border-b border-green-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-green-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        Aktivitas Proyek Saya
                    </h3>
                    <div class="relative">
                        <select id="month-filter" class="appearance-none bg-white/80 backdrop-blur-sm border-2 border-green-200 text-gray-800 py-2.5 pl-4 pr-10 rounded-xl focus:outline-none focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all shadow-sm">
                            @foreach($monthsList as $monthOption)
                                <option value="{{ $monthOption['month'] }}-{{ $monthOption['year'] }}"
                                    {{ $selectedMonth == $monthOption['month'] && $selectedYear == $monthOption['year'] ? 'selected' : '' }}>
                                    {{ $monthOption['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="p-7">
                    <canvas id="projectChart" class="w-full h-80"></canvas>
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
        @keyframes fillProgress { from { width: 0; } to { width: var(--target-width, 0%); } }
        .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s !important; }
        .delay-200 { animation-delay: 0.2s !important; }
        .delay-300 { animation-delay: 0.3s !important; }
        .animate-float { animation: float 8s ease-in-out infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animate-fill-progress {
            animation: fillProgress 1.2s ease-out forwards;
        }
        #projectChart {
            min-height: 200px;
            max-height: 300px;
            width: 100% !important;
        }
    </style>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script>
            document.getElementById('month-filter').addEventListener('change', function() {
                const [month, year] = this.value.split('-');
                window.location.href = `{{ route('siswa.dashboard') }}?month=${month}&year=${year}`;
            });

            const ctx = document.getElementById('projectChart').getContext('2d');

            @if(count($labels) > 0 && is_array($labels) && is_array($data))
                const radialGradient = ctx.createRadialGradient(200, 100, 0, 200, 100, 300);
                radialGradient.addColorStop(0, 'rgba(16, 185, 129, 0.9)');
                radialGradient.addColorStop(1, 'rgba(16, 185, 129, 0.1)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: @json($labels),
                        datasets: [{
                            label: 'Proyek Selesai',
                            data: @json($data),
                            backgroundColor: radialGradient,
                            borderColor: '#047857',
                            borderWidth: 3,
                            pointBackgroundColor: '#059669',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            fill: true,
                            tension: 0.4,
                            cubicInterpolationMode: 'monotone'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    color: '#1F2937',
                                    font: { size: 13, weight: 'bold' },
                                    padding: 20
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(255, 255, 255, 0.95)',
                                titleColor: '#047857',
                                bodyColor: '#1F2937',
                                borderColor: '#10B981',
                                borderWidth: 1,
                                padding: 16,
                                displayColors: false,
                                usePointStyle: true,
                                callbacks: {
                                    label: function(context) {
                                        return `✅ Proyek Selesai: ${context.raw}`;
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    color: '#6B7280',
                                    stepSize: 1,
                                    font: { size: 12 }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.05)'
                                },
                                title: {
                                    display: true,
                                    text: 'Jumlah Proyek',
                                    color: '#374151',
                                    font: { size: 13, weight: 'bold' }
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#6B7280',
                                    font: { size: 12 }
                                },
                                grid: {
                                    color: 'rgba(0, 0, 0, 0.03)'
                                },
                                title: {
                                    display: true,
                                    text: 'Hari dalam Bulan',
                                    color: '#374151',
                                    font: { size: 13, weight: 'bold' }
                                }
                            }
                        },
                        animation: {
                            duration: 2000,
                            easing: 'easeOutQuart'
                        }
                    }
                });
            @else
                ctx.font = '16px system-ui';
                ctx.fillStyle = '#9CA3AF';
                ctx.textAlign = 'center';
                ctx.fillText('Tidak ada data aktivitas proyek bulan ini', ctx.canvas.width / 2, ctx.canvas.height / 2);
            @endif
        </script>
    @endpush
</x-app-layout>