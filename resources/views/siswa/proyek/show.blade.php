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
                        <h2 class="font-extrabold text-3xl md:text-4xl text-white leading-tight tracking-tight">
                            Detail Proyek: {{ $project->title }}
                        </h2>
                        <p class="text-green-100 text-base mt-1 font-medium">Jelajahi detail dan daftarkan diri Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-8 md:py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50 min-h-screen relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full opacity-20 -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-emerald-100 rounded-full opacity-20 translate-x-40 translate-y-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                {{-- Kolom utama --}}
                <div class="lg:col-span-3 space-y-8">

                    {{-- Detail Proyek --}}
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-3xl border border-green-200/40">
                        <div class="p-6 md:p-8 text-gray-900">
                            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                            <p class="text-lg text-green-700 font-medium">Oleh: {{ $project->teacher->name ?? 'N/A' }}</p>
                            <p class="mt-2 text-gray-700"><span class="font-semibold text-green-800">Mata Pelajaran:</span> {{ $project->subject->name ?? 'N/A' }}</p>

                            @if($project->deadline)
                                <div class="mt-4 flex items-center text-red-600 bg-red-50/70 px-3 py-2 rounded-lg inline-flex gap-2">
                                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-medium">Deadline:</span>
                                    <span>{{ \Carbon\Carbon::parse($project->deadline)->format('d F Y') }}</span>
                                </div>
                            @endif

                            <div class="mt-8 pt-6 border-t border-green-200/30">
                                <h4 class="text-xl font-bold text-green-800 mb-3">Deskripsi Proyek</h4>
                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($project->description)) !!}
                                </div>
                            </div>

                            @if($project->attachment_path)
                                <div class="mt-8 pt-6 border-t border-green-200/30">
                                    <h4 class="text-xl font-bold text-green-800 mb-3">Materi Pendukung</h4>
                                    <a href="{{ asset('storage/' . $project->attachment_path) }}" target="_blank"
                                       class="inline-flex items-center gap-2.5 px-5 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-300 group">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Unduh Materi Proyek
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Status atau Form --}}
                    @if(isset($enrollmentStatus) && $enrollmentStatus)
                        @if($enrollmentStatus->status == 'rejected')
                            <div class="bg-red-50/80 backdrop-blur-sm border border-red-200/50 rounded-2xl p-6 shadow-lg animate-fadeInUp">
                                <div class="flex">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-bold text-red-800">Pendaftaran Ditolak</h3>
                                        <p class="mt-2 text-red-700 leading-relaxed">Pendaftaran Anda untuk proyek ini sebelumnya telah ditolak. Silakan hubungi guru yang bersangkutan untuk informasi lebih lanjut.</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($enrollmentStatus->status == 'pending')
                            <div class="bg-blue-50/80 backdrop-blur-sm border border-blue-200/50 rounded-2xl p-6 shadow-lg animate-fadeInUp">
                                <div class="flex">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-bold text-blue-800">Menunggu Persetujuan</h3>
                                        <p class="mt-2 text-blue-700 leading-relaxed">Pendaftaran Anda sedang diproses. Harap tunggu konfirmasi dari guru.</p>
                                    </div>
                                </div>
                            </div>
                        @elseif($enrollmentStatus->status == 'approved')
                            <div class="bg-emerald-50/80 backdrop-blur-sm border border-emerald-200/50 rounded-2xl p-6 shadow-lg animate-fadeInUp">
                                <div class="flex">
                                    <div class="flex-shrink-0 mt-0.5">
                                        <svg class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-xl font-bold text-emerald-800">Anda Sudah Terdaftar!</h3>
                                        <p class="mt-2 text-emerald-700 leading-relaxed">Anda telah resmi terdaftar dalam proyek ini. Lanjutkan ke tahap pengumpulan hasil proyek.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-3xl border border-green-200/40" x-data="{ members: @js(old('members', [])) }">
                            <div class="p-6 md:p-8 text-gray-900">
                                <h3 class="text-2xl font-bold text-green-800 mb-6">Form Pendaftaran Proyek</h3>
                                <form method="POST" action="{{ route('siswa.proyek.enroll', $project->id) }}" class="space-y-6">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-800 mb-2">Nama Kelompok</label>
                                        <input type="text"
                                               name="group_name"
                                               value="{{ old('group_name', auth()->user()->name) }}"
                                               required
                                               class="w-full px-5 py-3.5 text-base border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 outline-none">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-800 mb-3">Anggota Kelompok <span class="text-gray-500">(Ketua tidak perlu diisi)</span></label>
                                        <div class="space-y-4">
                                            <template x-for="(member, index) in members" :key="index">
                                                <div class="flex items-center gap-3">
                                                    <select :name="'members[' + index + ']'" class="flex-grow block w-full px-5 py-3.5 text-base border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all">
                                                        <option value="" disabled selected>-- Pilih Anggota --</option>
                                                        @foreach ($activeStudents as $student)
                                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="button" @click="members.splice(index, 1)"
                                                            class="w-11 h-11 flex items-center justify-center text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 rounded-xl transition-colors shadow-sm">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </template>
                                        </div>
                                        <button type="button"
                                                @click="members.push('')"
                                                class="mt-3 inline-flex items-center gap-2 text-green-700 font-semibold hover:text-green-900 group">
                                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Tambah Anggota
                                        </button>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-gray-800 mb-2">Alasan Memilih Proyek Ini</label>
                                        <textarea name="reason_to_join"
                                                  rows="4"
                                                  class="w-full px-5 py-3.5 text-base border-2 border-green-200 rounded-xl focus:border-green-500 focus:ring-4 focus:ring-green-500/20 transition-all duration-300 outline-none">{{ old('reason_to_join') }}</textarea>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit"
                                                class="w-full inline-flex items-center justify-center gap-2.5 px-6 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold text-lg rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-[1.02]">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                            Daftar Sekarang
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white/80 backdrop-blur-xl overflow-hidden shadow-xl sm:rounded-3xl border border-green-200/40">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-xl font-bold text-green-800 mb-5 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M9 11a2 2 0 11-4 0 2 2 0 014 0zm0 0v-2a2 2 0 012-2m-2 2H5" />
                                </svg>
                                Proyek Lainnya
                            </h3>
                            <div class="space-y-4">
                                @forelse ($otherProjects as $otherProject)
                                    <a href="{{ route('siswa.proyek.show', $otherProject->id) }}"
                                       class="block p-4 rounded-xl border border-green-200/30 hover:bg-green-50/80 transition-all duration-200 group">
                                        <p class="font-bold text-gray-900 group-hover:text-green-800 text-base leading-tight">
                                            {{ $otherProject->title }}
                                        </p>
                                        <p class="text-sm text-green-700 mt-1">{{ $otherProject->teacher->name }}</p>
                                    </a>
                                @empty
                                    <p class="text-sm text-center text-gray-500 italic py-4">
                                        Tidak ada proyek lain tersedia.
                                    </p>
                                @endforelse
                            </div>
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
            if (typeof $ !== 'undefined' && $('.select2').length) {
                $('.select2').select2();
            }

            const status = "{{ session('status') }}";
            if (status) {
                Swal.fire({
                    title: 'Informasi',
                    text: status,
                    icon: status.toLowerCase().includes('error') ? 'error' : 'success',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-2xl',
                        title: 'font-bold text-lg'
                    }
                });
            }

            const errors = @json($errors->all());
            if (errors.length > 0) {
                Swal.fire({
                    title: 'Validasi Gagal',
                    html: errors.join('<br>'),
                    icon: 'error',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-2xl',
                        title: 'font-bold text-lg'
                    }
                });
            }
        });
    </script>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.4s ease-out forwards;
        }

        /* Tipografi premium */
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .prose {
            font-size: 1.0625rem; /* ~17px */
            line-height: 1.7;
        }
        .prose :where(p):not(:where([class~="not-prose"] *)) {
            margin-bottom: 1.125em;
            color: #374151;
        }
    </style>
    @endpush
</x-app-layout>