@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-6">
        <h1 class="text-3xl font-bold text-white">{{ $chapter->title }}</h1>
        <p class="text-white mt-2">Capítulo número: {{ $chapter->number }}</p>
        <p class="text-white mt-2">Publicado em: {{ $chapter->created_at->format('d/m/Y') }}</p>

        <div class="mt-6">
            <h2 class="text-2xl font-bold text-white">Páginas</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach ($chapter->images as $image)
                    <div class="bg-gray-800 p-4 rounded-lg">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Página {{ $loop->index + 1 }}" class="w-full h-auto rounded-lg">
                        <p class="text-white mt-2 text-center">Página {{ $loop->index + 1 }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('mangas.show', $chapter->manga_id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Voltar ao Mangá</a>
        </div>
    </div>
</div>
@endsection
