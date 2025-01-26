@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-6">
    <h1 class="text-3xl font-bold text-white">Resultados da busca por: "{{ $query }}"</h1>

    @if ($mangas->isEmpty())
        <p class="text-white mt-4">Nenhum resultado encontrado.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($mangas as $manga)
                <div class="bg-purple-500 p-4 rounded-lg">
                    <div class="mb-4">
                        <img 
                            src="{{ $manga->cover_image ? asset('storage/' . $manga->cover_image) : asset('images/default-cover.jpg') }}" 
                            alt="Capa de {{ $manga->title }}" 
                            class="w-full h-48 object-cover rounded-lg">
                    </div>
                    <h2 class="text-white font-bold">
                        <a href="{{ route('mangas.show', $manga->id) }}">{{ $manga->title }}</a>
                    </h2>
                    <p class="text-white">Nota: {{ $manga->approval_rating }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $mangas->links() }}
        </div>
    @endif
</div>
@endsection
