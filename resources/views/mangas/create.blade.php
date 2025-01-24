@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mt-6">Adicionar Novo Mangá</h1>

        <form action="{{ route('mangas.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 mt-6 rounded-lg">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-white font-bold mb-2">Nome do Mangá:</label>
                <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite o nome do mangá" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-white font-bold mb-2">Descrição:</label>
                <textarea id="description" name="description" rows="4" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite uma descrição" required></textarea>
            </div>
            <div class="mb-4">
                <label for="author" class="block text-white font-bold mb-2">Autor:</label>
                <input type="text" id="author" name="author" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite o nome do autor" required>
            </div>
            <div class="mb-4">
                <label for="artist" class="block text-white font-bold mb-2">Artista:</label>
                <input type="text" id="artist" name="artist" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite o nome do artista" required>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-white font-bold mb-2">Categoria:</label>
                <input type="text" id="category" name="category" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite a categoria" required>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-white font-bold mb-2">Imagem da Capa:</label>
                <input type="file" id="image" name="image" class="w-full px-3 py-2 border rounded-lg bg-white">
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>
@endsection
