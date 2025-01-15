@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mt-6">
            <h1 class="text-3xl font-bold text-white">Todos os Mangás</h1>
            <div class="text-white">
                <span>Ordenado por:</span>
                <a href="{{ route('mangas.index', ['sort' => 'latest']) }}" class="underline">Último</a> |
                <a href="{{ route('mangas.index', ['sort' => 'az']) }}" class="underline">A-Z</a> |
                <a href="{{ route('mangas.index', ['sort' => 'approval']) }}" class="underline">Aprovação</a> |
                <a href="{{ route('mangas.index', ['sort' => 'trend']) }}" class="underline">Tendência</a> |
                <a href="{{ route('mangas.index', ['sort' => 'views']) }}" class="underline">Por mais views</a> |
                <a href="{{ route('mangas.index', ['sort' => 'new']) }}" class="underline">Novo</a>
            </div>
        </div>
        <p class="text-white mt-2">Total de Mangás: {{ $mangas->total() }}</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($mangas as $manga)
                <div class="bg-purple-500 p-4 rounded-lg">
                    <img src="{{ $manga->image_url }}" alt="{{ $manga->title }}" class="w-full h-48 object-cover rounded-md">
                    <h2 class="text-white font-bold mt-4">{{ $manga->title }}</h2>
                    <p class="text-white mt-2">Capítulo mais recente: {{ $manga->latest_chapter }}</p>
                    <a href="{{ route('mangas.show', $manga) }}" class="text-white underline mt-4 block">Ver mais</a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $mangas->links() }}
        </div>
    </div>
@endsection