@php
    // Mendeteksi sinyal 'view=modal' dari URL
    $isModal = request('view') === 'modal';
@endphp

@if ($isModal)
    {{-- Tampilan untuk di dalam Modal (menggunakan layout minimalis) --}}
    <x-modal-layout>
        <div class="p-4 sm:p-6 space-y-6">
            @include('guru.quiz.partials.show-content-merged')
        </div>
    </x-modal-layout>
@else
    {{-- Tampilan Halaman Penuh (menggunakan layout utama dengan navbar) --}}
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Kuis: {{ $quiz->title }}
            </h2>
        </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @include('guru.quiz.partials.show-content-merged')
            </div>
        </div>
    </x-app-layout>
@endif
