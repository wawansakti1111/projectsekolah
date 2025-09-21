<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Proyek: {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-4 gap-6">

            {{-- Kolom utama untuk detail dan form/status --}}
            <div class="lg:col-span-3 space-y-6">
                {{-- Detail Proyek --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-2xl font-bold">{{ $project->title }}</h3>
                        <p class="text-md text-gray-600 mt-1">Oleh: {{ $project->teacher->name ?? 'N/A' }}</p>
                        <p class="mt-1"><span class="font-semibold">Mata Pelajaran:</span> {{ $project->subject->name ?? 'N/A' }}</p>

                        @if($project->deadline)
                            <p class="text-sm text-red-600 mt-2"><span class="font-semibold">Deadline:</span> {{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}</p>
                        @endif

                        <div class="mt-6 border-t pt-4 prose max-w-none">
                            <p class="font-semibold">Deskripsi Proyek:</p>
                            {!! nl2br(e($project->description)) !!}
                        </div>

                        @if($project->attachment_path)
                        <div class="mt-6">
                            <h4 class="font-semibold">Materi Pendukung:</h4>
                            <a href="{{ asset('storage/' . $project->attachment_path) }}" target="_blank" class="text-blue-600 hover:underline">
                                Unduh Materi
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- START: EDITED SECTION --}}
                {{-- Logika untuk menampilkan form atau notifikasi status --}}

                @if(isset($enrollmentStatus) && $enrollmentStatus)

                    {{-- Jika pendaftaran ditolak --}}
                    @if($enrollmentStatus->status == 'rejected')
                    <div class="bg-red-50 border-l-4 border-red-400 p-6 shadow-sm sm:rounded-lg">
                        <div class="flex">
                            <div class="py-1"><svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                            <div>
                                <h3 class="text-lg font-semibold text-red-800">Pendaftaran Anda Ditolak</h3>
                                <p class="mt-1 text-red-700">Pendaftaran Anda untuk proyek ini sebelumnya telah ditolak. Silakan hubungi guru yang bersangkutan untuk informasi lebih lanjut.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Jika pendaftaran masih tertunda --}}
                    @if($enrollmentStatus->status == 'pending')
                    <div class="bg-blue-50 border-l-4 border-blue-400 p-6 shadow-sm sm:rounded-lg">
                        <div class="flex">
                             <div class="py-1"><svg class="h-6 w-6 text-blue-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                            <div>
                                <h3 class="text-lg font-semibold text-blue-800">Pendaftaran Terkirim</h3>
                                <p class="mt-1 text-blue-700">Anda sudah mendaftar untuk proyek ini. Harap tunggu persetujuan dari guru.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Jika pendaftaran sudah disetujui --}}
                    @if($enrollmentStatus->status == 'approved')
                    <div class="bg-emerald-50 border-l-4 border-emerald-400 p-6 shadow-sm sm:rounded-lg">
                        <div class="flex">
                            <div class="py-1"><svg class="h-6 w-6 text-emerald-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                            <div>
                                <h3 class="text-lg font-semibold text-emerald-800">Anda Sudah Terdaftar</h3>
                                <p class="mt-1 text-emerald-700">Anda telah disetujui dan terdaftar dalam proyek ini.</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @else

                        {{-- Jika belum mendaftar, tampilkan form --}}
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" x-data="{ members: @js(old('members', [])) }">
                            <div class="p-6 text-gray-900">
                                <h3 class="text-lg font-semibold border-b pb-2 mb-4">Form Pendaftaran Proyek</h3>
                                <form method="POST" action="{{ route('siswa.proyek.enroll', $project->id) }}">
                                    @csrf
                                    <div>
                                        <x-input-label for="group_name" :value="__('Nama Kelompok')" />
                                        <x-text-input id="group_name" class="block mt-1 w-full" type="text" name="group_name" :value="old('group_name', auth()->user()->name)" required />
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label value="Anggota Kelompok (Ketua tidak perlu diisi)" />

                                        <div class="space-y-2 mt-1">
                                            <template x-for="(member, index) in members" :key="index">
                                                <div class="flex items-center space-x-2 member-row">
                                                    <select :name="'members[' + index + ']'" class="select2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" x-model="members[index]" required>
                                                        <option value="" disabled selected>-- Pilih Anggota --</option>
                                                        @foreach ($activeStudents as $student)
                                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" @click="members.splice(index, 1)" class="text-red-500 hover:text-red-700">&times;</button>
                                                </div>
                                            </template>
                                        </div>

                                        <button type="button" @click="members.push(''); $nextTick(() => { $('.select2').select2(); })" id="add-member-btn" class="mt-2 text-sm text-blue-600 hover:text-blue-800">+ Tambah Anggota</button>
                                    </div>
                                    <div class="mt-4">
                                        <x-input-label for="reason_to_join" :value="__('Alasan Memilih Proyek Ini')" />
                                        <textarea name="reason_to_join" id="reason_to_join" rows="5" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('reason_to_join') }}</textarea>
                                    </div>
                                    <div class="mt-4">
                                        <x-primary-button class="w-full justify-center">Daftar Sekarang</x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                {{-- END: EDITED SECTION --}}
            </div>

            {{-- Sidebar untuk proyek lainnya --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Proyek Lainnya</h3>
                        <div class="space-y-4">
                            @forelse ($otherProjects as $otherProject)
                                <a href="{{ route('siswa.proyek.show', $otherProject->id) }}" class="block p-4 border rounded-md hover:bg-gray-50 transition">
                                    <p class="font-semibold text-gray-800">{{ $otherProject->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $otherProject->teacher->name }}</p>
                                </a>
                            @empty
                                <p class="text-sm text-center text-gray-500">
                                    Tidak ada proyek lainnya yang tersedia saat ini.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        $('.select2').select2();
        const status = "{{ session('status') }}";
        if (status) {
            Swal.fire({
                title: 'Informasi',
                text: status,
                icon: status.startsWith('Error') ? 'error' : 'success',
                confirmButtonText: 'OK'
            });
        }

        const errors = @json($errors->all());
        if (errors.length > 0) {
            const errorMessages = errors.join('<br>');
            Swal.fire({
                title: 'Validasi Gagal',
                html: errorMessages,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
    </script>
    @endpush
</x-app-layout>
