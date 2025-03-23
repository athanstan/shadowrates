@props(['title' => 'ShadowRates'])

<nav x-data="{ mobileMenuOpen: false, activeSection: 'home' }" class="relative z-50 shadow-lg"
    style="background: linear-gradient(to bottom, rgba(20, 10, 30, 0.95), rgba(10, 5, 15, 0.95));">

    <!-- Navbar glow effect -->
    <div
        class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-transparent via-purple-500 to-transparent opacity-70">
    </div>

    <div class="container px-4 mx-auto">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="flex items-center font-bold text-white group">
                    <div class="relative mr-3">
                        <div
                            class="absolute transition-opacity duration-300 rounded-full opacity-75 -inset-1 bg-gradient-to-r from-purple-600 to-blue-600 blur-md group-hover:opacity-100">
                        </div>
                        <div
                            class="relative flex items-center justify-center bg-gray-900 border rounded-full shadow-lg w-9 h-9 border-purple-500/70 shadow-purple-500/20">
                            <span
                                class="text-xl text-transparent font-cinzel bg-gradient-to-br from-purple-300 to-purple-100 bg-clip-text">S</span>
                        </div>
                    </div>
                    <span
                        class="text-xl text-transparent font-cinzel bg-gradient-to-r from-white to-purple-300 bg-clip-text">SHADOWRATES</span>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden ml-10 space-x-2 md:flex">
                    <a href="#" @click.prevent="activeSection = 'home'"
                        :class="{ 'active text-purple-200': activeSection === 'home', 'text-purple-400': activeSection !== 'home' }"
                        class="px-3 py-2 text-sm font-medium transition-all duration-300 cyber-tab">
                        HOME
                    </a>
                    <a href="{{ route('cards.index') }}" wire:navigate @click.prevent="activeSection = 'cards'"
                        :class="{ 'active text-purple-200': activeSection === 'cards', 'text-purple-400': activeSection !== 'cards' }"
                        class="px-3 py-2 text-sm font-medium transition-all duration-300 cyber-tab">
                        CARDS
                    </a>
                    <a href="#" @click.prevent="activeSection = 'decks'"
                        :class="{ 'active text-purple-200': activeSection === 'decks', 'text-purple-400': activeSection !== 'decks' }"
                        class="px-3 py-2 text-sm font-medium transition-all duration-300 cyber-tab">
                        DECKS
                    </a>
                    <a href="#" @click.prevent="activeSection = 'meta'"
                        :class="{ 'active text-purple-200': activeSection === 'meta', 'text-purple-400': activeSection !== 'meta' }"
                        class="px-3 py-2 text-sm font-medium transition-all duration-300 cyber-tab">
                        META
                    </a>
                    <a href="#" @click.prevent="activeSection = 'community'"
                        :class="{ 'active text-purple-200': activeSection === 'community', 'text-purple-400': activeSection !== 'community' }"
                        class="px-3 py-2 text-sm font-medium transition-all duration-300 cyber-tab">
                        COMMUNITY
                    </a>
                </div>
            </div>

            <!-- Authentication Links -->
            <div class="flex items-center">
                @auth
                    <div class="items-center hidden space-x-4 md:flex">
                        <a href="#"
                            class="px-3 py-1.5 text-sm text-purple-300 hover:text-white transition-colors duration-200">
                            Dashboard
                        </a>
                        <form method="POST" action="#">
                            @csrf
                            <button type="submit"
                                class="neo-brutal-button pixel-corners inline-block px-4 py-1.5 text-sm font-bold text-white">
                                Log Out
                            </button>
                        </form>
                    </div>
                @else
                    <div class="items-center hidden space-x-3 md:flex">
                        <x-atoms.google-login-button
                            class="neo-brutal-button pixel-corners inline-block px-4 py-1.5 text-sm font-bold text-white">
                            Sign in with Google
                        </x-atoms.google-login-button>
                    </div>
                @endauth

                <!-- Mobile menu button -->
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                    class="p-2 text-purple-400 rounded-md md:hidden hover:text-white focus:outline-none"
                    id="mobile-menu-button">
                    <svg class="w-6 h-6 transition-transform duration-300" :class="{ 'rotate-90': mobileMenuOpen }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mt-1 overflow-hidden transition-all duration-300 border-t md:hidden border-purple-900/30"
            :style="{ maxHeight: mobileMenuOpen ? '300px' : '0px', opacity: mobileMenuOpen ? '1' : '0' }">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#" @click.prevent="activeSection = 'home'"
                    :class="{ 'bg-purple-900/30 text-white': activeSection === 'home' }" class="mobile-nav-link">
                    HOME
                </a>
                <a href="{{ route('cards.index') }}" wire:navigate
                    :class="{ 'bg-purple-900/30 text-white': activeSection === 'cards' }" class="mobile-nav-link">
                    CARDS
                </a>
                <a href="#" @click.prevent="activeSection = 'decks'"
                    :class="{ 'bg-purple-900/30 text-white': activeSection === 'decks' }" class="mobile-nav-link">
                    DECKS
                </a>
                <a href="#" @click.prevent="activeSection = 'meta'"
                    :class="{ 'bg-purple-900/30 text-white': activeSection === 'meta' }" class="mobile-nav-link">
                    META
                </a>
                <a href="#" @click.prevent="activeSection = 'community'"
                    :class="{ 'bg-purple-900/30 text-white': activeSection === 'community' }" class="mobile-nav-link">
                    COMMUNITY
                </a>

                @auth
                    <a href="#" class="mobile-nav-link">
                        Dashboard
                    </a>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="w-full text-left mobile-nav-link">
                            Log Out
                        </button>
                    </form>
                @else
                    <div class="flex flex-col pt-2 mt-2 space-y-2 border-t border-gray-800">
                        <x-atoms.google-login-button size="lg"
                            class="justify-center w-full px-4 py-2 text-sm font-bold text-white neo-brutal-button pixel-corners">
                            Sign in with Google
                        </x-atoms.google-login-button>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    .mobile-nav-link {
        @apply block px-3 py-2 rounded-md text-base font-medium text-purple-300 hover:text-white hover:bg-purple-900/30 transition-colors duration-200;
        border-left: 2px solid transparent;
    }

    .mobile-nav-link:hover {
        border-left: 2px solid theme('colors.purple.500');
    }
</style>

<script>
    // JavaScript to toggle mobile menu
    document.addEventListener('DOMContentLoaded', () => {
        const button = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');

        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    });
</script>
