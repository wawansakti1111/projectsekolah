<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submit Proyek Akhir') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">
                        Proyek: {{ $enrollment->project->title }}
                    </h3>

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('siswa.proyek.storeSubmission', $enrollment->id) }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Perbaikan: Label diubah dan input menjadi required --}}
                        <div>
                            <x-input-label for="final_submission_file" :value="__('Lampiran File Proyek')" />
                            <input type="file" name="final_submission_file" id="final_submission_file" class="block mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" required>
                        </div>

                        {{-- Perbaikan: Label tetap 'Opsional' --}}
                        <div class="mt-4">
                            <x-input-label for="final_submission_link" :value="__('Lampiran Link Video (Opsional)')" />
                            <x-text-input id="final_submission_link" class="block mt-1 w-full" type="url" name="final_submission_link" :value="old('final_submission_link', $enrollment->final_submission_link)" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                {{ __('Submit Proyek') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
