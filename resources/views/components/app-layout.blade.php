<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShadowRates') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Exo+2:wght@400;500;600;700&family=Press+Start+2P&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Livewire Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="fixed z-50 w-full bg-gray-900 border-b border-purple-900 bg-opacity-80 backdrop-blur-sm">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="/" class="flex items-center">
                        <span class="text-xl font-bold text-purple-400">Shadow<span
                                class="text-indigo-400">Rates</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="flex items-center ml-10 space-x-4">
                        <a href="{{ route('cards.index') }}" wire:navigate
                            class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cards.index') ? 'bg-purple-800 text-white' : 'text-gray-300 hover:bg-purple-700 hover:text-white' }}">
                            Cards
                        </a>
                        <a href="#" wire:navigate
                            class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                            Decks
                        </a>
                        <a href="#" wire:navigate
                            class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                            Meta Report
                        </a>
                        <a href="#" wire:navigate
                            class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                            Collection
                        </a>
                    </div>
                </div>

                <!-- Login / Profile -->
                <div class="flex items-center">
                    @auth
                        <div class="relative ml-3" x-data="{ open: false }">
                            <div>
                                <button type="button" @click="open = !open" @click.away="open = false"
                                    class="relative flex text-sm cursor-pointer focus:outline-none" id="user-menu-button">
                                    <div class="absolute inset-0 transition-colors rounded-lg shadow-lg bg-gradient-to-br from-purple-500/50 to-indigo-500/50"
                                        :class="open ? 'animate-[pulse_1s_ease-in-out_infinite]' :
                                            'animate-[pulse_3s_ease-in-out_infinite]'">
                                    </div>
                                    <div class="absolute inset-[2px] bg-gray-900 rounded-lg"></div>
                                    <img class="relative object-cover w-10 h-10 p-1 rounded-lg pixel-corners"
                                        src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                        style="image-rendering: pixelated;">
                                </button>
                            </div>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <a href="{{ route('users.profile', auth()->user()->slug) }}" wire:navigate
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-left text-gray-300 hover:bg-gray-700">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <x-atoms.google-login-button class="neo-brutal-button pixel-corners">
                            Sign in with Google
                        </x-atoms.google-login-button>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex mr-2 md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        id="mobile-menu-button">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('cards.index') }}" wire:navigate
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cards.index') ? 'bg-purple-800 text-white' : 'text-gray-300 hover:bg-purple-700 hover:text-white' }}">
                    Cards
                </a>
                <a href="#" wire:navigate
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                    Decks
                </a>
                <a href="#" wire:navigate
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                    Meta Report
                </a>
                <a href="#" wire:navigate
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                    Collection
                </a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="min-h-screen pt-16 pb-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="py-6 bg-gray-900 border-t border-purple-900">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col items-center justify-between md:flex-row">
                <div class="mb-4 md:mb-0">
                    <span class="text-xl font-bold text-purple-400">Shadow<span
                            class="text-indigo-400">Rates</span></span>
                    <p class="mt-1 text-sm text-gray-400">The Ultimate Shadowverse Companion</p>
                </div>
                <div class="text-sm text-gray-400">
                    &copy; {{ date('Y') }} ShadowRates. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>

    <!-- Livewire Scripts -->
    @livewireScripts
</body>

</html>
