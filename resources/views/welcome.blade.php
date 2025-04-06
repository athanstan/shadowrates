<x-app-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden isolate">
        <svg class="absolute inset-0 -z-10 size-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
            aria-hidden="true">
            <defs>
                <pattern id="shadowshowdown-pattern" width="200" height="200" x="50%" y="-1"
                    patternUnits="userSpaceOnUse">
                    <path d="M.5 200V.5H200" fill="none" />
                </pattern>
            </defs>
            <svg x="50%" y="-1" class="overflow-visible fill-gray-800/20">
                <path d="M-200 0h201v201h-201Z M600 0h201v201h-201Z M-400 600h201v201h-201Z M200 800h201v201h-201Z"
                    stroke-width="0" />
            </svg>
            <rect width="100%" height="100%" stroke-width="0" fill="url(#shadowshowdown-pattern)" />
        </svg>
        <div class="absolute top-10 left-[calc(50%-4rem)] -z-10 transform-gpu blur-3xl sm:left-[calc(50%-18rem)] lg:top-[calc(50%-30rem)] lg:left-48 xl:left-[calc(50%-24rem)]"
            aria-hidden="true">
            <div class="aspect-1108/632 w-[69.25rem] bg-gradient-to-r from-purple-400 to-blue-500 opacity-20"
                style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)">
            </div>
        </div>

        <div class="px-6 pt-10 pb-24 mx-auto max-w-7xl sm:pb-32 lg:flex lg:px-8 lg:py-40">
            <div class="max-w-2xl mx-auto shrink-0 lg:mx-0 lg:pt-8">
                <div class="mt-6 sm:mt-10 lg:mt-8">
                    <span
                        class="px-3 py-1 font-semibold text-purple-400 rounded-full bg-purple-500/10 text-sm/6 ring-1 ring-purple-500/20 ring-inset">New
                        Features</span>
                </div>
                <h1 class="mt-10 text-5xl font-semibold tracking-tight text-white text-pretty sm:text-7xl">Your Ultimate
                    Shadowverse Companion</h1>
                <p class="mt-8 text-lg font-medium text-gray-400 text-pretty sm:text-xl/8">Collect, build, share, and
                    dominate. ShadowShowdown has evolved into your complete Shadowverse toolkit, enabling you to manage
                    your collection, create powerful decks, and connect with the community.</p>
                <div class="flex items-center mt-10 gap-x-6">
                    <a href="{{ route('cards.index') }}"
                        class="rounded-md bg-purple-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-purple-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-400"
                        wire:navigate>Explore Cards</a>
                    <a href="{{ route('decks.create') }}" class="font-semibold text-white text-sm/6" wire:navigate>Build
                        Decks <span aria-hidden="true">→</span></a>
                </div>
            </div>
            <div class="flex max-w-2xl mx-auto mt-16 sm:mt-24 lg:mt-0 lg:mr-0 lg:ml-10 lg:max-w-none xl:ml-32">
                <div class="flex-none max-w-3xl sm:max-w-5xl lg:max-w-none">
                    <img src="{{ asset('landing/cardCollection.png') }}" alt="ShadowShowdown cards collection showcase"
                        width="2432" height="1442"
                        class="w-[76rem] rounded-md bg-white/5 ring-1 shadow-2xl ring-white/10">
                </div>
            </div>
        </div>
    </div>

    <!-- Deck Builder -->
    <div class="pb-24 mt-24 sm:mt-28 sm:pb-28">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto sm:text-center">
                <h2 class="font-semibold text-purple-400 text-base/7">Deck Builder</h2>
                <p
                    class="mt-2 text-4xl font-semibold tracking-tight text-white text-pretty sm:text-5xl sm:text-balance">
                    Your Ultimate Deck Building Tool</p>
                <p class="mt-6 text-gray-300 text-lg/8">Our Deck Builder was designed to help you
                    create and manage powerful decks with ease. We're committed to continuously improving this tool,
                    adding new functionalities and updates to enhance your deck-building experience.</p>
            </div>
        </div>

        <div class="relative pt-16 overflow-hidden">
            <div class="px-6 mx-auto max-w-7xl lg:px-8">
                <img src="{{ asset('landing/deckBuilder.png') }}" alt="Upcoming features preview"
                    class="mb-[-8%] rounded-xl ring-1 shadow-2xl ring-white/10" width="2432" height="1442">
            </div>
        </div>
    </div>

    <!-- Coming Soon Features -->
    <div class="pb-24 mt-24 sm:mt-28 sm:pb-28">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto sm:text-center">
                <h2 class="font-semibold text-purple-400 text-base/7">Coming Soon</h2>
                <p
                    class="mt-2 text-4xl font-semibold tracking-tight text-white text-pretty sm:text-5xl sm:text-balance">
                    Exciting New Features</p>
                <p class="mt-6 text-gray-300 text-lg/8">Stay tuned for our upcoming features that will take your
                    Shadowverse experience to the next level. We're working on innovative tools and enhancements to help
                    you build, manage, and share your decks more efficiently. Keep an eye out for updates!</p>
            </div>
        </div>

        <div class="my-28">
            <div
                class="grid grid-cols-1 gap-10 px-6 mx-auto sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 md:gap-2 max-w-7xl">

                <x-molecules.coming-soon-card title="Card Wishlist"
                    description="Create multiple wishlists of cards you want to acquire for your specific deck builds. Share with ease." />


                <x-molecules.coming-soon-card title="User Profiles"
                    description="Follow users and see their collection, favorite decks, and tournament achievements on their profile." />

                <x-molecules.coming-soon-card title="Social Profiles"
                    description="Create and customize your profile to showcase your collection, favorite decks, and tournament achievements." />

                <x-molecules.coming-soon-card title="Deck Sharing"
                    description="Share your deck creations with the community and discover new strategies from other players." />

                <x-molecules.coming-soon-card title="Card Profile/Analytics"
                    description="Dedicated card profiles with statistics on usage rates, and synergy recommendations for your decks." />
                <x-molecules.coming-soon-card title="Match History" comingSoon
                    description="Track your match history and analyze your performance. See your win/loss ratio and recollect your plays." />

                <x-molecules.coming-soon-card title="Trading Platform" comingSoon
                    description="List cards you're willing to trade. Combines perfectly with our wishlist feature." />

                <x-molecules.coming-soon-card title="Tournament Creator" comingSoon
                    description="Organize and manage your own Shadowverse tournaments with friends or the broader community." />
            </div>
        </div>

        <!-- View More button -->
        <div class="flex justify-center mt-16">
            <a href="{{ route('roadmap') }}"
                class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-white transition-all duration-200 rounded-md group shadow-glow-md bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500"
                wire:navigate>
                <span>View Full Roadmap</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Support Our Team Section -->
    <div class="relative py-32 mt-16">
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-purple-500 to-transparent opacity-70">
            </div>
            <div
                class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-indigo-500 to-transparent opacity-70">
            </div>
        </div>

        <div class="relative px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="font-semibold text-purple-400 text-base/7">Support Our Team</h2>
                <p class="mt-2 text-4xl font-semibold tracking-tight text-white sm:text-5xl sm:text-balance">
                    Help Us Keep the Magic Alive</p>
                <p class="mt-6 text-gray-300 text-lg/8">
                    ShadowShowdown is a passion project created by a small team of dedicated Shadowverse enthusiasts.
                    Your support helps us maintain the servers, develop new features, and continue providing this
                    service to the community.
                </p>

                <div class="flex flex-col justify-center gap-4 mt-10 sm:flex-row">
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-semibold text-white transition-colors bg-purple-500 rounded-md hover:bg-purple-400 shadow-glow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 4.435c-1.989-5.399-12-4.597-12 3.568 0 4.068 3.06 9.481 12 14.997 8.94-5.516 12-10.929 12-14.997 0-8.118-10-8.999-12-3.568z" />
                        </svg>
                        Become a Supporter
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-semibold text-indigo-300 transition-colors rounded-md bg-indigo-500/10 ring-1 ring-indigo-500/30 hover:bg-indigo-500/20 shadow-glow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm7 14c3.313 0 6-2.687 6-6s-2.687-6-6-6-6 2.687-6 6 2.687 6 6 6zm0-2c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z" />
                        </svg>
                        Buy Us a Coffee
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sponsors Section -->
    <div class="relative py-28">
        <!-- Animated background elements -->
        <div class="absolute inset-0 overflow-hidden -z-10">
            <div
                class="absolute transform -translate-x-1/2 -translate-y-1/2 rounded-full top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-purple-800/20 to-indigo-800/20 blur-3xl animate-pulse-slow">
            </div>
            <div
                class="absolute w-64 h-64 rounded-full bottom-1/3 right-1/4 bg-gradient-to-r from-fuchsia-800/20 to-blue-800/20 blur-3xl animate-pulse-slow animation-delay-2000">
            </div>
        </div>

        <div class="relative px-6 mx-auto max-w-7xl lg:px-8">
            <div class="text-center">
                <h2 class="font-semibold text-indigo-400 text-base/7">Our Sponsors</h2>
                <p
                    class="mt-2 text-4xl font-bold tracking-tight text-transparent text-white sm:text-5xl sm:text-balance bg-clip-text bg-gradient-to-r from-purple-400 via-fuchsia-300 to-indigo-400">
                    Powered by Industry Leaders</p>
                <p class="max-w-2xl mx-auto mt-6 text-gray-300 text-lg/8">
                    We're proud to partner with these amazing companies who share our vision for creating the ultimate
                    Shadowverse companion platform.
                </p>
            </div>

            <div class="relative mt-16">
                <!-- Highlight glow behind the sponsors grid -->
                <div
                    class="absolute inset-0 bg-gradient-to-r from-purple-900/0 via-indigo-900/20 to-purple-900/0 rounded-2xl blur-xl">
                </div>

                <!-- Sponsors grid -->
                <div class="relative grid grid-cols-2 gap-8 md:grid-cols-4 lg:grid-cols-5">
                    <!-- Add your sponsor logos here - these are placeholder divs -->
                    <div
                        class="flex items-center justify-center h-24 px-8 transition-colors border bg-black/30 backdrop-blur-sm rounded-xl border-indigo-500/20 hover:border-indigo-500/50">
                        <span class="text-lg font-bold text-indigo-300">Sponsor 1</span>
                    </div>
                    <div
                        class="flex items-center justify-center h-24 px-8 transition-colors border bg-black/30 backdrop-blur-sm rounded-xl border-indigo-500/20 hover:border-indigo-500/50">
                        <span class="text-lg font-bold text-indigo-300">Sponsor 2</span>
                    </div>
                    <div
                        class="flex items-center justify-center h-24 px-8 transition-colors border bg-black/30 backdrop-blur-sm rounded-xl border-indigo-500/20 hover:border-indigo-500/50">
                        <span class="text-lg font-bold text-indigo-300">Sponsor 3</span>
                    </div>
                    <div
                        class="flex items-center justify-center h-24 px-8 transition-colors border bg-black/30 backdrop-blur-sm rounded-xl border-indigo-500/20 hover:border-indigo-500/50">
                        <span class="text-lg font-bold text-indigo-300">Sponsor 4</span>
                    </div>
                    <div
                        class="flex items-center justify-center h-24 px-8 transition-colors border bg-black/30 backdrop-blur-sm rounded-xl border-indigo-500/20 hover:border-indigo-500/50 md:col-span-4 lg:col-span-1">
                        <span class="text-lg font-bold text-indigo-300">Sponsor 5</span>
                    </div>
                </div>

                <!-- Border glow effect -->
                <div
                    class="absolute z-0 hidden border -inset-x-4 -inset-y-4 border-indigo-500/10 rounded-3xl lg:block">
                </div>

                <!-- Corner decorations -->
                <div class="absolute w-6 h-6 border-t-2 border-l-2 -top-2 -left-2 border-indigo-500/50 rounded-tl-md">
                </div>
                <div class="absolute w-6 h-6 border-t-2 border-r-2 -top-2 -right-2 border-indigo-500/50 rounded-tr-md">
                </div>
                <div
                    class="absolute w-6 h-6 border-b-2 border-l-2 -bottom-2 -left-2 border-indigo-500/50 rounded-bl-md">
                </div>
                <div
                    class="absolute w-6 h-6 border-b-2 border-r-2 -bottom-2 -right-2 border-indigo-500/50 rounded-br-md">
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="#"
                    class="inline-flex items-center text-sm font-semibold text-indigo-400 transition-colors hover:text-indigo-300">
                    Become a Sponsor
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Sign In Section -->
    <div class="relative py-24">
        <div class="absolute inset-0 overflow-hidden">
            <!-- Animated particles background (subtle) -->
            <div class="absolute inset-0">
                <div class="absolute w-2 h-2 rounded-full top-1/2 left-1/3 bg-indigo-500/40 animate-float"></div>
                <div
                    class="absolute w-3 h-3 rounded-full top-1/4 left-1/2 bg-purple-500/30 animate-float animation-delay-1000">
                </div>
                <div
                    class="absolute w-2 h-2 rounded-full bottom-1/3 right-1/4 bg-fuchsia-500/30 animate-float animation-delay-2000">
                </div>
                <div
                    class="absolute w-2 h-2 rounded-full bottom-1/4 right-1/3 bg-blue-500/30 animate-float animation-delay-3000">
                </div>
            </div>
        </div>

        <div class="relative px-6 mx-auto max-w-7xl lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="font-semibold text-purple-400 text-base/7">Join Our Community</h2>
                <p class="mt-2 text-3xl font-semibold tracking-tight text-white sm:text-4xl">
                    Sign in to unlock all features</p>
                <p class="mt-6 text-gray-300 text-lg/8">
                    Create your personal collection, build and save your decks, rate cards, and connect with other
                    players.
                </p>

                <div class="flex justify-center mt-10">
                    <x-atoms.google-login-button size="lg"
                        class="inline-block px-6 py-3 text-base font-bold text-white neo-brutal-button pixel-corners">
                        Sign in with Google
                    </x-atoms.google-login-button>
                </div>

                <p class="mt-6 text-sm text-gray-400">
                    No account creation needed. Just sign in with Google and start using ShadowShowdown right away.
                </p>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="px-6 mx-auto mt-32 max-w-7xl sm:mt-56 lg:px-8">
        <div class="max-w-2xl mx-auto lg:mx-0 lg:max-w-xl">
            <h2 class="font-semibold text-purple-400 text-base/8">Our community</h2>
            <p class="mt-2 text-4xl font-semibold tracking-tight text-white text-pretty sm:text-5xl">Join thousands of
                Shadowverse players</p>
            <p class="mt-6 text-gray-300 text-lg/8">ShadowShowdown has become the go-to platform for Shadowverse
                enthusiasts looking to enhance their gameplay, manage their collections, and connect with other players.
            </p>
        </div>
        <dl
            class="grid max-w-2xl grid-cols-1 mx-auto mt-16 text-white gap-x-8 gap-y-10 sm:mt-20 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-4">
            <div class="flex flex-col pl-6 border-l gap-y-3 border-white/10">
                <dt class="text-sm/6">Active players</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight">10,000+</dd>
            </div>
            <div class="flex flex-col pl-6 border-l gap-y-3 border-white/10">
                <dt class="text-sm/6">Cards rated</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight">250,000+</dd>
            </div>
            <div class="flex flex-col pl-6 border-l gap-y-3 border-white/10">
                <dt class="text-sm/6">Decks created</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight">35,000+</dd>
            </div>
            <div class="flex flex-col pl-6 border-l gap-y-3 border-white/10">
                <dt class="text-sm/6">Daily active users</dt>
                <dd class="order-first text-3xl font-semibold tracking-tight">3,000+</dd>
            </div>
        </dl>
    </div>

    <!-- CTA section -->
    <x-organisms.cta-section title="Ready to elevate your Shadowverse experience?"
        description="Join thousands of players using ShadowShowdown to track cards, build decks, and improve their game."
        buttonText="Get Started" buttonLink="/" :buttonWireNavigate="true" />
</x-app-layout>
