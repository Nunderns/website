@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white mt-6">Publicar Novo Capítulo</h1>
    <form action="{{ route('chapters.store', $manga->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 mt-6 rounded-lg">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-white font-bold mb-2">Título</label>
            <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite o título" required>
        </div>
        <div class="mb-4">
            <label for="number" class="block text-white font-bold mb-2">Número</label>
            <input type="number" id="number" name="number" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite o número do capítulo" required>
        </div>
        <div class="mb-4">
            <label for="images" class="block text-white font-bold mb-2">Imagens do Capítulo</label>
            <input type="file" id="images" name="images[]" class="w-full px-3 py-2 border rounded-lg bg-white" multiple>
        </div>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Publicar</button>
    </form>
</div>
@endsection
