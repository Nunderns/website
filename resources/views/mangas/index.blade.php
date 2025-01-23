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

        @if(auth()->user() && auth()->user()->role == 'admin')
            <div class="mt-4">
                <!-- Botão para abrir o formulário -->
                <button onclick="toggleForm()" class="bg-blue-500 text-white px-4 py-2 rounded">Adicionar Mangá</button>

                <!-- Formulário para adicionar mangá -->
                <div id="addMangaForm" class="mt-4 hidden">
                    <form action="{{ route('mangas.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-white font-bold mb-2">Nome do Mangá:</label>
                            <input type="text" id="title" name="title" class="w-full px-3 py-2 border rounded-lg" placeholder="Digite o nome do mangá" required>
                        </div>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Salvar</button>
                    </form>
                </div>
            </div>
        @endif

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

    <script>
        function toggleForm() {
            const form = document.getElementById('addMangaForm');
            form.classList.toggle('hidden');
        }
    </script>
@endsection
