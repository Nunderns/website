<!-- filepath: /c:/laragon/www/website/resources/views/mangas/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-6">
        <div class="flex">
            <div class="w-1/3">
                <img src="{{ $manga->image_url }}" alt="{{ $manga->title }}" class="w-full h-auto rounded-md">
            </div>
            <div class="w-2/3 ml-6">
                <h1 class="text-3xl font-bold text-white">{{ $manga->title }}</h1>
                <p class="text-white mt-4">{{ $manga->description }}</p>
                <p class="text-white mt-4">Nota: {{ $manga->approval_rating }}</p>
                <p class="text-white mt-4">Status: {{ ucfirst($manga->status) }}</p>
                <p class="text-white mt-4">Autor: {{ $manga->author }}</p>
                <p class="text-white mt-4">Artista: {{ $manga->artist }}</p>
                <p class="text-white mt-4">Categorias: 
                    @foreach ($manga->categories as $category)
                        {{ $category->name }}@if (!$loop->last), @endif
                    @endforeach
                </p>
                <p class="text-white mt-4">
                    <a href="{{ $manga->buy_link }}" class="underline text-blue-500" target="_blank">Onde comprar</a>
                </p>

                @if (Auth::check() && Auth::user()->isAdmin())
                    <a href="{{ route('chapters.create', $manga->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md">Publicar Capítulo</a>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-2xl font-bold text-white">Capítulos Disponíveis</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach ($manga->chapters as $chapter)
                    <div class="bg-purple-500 p-4 rounded-lg">
                        <h3 class="text-white font-bold">{{ $chapter->title }}</h3>
                        <p class="text-white">Número: {{ $chapter->number }}</p>
                        <p class="text-white">Publicado em: {{ $chapter->created_at->format('d/m/Y') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection