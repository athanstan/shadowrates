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
    <div class="mt-24 sm:mt-28">
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

        <div class="px-6 mx-auto mt-16 max-w-7xl sm:mt-20 md:mt-24 lg:px-8">
            <dl
                class="grid max-w-2xl grid-cols-1 mx-auto text-gray-300 gap-x-6 gap-y-10 text-base/7 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 lg:gap-x-8 lg:gap-y-16">
                <div class="relative pl-9">
                    <dt class="inline font-semibold text-white">
                        <svg class="absolute text-purple-500 top-1 left-1 size-5" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        Card Wishlist
                    </dt>
                    <dd class="inline">Create a personal wishlist of cards you want to acquire for your collection or
                        specific deck builds.</dd>
                </div>
                <div class="relative pl-9">
                    <dt class="inline font-semibold text-white">
                        <svg class="absolute text-purple-500 top-1 left-1 size-5" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        Trading Platform
                    </dt>
                    <dd class="inline">List cards you're willing to trade and find others looking to exchange cards
                        with you.</dd>
                </div>
                <div class="relative pl-9">
                    <dt class="inline font-semibold text-white">
                        <svg class="absolute text-purple-500 top-1 left-1 size-5" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z"
                                clip-rule="evenodd" />
                        </svg>
                        Match Tracker
                    </dt>
                    <dd class="inline">Record and analyze your match results to track your performance and identify
                        areas for improvement.</dd>
                </div>
                <div class="relative pl-9">
                    <dt class="inline font-semibold text-white">
                        <svg class="absolute text-purple-500 top-1 left-1 size-5" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M6 3.75A2.75 2.75 0 018.75 1h2.5A2.75 2.75 0 0114 3.75v.443c.572.055 1.14.122 1.706.2C17.053 4.582 18 5.75 18 7.07v3.469c0 1.126-.694 2.191-1.83 2.54-1.952.599-4.024.921-6.17.921s-4.219-.322-6.17-.921C2.694 12.73 2 11.665 2 10.539V7.07c0-1.321.947-2.489 2.294-2.676A41.047 41.047 0 016 4.193V3.75zm6.5 0v.325a41.622 41.622 0 00-5 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25zM10 10a1 1 0 00-1 1v.01a1 1 0 001 1h.01a1 1 0 001-1V11a1 1 0 00-1-1H10z"
                                clip-rule="evenodd" />
                            <path
                                d="M3 15.055v-.684c.126.053.255.1.39.142 2.092.642 4.313.987 6.61.987 2.297 0 4.518-.345 6.61-.987.135-.041.264-.089.39-.142v.684c0 1.347-.985 2.53-2.363 2.686a41.454 41.454 0 01-9.274 0C3.985 17.585 3 16.402 3 15.055z" />
                        </svg>
                        Tournament Creator
                    </dt>
                    <dd class="inline">Organize and manage your own Shadowverse tournaments with friends or the broader
                        community.</dd>
                </div>
                <div class="relative pl-9">
                    <dt class="inline font-semibold text-white">
                        <svg class="absolute text-purple-500 top-1 left-1 size-5" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path
                                d="M15.98 1.804a1 1 0 00-1.96 0l-.24 1.192a1 1 0 01-.784.785l-1.192.238a1 1 0 000 1.962l1.192.238a1 1 0 01.785.785l.238 1.192a1 1 0 001.962 0l.238-1.192a1 1 0 01.785-.785l1.192-.238a1 1 0 000-1.962l-1.192-.238a1 1 0 01-.785-.785l-.238-1.192zM6.949 5.684a1 1 0 00-1.898 0l-.683 2.051a1 1 0 01-.633.633l-2.051.683a1 1 0 000 1.898l2.051.684a1 1 0 01.633.632l.683 2.051a1 1 0 001.898 0l.683-2.051a1 1 0 01.633-.633l2.051-.683a1 1 0 000-1.898l-2.051-.683a1 1 0 01-.633-.633L6.95 5.684z" />
                        </svg>
                        Meta Analysis
                    </dt>
                    <dd class="inline">Deep dive into the current meta with statistical analysis, trending decks, and
                        card popularity rankings.</dd>
                </div>
                <div class="relative pl-9">
                    <dt class="inline font-semibold text-white">
                        <svg class="absolute text-purple-500 top-1 left-1 size-5" viewBox="0 0 20 20"
                            fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                clip-rule="evenodd" />
                        </svg>
                        Social Profiles
                    </dt>
                    <dd class="inline">Create and customize your profile to showcase your collection, favorite decks,
                        and tournament achievements.</dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Main Features Section -->
    <div class="px-6 mx-auto mt-32 max-w-7xl sm:mt-56 lg:px-8">
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
    </div>

    <!-- Trending Cards section -->
    <x-molecules.section-container title="TRENDING CARDS"
        description="See which cards are making waves in the current meta based on our community ratings."
        titleFrom="purple-400" titleVia="blue-500" titleTo="purple-400"
        bgGradient="from-purple-900/10 to-transparent">

        <!-- Trending cards content continues... -->
        <!-- Keep all the trending cards content here -->
    </x-molecules.section-container>



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
