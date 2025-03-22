@props(['title' => 'ShadowRates'])

<nav x-data="{ mobileMenuOpen: false, activeSection: 'home' }" class="relative z-20 shadow-lg"
    style="background: linear-gradient(to bottom, rgba(20, 10, 30, 0.95), rgba(10, 5, 15, 0.95));">

    <!-- Navbar glow effect -->
    <div
        class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-transparent via-purple-500 to-transparent opacity-70">
    </div>

    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" class="group flex items-center font-bold text-white">
                    <div class="relative mr-3">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full opacity-75 blur-md group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                        <div
                            class="relative w-9 h-9 bg-gray-900 rounded-full flex items-center justify-center border border-purple-500/70 shadow-lg shadow-purple-500/20">
                            <span
                                class="font-cinzel text-xl bg-gradient-to-br from-purple-300 to-purple-100 bg-clip-text text-transparent">S</span>
                        </div>
                    </div>
                    <span
                        class="font-cinzel text-xl bg-gradient-to-r from-white to-purple-300 bg-clip-text text-transparent">SHADOWRATES</span>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex ml-10 space-x-2">
                    <a href="#" @click.prevent="activeSection = 'home'"
                        :class="{ 'active text-purple-200': activeSection === 'home', 'text-purple-400': activeSection !== 'home' }"
                        class="cyber-tab px-3 py-2 text-sm font-medium transition-all duration-300">
                        HOME
                    </a>
                    <a href="{{ route('cards.index') }}" wire:navigate @click.prevent="activeSection = 'cards'"
                        :class="{ 'active text-purple-200': activeSection === 'cards', 'text-purple-400': activeSection !== 'cards' }"
                        class="cyber-tab px-3 py-2 text-sm font-medium transition-all duration-300">
                        CARDS
                    </a>
                    <a href="#" @click.prevent="activeSection = 'decks'"
                        :class="{ 'active text-purple-200': activeSection === 'decks', 'text-purple-400': activeSection !== 'decks' }"
                        class="cyber-tab px-3 py-2 text-sm font-medium transition-all duration-300">
                        DECKS
                    </a>
                    <a href="#" @click.prevent="activeSection = 'meta'"
                        :class="{ 'active text-purple-200': activeSection === 'meta', 'text-purple-400': activeSection !== 'meta' }"
                        class="cyber-tab px-3 py-2 text-sm font-medium transition-all duration-300">
                        META
                    </a>
                    <a href="#" @click.prevent="activeSection = 'community'"
                        :class="{ 'active text-purple-200': activeSection === 'community', 'text-purple-400': activeSection !== 'community' }"
                        class="cyber-tab px-3 py-2 text-sm font-medium transition-all duration-300">
                        COMMUNITY
                    </a>
                </div>
            </div>

            <!-- Authentication Links -->
            <div class="flex items-center">
                @auth
                    <div class="hidden md:flex items-center space-x-4">
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
                    <div class="hidden md:flex items-center space-x-3">
                        <x-atoms.google-login-button
                            class="neo-brutal-button pixel-corners inline-block px-4 py-1.5 text-sm font-bold text-white">
                            Sign in with Google
                        </x-atoms.google-login-button>
                    </div>
                @endauth

                <!-- Mobile menu button -->
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden p-2 rounded-md text-purple-400 hover:text-white focus:outline-none"
                    id="mobile-menu-button">
                    <svg class="h-6 w-6 transition-transform duration-300" :class="{ 'rotate-90': mobileMenuOpen }"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden transition-all duration-300 overflow-hidden border-t border-purple-900/30 mt-1"
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
                    <div class="pt-2 flex flex-col space-y-2 border-t border-gray-800 mt-2">
                        <x-atoms.google-login-button size="lg"
                            class="neo-brutal-button pixel-corners w-full justify-center px-4 py-2 text-sm font-bold text-white">
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
