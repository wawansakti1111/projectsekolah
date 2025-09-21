<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dasbor Guru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h3 class="text-lg font-medium text-gray-900">Selamat Datang, {{ Auth::user()->name }}!</h3>
                <p class="mt-1 text-sm text-gray-600">Akses cepat di bawah akan membantu Anda mengelola tugas.</p>
            </div>

            {{-- Kartu Tombol Akses Cepat Guru --}}
            <div class="mt-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <a href="{{ route('guru.proyek.index') }}" class="block p-6 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">
                        <h4 class="font-semibold text-lg">Proyek Saya</h4>
                        <p class="text-sm opacity-90 mt-1">Kelola proyek yang Anda buat.</p>
                    </a>
                    <a href="{{ route('guru.proyek.index') }}" class="block p-6 bg-emerald-600 text-white rounded-lg shadow-md hover:bg-emerald-700 transition">
                        <h4 class="font-semibold text-lg">Penilaian Proyek</h4>
                        <p class="text-sm opacity-90 mt-1">Nilai pengajuan proyek siswa.</p>
                    </a>
                    <a href="{{ route('guru.lms.index') }}" class="block p-6 bg-purple-600 text-white rounded-lg shadow-md hover:bg-purple-700 transition">
                        <h4 class="font-semibold text-lg">Materi LMS</h4>
                        <p class="text-sm opacity-90 mt-1">Kelola materi ajar Anda.</p>
                    </a>
                    <a href="{{ route('guru.quiz.index') }}" class="block p-6 bg-yellow-600 text-white rounded-lg shadow-md hover:bg-yellow-700 transition">
                        <h4 class="font-semibold text-lg">Daftar Kuis</h4>
                        <p class="text-sm opacity-90 mt-1">Buat dan kelola kuis.</p>
                    </a>
                </div>
            </div>


            {{-- DAFTAR PROYEK AKTIF DENGAN NOTIFIKASI SUBMISSION BARU --}}
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Proyek Aktif Saya</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($activeProjects as $project)
                        <a href="{{ route('guru.proyek.show', $project) }}" class="relative block bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-gray-50 transition">
                            <h4 class="font-semibold text-lg text-gray-800">{{ $project->title }}</h4>
                            @if($project->deadline)
                                <p class="text-sm text-red-600 mt-1">Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}</p>
                            @else
                                <p class="text-sm text-gray-500 mt-1">Tidak ada tenggat waktu</p>
                            @endif
                            <p class="text-sm text-gray-600 mt-3">{{ $project->enrollments_count }} Siswa Terdaftar</p>

                            {{-- Notifikasi Submission Baru --}}
                            @if($project->new_submissions_count > 0)
                                <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    {{ $project->new_submissions_count }} Pengajuan Baru
                                </div>
                            @endif
                        </a>
                    @empty
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                            <p class="text-center text-gray-500">Anda belum memiliki proyek aktif.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            {{-- AKHIR DAFTAR PROYEK AKTIF --}}

        </div>
    </div>
</x-app-layout>
