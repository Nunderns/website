<!-- filepath: /c:/laragon/www/website/resources/views/chapters/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-6">
        <h1 class="text-3xl font-bold text-white">Publicar Capítulo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chapters.store', $manga->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label text-white">Título</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="number" class="form-label text-white">Número</label>
                <input type="number" class="form-control" id="number" name="number" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label text-white">Conteúdo</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
    </div>
</div>
@endsection