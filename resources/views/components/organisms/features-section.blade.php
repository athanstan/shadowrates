<div id="features" class="relative py-20 overflow-hidden" x-data="{ hoveredFeature: null }">
    <!-- Game-like background with grid pattern -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[#0a0a1a]"></div>
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%238a2be2\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 0h40v40H0V0zm20 20h20v20H20V20zM0 20h20v20H0V20z\'/%3E%3C/g%3E%3C/svg%3E')] opacity-30">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-purple-900/10 to-[#0a0a1a]/90"></div>
    </div>

    <!-- Diagonal decorative lines -->
    <div class="absolute top-0 right-0 w-1/3 h-40 overflow-hidden opacity-20">
        <div
            class="absolute h-[200%] w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent -rotate-45 translate-x-24">
        </div>
        <div
            class="absolute h-[200%] w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent -rotate-45 translate-x-36">
        </div>
    </div>
    <div class="absolute bottom-0 left-0 w-1/3 h-40 overflow-hidden opacity-20">
        <div
            class="absolute h-[200%] w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent rotate-45 -translate-x-24">
        </div>
        <div
            class="absolute h-[200%] w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent rotate-45 -translate-x-36">
        </div>
    </div>

    <div class="container relative mx-auto px-4 z-10">
        <!-- Cyberpunk section header with glowing effect -->
        <div class="text-center mb-16 max-w-3xl mx-auto">
            <h2 class="relative inline-block text-2xl font-bold md:text-3xl mb-4">
                <span
                    class="bg-gradient-to-r from-blue-400 via-purple-500 to-purple-400 bg-clip-text text-transparent">STRATEGIC
                    TOOLS</span>
                <div class="h-1 w-full bg-gradient-to-r from-transparent via-purple-500 to-transparent"></div>
            </h2>
            <p class="text-lg text-purple-200 max-w-2xl mx-auto">Comprehensive analytics and professional-grade tools
                designed to elevate your Shadowverse gameplay and strategic decision-making.</p>
        </div>

        <!-- Game-like feature cards grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1: Card Ratings -->
            <div @mouseenter="hoveredFeature = 1" @mouseleave="hoveredFeature = null"
                class="neo-brutal-panel space-card rounded-lg p-6" :class="{ 'glow-effect': hoveredFeature === 1 }">
                <div class="mb-4 flex items-center">
                    <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-800">
                        <svg class="h-6 w-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-purple-200">Card Ratings</h3>
                </div>
                <p class="mb-4 text-purple-300">Access comprehensive card evaluations with professional ratings,
                    statistical breakdowns, and meta-game positioning for every card.</p>
                <ul class="mb-4 space-y-2 text-sm text-purple-300">
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Community-driven scores
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Pro player insights
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Card performance metrics
                    </li>
                </ul>
                <a href="#" class="flex items-center text-sm text-purple-300 hover:text-white">
                    Rate Cards
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Feature 2: Deck Builder -->
            <div @mouseenter="hoveredFeature = 2" @mouseleave="hoveredFeature = null"
                class="neo-brutal-panel space-card rounded-lg p-6" :class="{ 'glow-effect': hoveredFeature === 2 }">
                <div class="mb-4 flex items-center">
                    <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-800">
                        <svg class="h-6 w-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-purple-200">Deck Builder</h3>
                </div>
                <p class="mb-4 text-purple-300">Create, refine, and analyze decks with our professional deck builder.
                    Track mana curve, card synergies, and more.</p>
                <ul class="mb-4 space-y-2 text-sm text-purple-300">
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Visual deck construction
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Synergy suggestions
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        One-click export
                    </li>
                </ul>
                <a href="#" class="flex items-center text-sm text-purple-300 hover:text-white">
                    Build Decks
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Feature 3: Community -->
            <div @mouseenter="hoveredFeature = 3" @mouseleave="hoveredFeature = null"
                class="neo-brutal-panel space-card rounded-lg p-6" :class="{ 'glow-effect': hoveredFeature === 3 }">
                <div class="mb-4 flex items-center">
                    <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-800">
                        <svg class="h-6 w-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-purple-200">Community</h3>
                </div>
                <p class="mb-4 text-purple-300">Connect with players, share strategies, and discuss the meta. Our forums
                    are the hub for serious Shadowverse enthusiasts.</p>
                <ul class="mb-4 space-y-2 text-sm text-purple-300">
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Active discussion forums
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Strategy guides
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Deck sharing
                    </li>
                </ul>
                <a href="#" class="flex items-center text-sm text-purple-300 hover:text-white">
                    Join Community
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Feature 4: Meta Reports -->
            <div @mouseenter="hoveredFeature = 4" @mouseleave="hoveredFeature = null"
                class="neo-brutal-panel space-card rounded-lg p-6" :class="{ 'glow-effect': hoveredFeature === 4 }">
                <div class="mb-4 flex items-center">
                    <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-800">
                        <svg class="h-6 w-6 text-purple-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-purple-200">Meta Reports</h3>
                </div>
                <p class="mb-4 text-purple-300">Stay ahead with professional meta analysis. Weekly reports, tier lists,
                    and trend forecasts based on tournament data.</p>
                <ul class="mb-4 space-y-2 text-sm text-purple-300">
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Weekly tier updates
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Tournament results analysis
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Meta predictions
                    </li>
                </ul>
                <a href="#" class="flex items-center text-sm text-purple-300 hover:text-white">
                    View Reports
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <!-- Feature 5: Deck Export -->
            <div @mouseenter="hoveredFeature = 5" @mouseleave="hoveredFeature = null"
                class="neo-brutal-panel space-card rounded-lg p-6" :class="{ 'glow-effect': hoveredFeature === 5 }">
                <div class="mb-4 flex items-center">
                    <div class="mr-4 flex h-12 w-12 items-center justify-center rounded-full bg-purple-800">
                        <svg class="h-6 w-6 text-purple-200" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-purple-200">Deck Export</h3>
                </div>
                <p class="mb-4 text-purple-300">Seamlessly export decks to the game with our one-click system. Share
                    codes with teammates or save for your collection.</p>
                <ul class="mb-4 space-y-2 text-sm text-purple-300">
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        One-click game import
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Shareable deck codes
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2 text-purple-400">→</span>
                        Deck screenshots
                    </li>
                </ul>
                <a href="#" class="flex items-center text-sm text-purple-300 hover:text-white">
                    Export Tools
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .feature-card {
        @apply relative bg-gradient-to-b from-gray-800 to-gray-900 rounded-xl p-6 shadow-lg border border-gray-700 transition-all duration-300 overflow-hidden;
    }

    .feature-card-inner {
        @apply relative z-10 h-full flex flex-col;
    }

    .feature-header {
        @apply flex flex-col items-center mb-4;
    }

    .feature-icon {
        @apply w-14 h-14 rounded-full flex items-center justify-center mb-4 shadow-lg transition-transform duration-300;
    }

    .feature-title {
        @apply text-xl font-bold text-white mb-3 transition-all duration-300 relative text-center;
    }

    .feature-title::after {
        content: '';
        @apply block absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-transparent via-purple-500 to-transparent transition-all duration-500;
    }

    .feature-card:hover .feature-title::after {
        @apply w-16;
    }

    .feature-card:hover .feature-icon {
        transform: translateY(-4px);
    }

    .feature-desc {
        @apply text-gray-300 transition-all duration-300 text-center mb-6;
    }

    .feature-card:hover .feature-desc {
        @apply text-gray-200;
    }

    .feature-action {
        @apply mt-auto flex justify-center opacity-0 transition-opacity duration-300;
    }
</style>
