<!-- filepath: /c:/laragon/www/website/resources/views/welcome.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-start mt-6">
        <!-- Lançamentos -->
        <div class="w-2/3">
            <h1 class="text-3xl font-bold text-white">Lançamentos</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach ($latestMangas as $manga)
                <div class="bg-purple-500 p-4 rounded-lg">
                    <h2 class="text-white font-bold">{{ $manga->title }}</h2>
                    <p class="text-white">Nota: {{ $manga->approval_rating }}</p>
                    @if ($manga->latestChapter && $manga->latestChapter->number)
                        <p class="text-white">Capítulo: {{ $manga->latestChapter->number }}</p>
                        <p class="text-white">Postado: {{ $manga->latestChapter->created_at->diffForHumans() }}</p>
                    @else
                        <p class="text-white">Capítulo: N/A</p>
                        <p class="text-white">Postado: N/A</p>
                    @endif
                </div>
            @endforeach
            </div>
        </div>

        <!-- Mais lidos -->
        <div class="w-1/3 ml-6">
            <h1 class="text-3xl font-bold text-white">Mais lidos</h1>
            <div class="mt-6">
                @foreach ($mostViewedMangas as $manga)
                    <div class="bg-purple-500 p-4 rounded-lg mb-4">
                        <h2 class="text-white font-bold">{{ $manga->title }}</h2>
                        <p class="text-white">Nota: {{ $manga->approval_rating }}</p>
                        @if ($manga->latestChapter)
                            <p class="text-white">Capítulo: {{ $manga->latestChapter->number }}</p>
                            <p class="text-white">Postado: {{ $manga->latestChapter->created_at->diffForHumans() }}</p>
                        @else
                            <p class="text-white">Capítulo: N/A</p>
                            <p class="text-white">Postado: N/A</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection