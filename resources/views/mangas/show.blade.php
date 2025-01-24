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
                    <a href="{{ route('mangas.edit', $manga->id) }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-md">Editar Mangá</a>
                    <a href="{{ route('chapters.create', $manga->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md">Publicar Capítulo</a>
                @endif

                <!-- Nota de 1 a 5 estrelas -->
                <form id="ratingForm" action="{{ route('mangas.rate', $manga->id) }}" method="POST" class="mt-6">
                    @csrf
                    <label for="rating" class="text-white font-bold">Avalie este mangá:</label>
                    <select name="rating" id="rating" class="form-control mt-2">
                        <option value="1">1 Estrela</option>
                        <option value="2">2 Estrelas</option>
                        <option value="3">3 Estrelas</option>
                        <option value="4">4 Estrelas</option>
                        <option value="5">5 Estrelas</option>
                    </select>
                </form>

                <!-- Botão para abrir denúncia -->
                <button onclick="toggleReportModal()" class="mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded-md">Denunciar</button>
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
                        @if (Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ route('chapters.edit', [$manga->id, $chapter->id]) }}" class="mt-4 inline-block bg-yellow-500 text-white px-4 py-2 rounded-md">Editar</a>
                            <form action="{{ route('chapters.destroy', [$manga->id, $chapter->id]) }}" method="POST" class="inline-block mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="return confirm('Tem certeza que deseja excluir este capítulo?')">Excluir</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Modal para denúncia -->
<div id="reportModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 rounded-lg p-6 w-1/2">
        <h2 class="text-xl font-bold text-white mb-4">Denunciar: {{ $manga->title }}</h2>
        <form action="{{ route('mangas.report', $manga->id) }}" method="POST">
            @csrf
            <label for="reason" class="text-white font-bold">Motivo da denúncia:</label>
            <select name="reason" id="reason" class="form-control mt-2" required>
                <option value="">Selecione o motivo</option>
                <option value="incorrect_or_missing_volume">Incorreto ou faltando número do volume</option>
                <option value="info_needs_fixing">Informação precisa corrigir</option>
                <option value="missing_cover_art">Missing cover art</option>
                <option value="troll_entry">Troll entry</option>
                <option value="vandalism">Vandalismo</option>
                <option value="other">Outros</option>
            </select>

            <label for="details" class="text-white font-bold mt-4 block">Detalhes adicionais:</label>
            <textarea name="details" id="details" class="form-control mt-2 w-full" rows="4" placeholder="Explique com mais detalhes a sua denúncia"></textarea>

            <div class="mt-4 flex justify-end">
                <button type="button" onclick="toggleReportModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancelar</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Enviar Denúncia</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleReportModal() {
        const modal = document.getElementById('reportModal');
        modal.classList.toggle('hidden');
    }

    document.getElementById('rating').addEventListener('change', function() {
        var form = document.getElementById('ratingForm');
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Avaliação enviada com sucesso!');
            } else {
                alert('Ocorreu um erro ao enviar a avaliação.');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Ocorreu um erro ao enviar a avaliação.');
        });
    });
</script>
@endsection
