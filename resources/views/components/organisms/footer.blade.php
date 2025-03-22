<footer class="relative text-white overflow-hidden mt-12 border-t border-purple-900/50 bg-black/60"
    x-data="{ hoveredColumn: null }">
    <!-- Background elements -->
    <div
        class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%238a2be2\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 0h40v40H0V0zm20 20h20v20H20V20zM0 20h20v20H0V20z\'/%3E%3C/g%3E%3C/svg%3E')] opacity-20">
    </div>
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/50"></div>

    <!-- Top border glow -->
    <div
        class="absolute top-0 inset-x-0 h-0.5 bg-gradient-to-r from-transparent via-purple-500 to-transparent opacity-70">
    </div>

    <div class="container relative mx-auto px-4 py-12 z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo and description -->
            <div class="col-span-1 md:col-span-1" @mouseenter="hoveredColumn = 'brand'" @mouseleave="hoveredColumn = null">
                <div class="mb-4 flex items-center">
                    <div
                        class="pixel-corners mr-3 h-10 w-10 bg-purple-900/80 rounded-lg flex items-center justify-center border border-purple-500/80">
                        <span
                            class="font-cinzel text-lg bg-gradient-to-br from-purple-300 to-purple-100 bg-clip-text text-transparent">S</span>
                    </div>
                    <h3 class="text-xl font-bold text-purple-200">SHADOWRATES</h3>
                </div>
                <p class="mb-4 text-sm text-purple-300">The ultimate companion for Shadowverse players. Card ratings,
                    deck building, and community resources.</p>
                <div class="flex space-x-3">
                    <a href="#" class="text-purple-300 hover:text-white">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" class="text-purple-300 hover:text-white">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                            </path>
                        </svg>
                    </a>
                    <a href="#" class="text-purple-300 hover:text-white">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z">
                            </path>
                        </svg>
                    </a>
                    <a href="#" class="text-purple-300 hover:text-white">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-span-1" @mouseenter="hoveredColumn = 'links'" @mouseleave="hoveredColumn = null">
                <h4 class="mb-4 text-lg font-bold text-purple-200">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'links' }">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'links' }">
                            Cards Database
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'links' }">
                            Deck Builder
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'links' }">
                            Tier Lists
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'links' }">
                            Meta Reports
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Community Links -->
            <div class="col-span-1" @mouseenter="hoveredColumn = 'community'" @mouseleave="hoveredColumn = null">
                <h4 class="mb-4 text-lg font-bold text-purple-200">Community</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'community' }">
                            Forums
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'community' }">
                            Discord Server
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'community' }">
                            Tournaments
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'community' }">
                            Partner Program
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'community' }">
                            Content Creators
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support Links -->
            <div class="col-span-1" @mouseenter="hoveredColumn = 'support'" @mouseleave="hoveredColumn = null">
                <h4 class="mb-4 text-lg font-bold text-purple-200">Support</h4>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'support' }">
                            Contact Us
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'support' }">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'support' }">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'support' }">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-purple-300 hover:text-white transition-colors duration-200 relative pl-3"
                            :class="{ 'pl-4': hoveredColumn === 'support' }">
                            Cookie Policy
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom border with rune-like design -->
        <div class="mt-8 pt-8 border-t border-purple-900/50 text-center">
            <p class="text-sm text-purple-400">&copy; {{ date('Y') }} ShadowRates. All rights reserved. Not
                affiliated with Cygames.</p>
            <p class="mt-2 text-xs text-purple-500">All game content and materials are trademarks and copyrights of
                their respective owners.</p>
        </div>
    </div>
</footer>

<style>
    footer a {
        position: relative;
        transition: all 0.3s ease;
    }

    footer a::before {
        content: '→';
        position: absolute;
        left: 0;
        opacity: 0;
        transition: all 0.3s ease;
    }

    footer a:hover::before {
        opacity: 1;
    }
</style>
