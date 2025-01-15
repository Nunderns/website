@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-white">{{ $manga->title }}</h1>
        <p class="text-white">{{ $manga->description }}</p>
        <div class="mt-4">
            <a href="{{ route('mangas.index') }}" class="text-white underline">Voltar para a lista de mangás</a>
        </div>
    </div>
@endsection