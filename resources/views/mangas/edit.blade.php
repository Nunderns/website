@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white">Editar Mangá</h1>

    <form action="{{ route('mangas.update', $manga->id) }}" method="POST" class="mt-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-white font-bold">Título</label>
            <input type="text" name="title" id="title" value="{{ old('title', $manga->title) }}" class="form-control">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-white font-bold">Descrição</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $manga->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="author" class="block text-white font-bold">Autor</label>
            <input type="text" name="author" id="author" value="{{ old('author', $manga->author) }}" class="form-control">
        </div>

        <div class="mb-4">
            <label for="artist" class="block text-white font-bold">Artista</label>
            <input type="text" name="artist" id="artist" value="{{ old('artist', $manga->artist) }}" class="form-control">
        </div>

        <div class="mb-4">
            <label for="status" class="block text-white font-bold">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="ongoing" {{ old('status', $manga->status) == 'ongoing' ? 'selected' : '' }}>Em andamento</option>
                <option value="completed" {{ old('status', $manga->status) == 'completed' ? 'selected' : '' }}>Concluído</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="approval_rating" class="block text-white font-bold">Nota</label>
            <input type="number" name="approval_rating" id="approval_rating" value="{{ old('approval_rating', $manga->approval_rating) }}" class="form-control" step="0.1" min="0" max="5">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Salvar Alterações</button>
        <a href="{{ route('mangas.show', $manga->id) }}" class="ml-4 text-white underline">Cancelar</a>
    </form>
</div>
@endsection
