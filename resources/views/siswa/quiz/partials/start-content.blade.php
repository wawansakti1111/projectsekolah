<div class="text-center">
    <h3 class="text-2xl font-bold text-gray-800">Selamat Datang di Kuis: {{ $quiz->title }}</h3>
    @if($quiz->description)
        <p class="mt-2 text-lg text-gray-600">{{ $quiz->description }}</p>
    @endif

    <hr class="my-6">

    {{-- Informasi Detail Kuis --}}
    <div class="max-w-2xl mx-auto text-left">
        <div class="space-y-3">
            <div class="flex justify-between items-center p-4 border border-gray-200 rounded-lg">
                <span class="font-medium text-gray-700">Jumlah Soal:</span>
                <span class="px-3 py-1 text-sm font-semibold text-white bg-blue-500 rounded-full">{{ $quiz->questions()->count() }}</span>
            </div>
            <div class="flex justify-between items-center p-4 border border-gray-200 rounded-lg">
                <span class="font-medium text-gray-700">Durasi Pengerjaan:</span>
                <span class="px-3 py-1 text-sm font-semibold text-white bg-teal-500 rounded-full">{{ $quiz->duration > 0 ? $quiz->duration . ' Menit' : 'Tidak Terbatas' }}</span>
            </div>
            <div class="flex justify-between items-center p-4 border border-gray-200 rounded-lg">
                <span class="font-medium text-gray-700">Kesempatan:</span>
                <span class="px-3 py-1 text-sm font-semibold text-white bg-gray-500 rounded-full">{{ $quiz->allow_multiple_attempts ? 'Bisa diulang' : 'Hanya 1 Kali' }}</span>
            </div>
        </div>
    </div>

    {{-- Pesan Riwayat Pengerjaan --}}
    @if($attempt && $attempt->score !== null)
        <div class="mt-6 p-4 bg-yellow-100 border-l-4 border-yellow-400 text-yellow-700">
            <p>Anda sudah pernah mengerjakan kuis ini pada {{ $attempt->updated_at->format('d M Y H:i') }} dengan skor <strong>{{ number_format($attempt->score, 2) }}</strong>.</p>
        </div>
    @endif

    {{-- Tombol Aksi --}}
    <div class="mt-8">
        @if($canAttempt)
            <a href="{{ route('siswa.lms.content.show', ['lmsContent' => $lmsContent->id, 'action' => 'take']) }}"
               class="inline-flex items-center justify-center px-8 py-4 bg-green-600 border border-transparent rounded-md font-semibold text-lg text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span>
                    @if($attempt && $attempt->score !== null)
                        Kerjakan Ulang
                    @else
                        Mulai Kerjakan
                    @endif
                </span>
            </a>
        @else
            <div class="mt-6 p-4 bg-red-500 text-white rounded-md font-medium">
                Anda sudah tidak memiliki kesempatan untuk mengerjakan kuis ini.
            </div>
        @endif
    </div>
</div>
