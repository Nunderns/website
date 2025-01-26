@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mt-6">
        <h1 class="text-3xl font-bold text-white">Editar Capítulo</h1>
        <p class="text-white mt-2">Título atual: {{ $chapter->title }}</p>
        <p class="text-white mt-2">Número: {{ $chapter->number }}</p>

        <!-- Formulário de edição do capítulo -->
        <form action="{{ route('chapters.update', [$manga->id, $chapter->id]) }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-white font-medium">Título:</label>
                <input type="text" name="title" id="title" value="{{ old('title', $chapter->title) }}" class="w-full px-4 py-2 mt-2 rounded-lg bg-gray-800 text-white" required>
            </div>

            <div class="mb-4">
                <label for="number" class="block text-white font-medium">Número:</label>
                <input type="number" name="number" id="number" value="{{ old('number', $chapter->number) }}" class="w-full px-4 py-2 mt-2 rounded-lg bg-gray-800 text-white" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-6 py-2 mt-6 rounded-lg">Salvar Alterações</button>
        </form>

        <h2 class="text-2xl font-bold text-white mt-6">Imagens do Capítulo</h2>
        <div id="images-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach ($chapter->images as $image)
            <div class="relative bg-gray-800 p-4 rounded-lg">
                <img src="{{ asset('storage/' . $image->path) }}" alt="Página {{ $loop->index + 1 }}" class="w-full h-auto rounded-lg cursor-pointer" data-index="{{ $loop->index }}">
                <p class="text-white mt-2 text-center">Página {{ $loop->index + 1 }}</p>
        
                <!-- Formulário para deletar a imagem -->
                <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">Excluir</button>
                </form>
            </div>
            @endforeach
        </div>

        <!-- Formulário para adicionar imagens -->
        <form id="upload-form" action="{{ route('images.upload', $chapter->id) }}" method="POST" enctype="multipart/form-data" class="mt-6">
            @csrf
            <label for="new_image" class="flex items-center justify-center bg-gray-700 rounded-lg cursor-pointer opacity-75 hover:opacity-100 transition-opacity">
                <div class="text-white flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Adicionar Imagem</span>
                </div>
                <input type="file" name="images[]" id="new_image" class="hidden" multiple>
            </label>
        </form>
    </div>
</div>

<!-- Tela cheia para imagens -->
<div id="fullscreen-container" class="fixed inset-0 bg-black bg-opacity-90 hidden flex items-center justify-center z-50">
    <button id="close-fullscreen" class="absolute top-4 right-4 bg-white text-black px-4 py-2 rounded-lg">Voltar</button>
    <button id="prev-image" class="absolute left-4 bg-gray-800 text-white px-4 py-2 rounded-full">&lt;</button>
    <img id="fullscreen-image" src="" alt="Imagem em tela cheia" class="max-w-full max-h-full">
    <button id="next-image" class="absolute right-4 bg-gray-800 text-white px-4 py-2 rounded-full">&gt;</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Upload de Imagens
    const uploadInput = document.getElementById('new_image');
    const uploadForm = document.getElementById('upload-form');
    const imagesContainer = document.getElementById('images-container');

    if (uploadInput && uploadForm) {
        uploadInput.addEventListener('change', function () {
            const formData = new FormData(uploadForm);

            // Verifica se há arquivos selecionados
            if (this.files.length > 0) {
                fetch(uploadForm.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Atualiza a lista de imagens dinamicamente
                            data.images.forEach(image => {
                                const div = document.createElement('div');
                                div.classList.add('relative', 'bg-gray-800', 'p-4', 'rounded-lg');
                                div.innerHTML = `
                                    <img src="/storage/${image.path}" alt="Nova Imagem" class="w-full h-auto rounded-lg cursor-pointer">
                                    <p class="text-white mt-2 text-center">Nova Imagem</p>
                                    <form action="/images/${image.id}" method="POST" class="absolute top-2 right-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">Excluir</button>
                                    </form>
                                `;
                                imagesContainer.appendChild(div);
                            });

                            // Limpa o campo de seleção de arquivos
                            uploadInput.value = '';
                        } else {
                            console.error('Erro ao adicionar imagens:', data);
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao enviar imagens:', error);
                    });
            }
        });
    }

    // Tela cheia para imagens
    const fullscreenContainer = document.getElementById('fullscreen-container');
    const fullscreenImage = document.getElementById('fullscreen-image');
    const closeFullscreen = document.getElementById('close-fullscreen');
    const prevImage = document.getElementById('prev-image');
    const nextImage = document.getElementById('next-image');
    const images = Array.from(document.querySelectorAll('#images-container img'));
    let currentIndex = 0;

    function openFullscreen(index) {
        currentIndex = index;
        fullscreenImage.src = images[currentIndex].src;
        fullscreenContainer.classList.remove('hidden');
    }

    function closeFullscreenView() {
        fullscreenContainer.classList.add('hidden');
    }

    function navigateImage(step) {
        currentIndex = (currentIndex + step + images.length) % images.length;
        fullscreenImage.src = images[currentIndex].src;
    }

    images.forEach((img, index) => {
        img.addEventListener('click', () => openFullscreen(index));
    });

    closeFullscreen.addEventListener('click', closeFullscreenView);
    prevImage.addEventListener('click', () => navigateImage(-1));
    nextImage.addEventListener('click', () => navigateImage(1));

    document.addEventListener('keydown', (e) => {
        if (!fullscreenContainer.classList.contains('hidden')) {
            if (e.key === 'ArrowLeft') navigateImage(-1);
            if (e.key === 'ArrowRight') navigateImage(1);
            if (e.key === 'Escape') closeFullscreenView();
        }
    });
});
</script>
@endsection
