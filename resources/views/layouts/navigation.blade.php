<nav class="bg-purple-600 border-b border-purple-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-white font-bold text-xl">
                        Genova Translations
                    </a>
                </div>

                <!-- Search -->
                <div class="ml-6 flex items-center flex-1 relative">
                    <input 
                        type="text" 
                        id="navigation-search-input" 
                        placeholder="Procurar..." 
                        class="w-full rounded-md bg-purple-500 px-4 py-2 text-white placeholder-purple-200 focus:outline-none focus:ring focus:ring-purple-400">
                    <div id="navigation-search-results" class="absolute top-full left-0 w-full bg-gray-900 rounded-lg mt-2 hidden z-10">
                        <!-- Resultados da busca dinâmica -->
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center px-1 pt-1 text-white">
                        HOME
                    </a>
                    <a href="{{ route('discord') }}" 
                       class="inline-flex items-center px-1 pt-1 text-white">
                        DISCORD
                    </a>
                    <a href="{{ route('donations') }}" 
                       class="inline-flex items-center px-1 pt-1 text-white">
                        DOAÇÕES
                    </a>
                    <a href="{{ route('solutions') }}" 
                       class="inline-flex items-center px-1 pt-1 text-white">
                        SOLUÇÕES
                    </a>
                    <a href="{{ route('mangas.index') }}" 
                       class="inline-flex items-center px-1 pt-1 text-white">
                        MANGÁS
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="inline-flex items-center px-1 pt-1 text-white">
                        CONTATO
                    </a>
                </div>
            </div>

            <!-- Auth Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <div class="ml-3 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-white hover:text-gray-200">
                                    <div>{{ Auth::user()->name }}</div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-white px-4 py-2">Entre</a>
                    <a href="{{ route('register') }}" class="text-white px-4 py-2">Crie conta</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    const searchInput = document.getElementById('navigation-search-input');
    const resultsContainer = document.getElementById('navigation-search-results');

    searchInput.addEventListener('input', function(e) {
        const query = e.target.value;

        if (query.length < 2) {
            resultsContainer.classList.add('hidden');
            resultsContainer.innerHTML = '';
            return;
        }

        fetch(`/search?query=${query}`)
            .then(response => response.json())
            .then(data => {
                resultsContainer.innerHTML = '';
                if (data.length > 0) {
                    data.forEach(manga => {
                        const resultElement = document.createElement('div');
                        resultElement.classList.add('p-2', 'text-white', 'hover:bg-gray-800', 'cursor-pointer', 'rounded-lg');
                        resultElement.innerHTML = `
                            <a href="/mangas/${manga.id}" class="block">
                                <p class="font-bold">${manga.title}</p>
                                <p class="text-sm text-gray-400">Nota: ${manga.approval_rating}</p>
                            </a>
                        `;
                        resultsContainer.appendChild(resultElement);
                    });
                    resultsContainer.classList.remove('hidden');
                } else {
                    resultsContainer.innerHTML = '<p class="text-white p-2">Nenhum resultado encontrado.</p>';
                    resultsContainer.classList.remove('hidden');
                }
            });
    });

    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            const query = searchInput.value;
            if (query.length > 1) {
                window.location.href = `/search-results?query=${query}`;
            }
        }
    });
</script>
