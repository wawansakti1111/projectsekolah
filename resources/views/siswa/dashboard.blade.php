<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Siswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-medium text-gray-900">Selamat Datang, {{ $user->name }}!</h3>
                <p class="mt-1 text-sm text-gray-600">Gunakan akses cepat di bawah untuk memulai.</p>
            </div>

            {{-- ▼▼▼ KARTU TOMBOL AKSES CEPAT ▼▼▼ --}}
            <div class="mt-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <a href="{{ route('siswa.proyek.index') }}" class="block p-6 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                        <h4 class="font-semibold text-lg">Daftar Proyek</h4>
                        <p class="text-sm opacity-90 mt-1">Lihat semua proyek yang tersedia.</p>
                    </a>
                    <a href="{{ route('siswa.proyek.myProjects') }}" class="block p-6 bg-emerald-600 text-white rounded-lg shadow-md hover:bg-emerald-700 transition">
                        <h4 class="font-semibold text-lg">Proyek Saya</h4>
                        <p class="text-sm opacity-90 mt-1">Lihat dan kelola proyek yang Anda ikuti.</p>
                    </a>
                    <a href="{{ route('siswa.lms.index') }}" class="block p-6 bg-purple-600 text-white rounded-lg shadow-md hover:bg-purple-700 transition">
                        <h4 class="font-semibold text-lg">Materi Belajar</h4>
                        <p class="text-sm opacity-90 mt-1">Akses semua materi ajar yang tersedia.</p>
                    </a>
                    <a href="{{ route('siswa.lms.bookmarks') }}" class="block p-6 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700 transition">
                        <h4 class="font-semibold text-lg">Bookmarks Materi</h4>
                        <p class="text-sm opacity-90 mt-1">Akses materi yang Anda simpan.</p>
                    </a>
                </div>
            </div>
            {{-- ▲▲▲ AKHIR KARTU AKSES CEPAT ▲▲▲ --}}

            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-8">
                {{-- ▼▼▼ KARTU PROYEK AKTIF SAYA (SCROLLABLE) ▼▼▼ --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Proyek Aktif Saya</h3>
                    <div class="space-y-4 h-80 overflow-y-auto pr-2">
                        @forelse ($activeProjects as $enrollment)
                            <div class="p-6 bg-white shadow-sm sm:rounded-lg flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $enrollment->project->title }}</p>
                                    <p class="text-sm text-gray-500">Oleh: {{ $enrollment->project->teacher->name ?? 'N/A' }}</p>
                                    <div class="flex items-center gap-4 mt-2">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium
                                            @if($enrollment->status == 'approved') bg-blue-100 text-blue-800 @endif
                                            @if($enrollment->status == 'submitted') bg-emerald-100 text-emerald-800 @endif
                                            @if($enrollment->status == 'revision_needed') bg-amber-100 text-amber-800 @endif
                                        ">
                                            {{ Str::of($enrollment->status)->replace('_', ' ')->title() }}
                                        </span>
                                        @if ($enrollment->project->deadline)
                                            <span class="text-xs text-red-600 font-medium">
                                                Deadline: {{ \Carbon\Carbon::parse($enrollment->project->deadline)->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('siswa.proyek.myProjects') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 bg-white text-center text-gray-500 shadow-sm sm:rounded-lg">
                                Anda tidak memiliki proyek yang sedang aktif.
                            </div>
                        @endforelse
                    </div>
                </div>
                {{-- ▲▲▲ AKHIR KARTU PROYEK AKTIF ▲▲▲ --}}

            {{-- KARTU PROGRESS LMS --}}
            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-4">Progres Materi Belajar</h3>
                <div class="space-y-4 h-80 overflow-y-auto pr-2">
                    @forelse ($userLmsProgress as $progress)
                        <div class="block p-4 bg-white shadow-sm sm:rounded-lg">
                            <div class="font-semibold text-gray-800">{{ $progress->title }}</div>
                            <div class="text-sm text-gray-500 mt-1">
                                Progress: {{ $progress->completed_count }} dari {{ $progress->total_count }} konten
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $progress->percentage }}%;"></div>
                                </div>
                                <span class="text-sm text-gray-600">{{ $progress->percentage }}%</span>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 bg-white text-center text-gray-500 shadow-sm sm:rounded-lg">
                            Anda belum memulai materi belajar apa pun.
                        </div>
                    @endforelse
                </div>
            </div>

            </div>

            {{-- ▼▼▼ GRAFIK AKTIVITAS PROYEK YANG DIPERECIL ▼▼▼ --}}
            <div class="mt-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Aktivitas Proyek Saya</h3>
                    <select id="month-filter" class="form-select rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach($monthsList as $monthOption)
                            <option value="{{ $monthOption['month'] }}-{{ $monthOption['year'] }}"
                                {{ $selectedMonth == $monthOption['month'] && $selectedYear == $monthOption['year'] ? 'selected' : '' }}>
                                {{ $monthOption['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <canvas id="projectChart" class="max-h-64"></canvas>
                </div>
            </div>
            {{-- ▲▲▲ AKHIR GRAFIK ▲▲▲ --}}

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.getElementById('month-filter').addEventListener('change', function() {
                const [month, year] = this.value.split('-');
                window.location.href = `{{ route('siswa.dashboard') }}?month=${month}&year=${year}`;
            });

            const ctx = document.getElementById('projectChart');
            const projectData = {
                labels: @json($labels),
                datasets: [{
                    label: 'Proyek Selesai',
                    data: @json($data),
                    backgroundColor: 'rgba(59, 130, 246, 0.5)',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1
                }]
            };

            new Chart(ctx, {
                type: 'bar',
                data: projectData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Proyek'
                            },
                            ticks: {
                                stepSize: 1
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Hari dalam Bulan'
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Proyek Selesai: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>
