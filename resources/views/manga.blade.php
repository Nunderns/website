<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mangás</title>
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

    <!-- Mangás Page Content -->
    <section class="container mx-auto py-12 px-6">
        <h1 class="text-4xl font-bold text-center mb-8">Teste de site</h1>
        <p class="text-center mb-12 text-lg text-gray-700">Descubra nossa coleção completa de mangás traduzidos!</p>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://source.unsplash.com/400x600/?manga" alt="Manga Cover" class="w-full h-56 object-cover">
                <div class="p-4">
                    <h2 class="font-bold text-lg">Mangá 1</h2>
                    <p class="text-gray-600">Uma breve descrição do mangá.</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://source.unsplash.com/400x600/?anime" alt="Manga Cover" class="w-full h-56 object-cover">
                <div class="p-4">
                    <h2 class="font-bold text-lg">Mangá 2</h2>
                    <p class="text-gray-600">Uma breve descrição do mangá.</p>
                </div>
            </div>
            <!-- Adicione mais cards de mangás aqui -->
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Traduções de Mangás. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
