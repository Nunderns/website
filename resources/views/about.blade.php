<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre</title>
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

    <!-- About Page Content -->
    <section class="container mx-auto py-12 px-6">
        <h1 class="text-4xl font-bold text-center mb-8">Sobre Nós</h1>
        <p class="text-center mb-12 text-lg text-gray-700">Saiba mais sobre nossa equipe e nossa missão de traduzir os melhores mangás para você!</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Nossa Missão</h2>
                <p class="text-gray-600">Nos dedicamos a trazer para você os melhores mangás traduzidos, com qualidade e rapidez. Nossa paixão por mangás nos motiva a compartilhar essas histórias incríveis com um público ainda maior.</p>
            </div>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Nossa Equipe</h2>
                <p class="text-gray-600">Somos uma equipe de tradutores e entusiastas apaixonados por mangás. Trabalhamos juntos para garantir que você tenha acesso às melhores traduções disponíveis.</p>
            </div>
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
