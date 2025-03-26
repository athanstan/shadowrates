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
                    description="Create a personal wishlist of cards you want to acquire for your collection or specific deck builds." />

                <x-molecules.coming-soon-card title="Match Tracker"
                    description="Record and analyze your match results to track your performance and identify areas for improvement." />

                <x-molecules.coming-soon-card title="Trading Platform"
                    description="List cards you're willing to trade and find others looking to exchange cards with you." />

                <x-molecules.coming-soon-card title="Tournament Creator"
                    description="Organize and manage your own Shadowverse tournaments with friends or the broader community." />

                <x-molecules.coming-soon-card title="Meta Analysis"
                    description="Deep dive into the current meta with statistical analysis, trending decks, and card popularity rankings." />

                <x-molecules.coming-soon-card title="Social Profiles"
                    description="Create and customize your profile to showcase your collection, favorite decks, and tournament achievements." />

                <x-molecules.coming-soon-card title="Deck Sharing"
                    description="Share your deck creations with the community and discover new strategies from other players." />

                <x-molecules.coming-soon-card title="Card Analytics"
                    description="Get detailed statistics on card performance, usage rates, and synergy recommendations for your decks." />
            </div>
        </div>
    </div>

    {{-- <!-- Main Features Section -->
    <div class="px-6 mx-auto mt-26 max-w-7xl sm:mt-32 lg:px-8">
        <div class="max-w-2xl mx-auto lg:text-center">
            <h2 class="font-semibold text-purple-400 text-base/7">Comprehensive Deck Builder</h2>
            <p class="mt-2 text-4xl font-semibold tracking-tight text-white text-pretty sm:text-5xl lg:text-balance">
                Everything you need for Shadowverse mastery</p>
            <p class="mt-6 text-gray-300 text-lg/8">ShadowShowdown brings you a complete suite of tools to enhance your
                Shadowverse experience, from tracking your collection to building competitive decks and connecting with
                other players.</p>
        </div>
        <div class="max-w-2xl mx-auto mt-16 sm:mt-20 lg:mt-24 lg:max-w-none">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                <div class="flex flex-col">
                    <dt class="font-semibold text-white text-base/7">
                        <div class="flex items-center justify-center mb-6 bg-purple-500 rounded-lg size-10">
                            <svg class="text-white size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>
                        </div>
                        Card Collection Manager
                    </dt>
                    <dd class="flex flex-col flex-auto mt-1 text-gray-300 text-base/7">
                        <p class="flex-auto">Track your entire Shadowverse card collection. Easily see what cards you
                            own, what you're missing, and organize them by set, rarity, or faction.</p>
                        <p class="mt-6">
                            <a href="#" class="font-semibold text-purple-400 text-sm/6">Manage Collection <span
                                    aria-hidden="true">→</span></a>
                        </p>
                    </dd>
                </div>
                <div class="flex flex-col">
                    <dt class="font-semibold text-white text-base/7">
                        <div class="flex items-center justify-center mb-6 bg-purple-500 rounded-lg size-10">
                            <svg class="text-white size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 8.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v8.25A2.25 2.25 0 006 16.5h2.25m8.25-8.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-7.5A2.25 2.25 0 018.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 00-2.25 2.25v6" />
                            </svg>
                        </div>
                        Deck Builder
                    </dt>
                    <dd class="flex flex-col flex-auto mt-1 text-gray-300 text-base/7">
                        <p class="flex-auto">Create, save, and share your deck builds with the community. Get insights
                            on card synergies and optimization recommendations for competitive play.</p>
                        <p class="mt-6">
                            <a href="#" class="font-semibold text-purple-400 text-sm/6">Build Decks <span
                                    aria-hidden="true">→</span></a>
                        </p>
                    </dd>
                </div>
                <div class="flex flex-col">
                    <dt class="font-semibold text-white text-base/7">
                        <div class="flex items-center justify-center mb-6 bg-purple-500 rounded-lg size-10">
                            <svg class="text-white size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                            </svg>
                        </div>
                        Community Ratings
                    </dt>
                    <dd class="flex flex-col flex-auto mt-1 text-gray-300 text-base/7">
                        <p class="flex-auto">Rate cards and see the community consensus. Discover undervalued gems and
                            stay ahead of the meta with our powerful rating system.</p>
                        <p class="mt-6">
                            <a href="#" class="font-semibold text-purple-400 text-sm/6">View Ratings <span
                                    aria-hidden="true">→</span></a>
                        </p>
                    </dd>
                </div>
            </dl>
        </div>
    </div> --}}

    {{-- <!-- Trending Cards section -->
    <x-molecules.section-container title="TRENDING CARDS"
        description="See which cards are making waves in the current meta based on our community ratings."
        titleFrom="purple-400" titleVia="blue-500" titleTo="purple-400"
        bgGradient="from-purple-900/10 to-transparent">

        <!-- Trending cards content continues... -->
        <!-- Keep all the trending cards content here -->
    </x-molecules.section-container> --}}

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

    <!-- Community section -->
    <x-molecules.section-container title="JOIN THE COMMUNITY"
        description="Connect with thousands of Shadowverse players around the world. Share strategies, rate cards, and climb the ranking together!"
        titleFrom="indigo-400" titleVia="purple-500" titleTo="indigo-400" padding="py-20">

        <!-- Community section content continues... -->
        <!-- Keep all the community section content here -->
    </x-molecules.section-container>

    <!-- CTA section -->
    <x-organisms.cta-section title="Ready to elevate your Shadowverse experience?"
        description="Join thousands of players using ShadowShowdown to track cards, build decks, and improve their game."
        buttonText="Get Started" buttonLink="/" :buttonWireNavigate="true" />
</x-app-layout>
