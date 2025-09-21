<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Analitik Materi Ajar (LMS)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @forelse ($analyticsData as $data)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">{{ $data['material']->title }}</h2>
                            <p class="mt-1 text-sm text-gray-600">
                                Total {{ $data['total_contents'] }} konten. Berikut adalah progress siswa:
                            </p>
                        </header>

                        <div class="mt-6 overflow-x-auto">
                            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-2 font-medium text-left text-gray-900">Nama Siswa</th>
                                        <th class="px-4 py-2 font-medium text-left text-gray-900">Progress</th>
                                        <th class="px-4 py-2 font-medium text-left text-gray-900">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($data['progress_by_siswa'] as $siswaId => $progress)
                                        @php
                                            $percentage = ($progress['completed_count'] / $data['total_contents']) * 100;
                                        @endphp
                                        <tr>
                                            <td class="px-4 py-2 font-medium text-gray-900">{{ $progress['name'] }}</td>
                                            <td class="px-4 py-2 text-gray-700">
                                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-2 text-gray-700">
                                                {{ $progress['completed_count'] }} / {{ $data['total_contents'] }}
                                                <span class="font-semibold">({{ round($percentage) }}%)</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-gray-500 py-4">
                                                Belum ada siswa yang memulai materi ini.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            @empty
                <div class="p-6 bg-white text-center text-gray-500 shadow-sm sm:rounded-lg">
                    Anda belum membuat materi ajar atau belum ada progress dari siswa.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
