<nav class="bg-purple-600 border-b border-purple-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-white font-bold text-xl">
                        REMANGAS
                    </a>
                </div>

                <!-- Search -->
                <div class="ml-6 flex items-center flex-1">
                    <input type="text" 
                           placeholder="Procurar..." 
                           class="w-full rounded-md bg-purple-500 px-4 py-2 text-white placeholder-purple-200 focus:outline-none">
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
                                <button class="flex items-center text-sm font-medium text-white hover:text-gray-300 hover:border-gray-300 focus:outline-none focus:text-gray-300 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 01-1.414 0l-4-4a1 1 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Link para editar o perfil -->
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Link para logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Logout') }}
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