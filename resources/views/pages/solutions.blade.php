<!-- filepath: /c:/laragon/www/website/resources/views/pages/solutions.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white mt-6">Soluções</h1>
    <p class="text-white mt-4">
        Por favor, preencha o formulário abaixo para enviar suas sugestões ou soluções.
    </p>
    <form action="{{ route('solutions.submit') }}" method="POST" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-white">Nome</label>
            <input type="text" id="name" name="name" class="w-full rounded-md bg-purple-500 px-4 py-2 text-white placeholder-purple-200 focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-white">Email</label>
            <input type="email" id="email" name="email" class="w-full rounded-md bg-purple-500 px-4 py-2 text-white placeholder-purple-200 focus:outline-none" required>
        </div>
        <div class="mb-4">
            <label for="message" class="block text-white">Texto</label>
            <textarea id="message" name="message" rows="4" class="w-full rounded-md bg-purple-500 px-4 py-2 text-white placeholder-purple-200 focus:outline-none" required></textarea>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar</button>
        </div>
    </form>
</div>
@endsection