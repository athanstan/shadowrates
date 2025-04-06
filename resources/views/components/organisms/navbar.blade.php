@props(['title' => 'ShadowShowdown'])

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
                <x-atoms.logo />

                <!-- Desktop Navigation Links -->
                <div class="hidden ml-10 space-x-2 md:flex">
                    <x-atoms.nav-link route="home">
                        HOME
                    </x-atoms.nav-link>

                    <x-atoms.nav-link route="cards.index" section="cards">
                        CARDS
                    </x-atoms.nav-link>

                    <x-atoms.nav-link route="decks.index" section="decks">
                        DECKS LIST
                    </x-atoms.nav-link>

                    <x-atoms.nav-link route="decks.create" section="meta">
                        DECK BUILDER
                    </x-atoms.nav-link>

                    <x-molecules.coming-soon-link section="tournaments" title="Tournaments Coming Soon!"
                        description="Create, find, and join tournaments, compete against other players, and earn rewards and prizes."
                        icon="sparkles">
                        TOURNAMENTS
                    </x-molecules.coming-soon-link>
                </div>
            </div>

            <!-- Authentication Links -->
            <div x-data="{ open: false }" class="flex items-center">
                @auth
                    <div class="items-center hidden space-x-4 md:flex">
                        <div class="relative">
                            <button @click="open = !open"
                                class="flex items-center px-3 py-1.5 text-sm text-purple-300 hover:text-white transition-colors duration-200">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-cloak x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 w-48 mt-2 origin-top-right rounded-md shadow-lg">

                                <div class="px-2 py-2 bg-gray-900 border border-gray-800 rounded-md shadow-xs">
                                    <x-atoms.dropdown-link route="users.profile" :params="['slug' => Auth::user()->slug]">
                                        My Profile
                                    </x-atoms.dropdown-link>

                                    <x-atoms.dropdown-link route="users.profile" :params="['slug' => Auth::user()->slug]">
                                        My Collection
                                    </x-atoms.dropdown-link>

                                    <x-atoms.dropdown-link route="users.profile" :params="['slug' => Auth::user()->slug]">
                                        My Wishlists
                                    </x-atoms.dropdown-link>

                                    <x-atoms.dropdown-link route="users.settings">
                                        Settings
                                    </x-atoms.dropdown-link>

                                    <div class="my-1 border-t border-gray-800"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-sm text-left text-purple-300 rounded-sm hover:bg-gray-800 hover:text-white">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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
                <x-atoms.mobile-nav-link section="home">
                    HOME
                </x-atoms.mobile-nav-link>

                <x-atoms.mobile-nav-link route="cards.index" section="cards">
                    CARDS
                </x-atoms.mobile-nav-link>

                <x-atoms.mobile-nav-link route="decks.index" section="decks">
                    DECKS
                </x-atoms.mobile-nav-link>

                <x-atoms.mobile-nav-link route="decks.create" section="meta">
                    DECK BUILDER
                </x-atoms.mobile-nav-link>

                <x-molecules.coming-soon-link section="community" title="Community Coming Soon!"
                    description="Join discussions, share decks, and connect with other players." icon="construction"
                    mobile="true">
                    COMMUNITY
                </x-molecules.coming-soon-link>

                @auth
                    <x-atoms.mobile-nav-user-link route="users.profile" :params="['slug' => Auth::user()->slug]">
                        My Profile
                    </x-atoms.mobile-nav-user-link>

                    <x-atoms.mobile-nav-user-link route="users.profile" :params="['slug' => Auth::user()->slug]">
                        My Collection
                    </x-atoms.mobile-nav-user-link>

                    <x-atoms.mobile-nav-user-link route="users.profile" :params="['slug' => Auth::user()->slug]">
                        My Wishlists
                    </x-atoms.mobile-nav-user-link>

                    <x-atoms.mobile-nav-user-link route="users.settings">
                        Settings
                    </x-atoms.mobile-nav-user-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full px-3 py-2 text-sm font-medium text-left text-purple-300 rounded-md hover:bg-gray-800 hover:text-white">
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
