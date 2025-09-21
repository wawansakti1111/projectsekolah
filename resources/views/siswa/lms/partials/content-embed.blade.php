@if ($embedUrl)
    {{-- Jika tipe kontennya adalah file, gunakan kontainer yang tinggi --}}
    @if ($lmsContent->type === 'file')
        <div class="w-full h-[80vh] bg-gray-800 rounded-lg overflow-hidden">
            <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0"></iframe>
        </div>
    @else
        {{-- Jika video, pertahankan aspect ratio 16:9 --}}
        <div class="aspect-w-16 aspect-h-9 bg-gray-900 rounded-lg overflow-hidden">
            <iframe src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    @endif
@else
    <div class="flex flex-col items-center justify-center h-48 text-center p-4 bg-gray-100 rounded-lg">
        <p class="text-gray-600">Konten tidak dapat ditampilkan.</p>
    </div>
@endif
