@php
    $isModal = request('view') === 'modal';
@endphp

@if ($isModal)
    {{-- Tampilan untuk di dalam Modal (tanpa navigasi) --}}
    <x-modal-layout>
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-medium text-gray-900 border-b pb-4">Informasi Kuis</h3>
            <form method="POST" action="{{ route('guru.quiz.store') }}" class="mt-6 space-y-6">
                @csrf
                {{-- Input hidden untuk memberitahu controller bahwa ini dari modal --}}
                <input type="hidden" name="view" value="modal">

                {{-- Memuat form fields dari file partial yang sudah ada --}}
                @include('guru.quiz.partials.create-form-fields')

                <div class="flex items-center justify-end pt-6 border-t mt-6">
                    <x-primary-button class="ms-4">
                        {{ __('Simpan & Pilih Kuis') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal-layout>
@else
    {{-- Tampilan Halaman Penuh (dengan navigasi) --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buat Kuis Baru') }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-4">Informasi Kuis</h3>
                        <form method="POST" action="{{ route('guru.quiz.store') }}" class="mt-6 space-y-6">
                            @csrf
                            @include('guru.quiz.partials.create-form-fields')
                            <div class="flex items-center justify-end mt-10 border-t pt-6">
                                <a href="{{ route('guru.quiz.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                                <x-primary-button class="ms-4">
                                    {{ __('Lanjut & Tambah Pertanyaan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endif
