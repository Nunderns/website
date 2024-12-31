<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <!-- Navbar -->
    <nav class="bg-gray-800 text-white">
        <div class="container mx-auto flex items-center justify-between py-4 px-6">
            <a href="/" class="text-2xl font-bold">Mangás Traduzidos</a>
            <ul class="flex space-x-4">
                <li><a href="/" class="hover:text-gray-400">Home</a></li>
                <li><a href="/manga" class="hover:text-gray-400">Mangás</a></li>
                <li><a href="/about" class="hover:text-gray-400">Sobre</a></li>
                <li><a href="/concat" class="hover:text-gray-400">Contato</a></li>
                @if (Route::has('login'))
                    @auth
                        <li>
                            <a href="{{ url('/dashboard') }}" class="hover:text-gray-400">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="hover:text-gray-400">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}" class="hover:text-gray-400">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </nav>

    <!-- Contact Page Content -->
    <section class="container mx-auto py-12 px-6">
        <h1 class="text-4xl font-bold text-center mb-8">Entre em Contato</h1>
        <p class="text-center mb-12 text-lg text-gray-700">Envie-nos uma mensagem ou suas perguntas!</p>

        <form action="#" method="POST" class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold">Nome</label>
                <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-red-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold">Email</label>
                <input type="email" id="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-red-500" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700 font-bold">Mensagem</label>
                <textarea id="message" name="message" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-red-500" required></textarea>
            </div>
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Enviar</button>
        </form>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Traduções de Mangás. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
