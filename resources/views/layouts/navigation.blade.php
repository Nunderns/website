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
                                <button class="flex items-center text-white hover:text-gray-200">
                                    <div>{{ Auth::user()->name }}</div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.show')">
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
