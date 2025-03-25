<div class="container px-4 mx-auto" x-data="userProfile">
    <x-atoms.neo-brutal-panel class="my-8">
        <!-- Profile Header Section -->
        <div class="mb-8">
            <div class="overflow-hidden bg-gray-900 border border-purple-900 rounded-lg shadow-md">
                <div class="px-6 py-8">
                    <div class="flex flex-col items-center md:flex-row md:items-start">
                        <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                            <img class="object-cover w-24 h-24 p-1 rounded-lg pixel-corners" src="{{ $user->avatar }}"
                                alt="{{ $user->name }}" style="image-rendering: pixelated;">
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                            <p class="text-gray-400">Member since {{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Stats Section -->
        <x-molecules.section-heading title="Player Stats" subtitle="Game performance and collection statistics" />
        <div class="mb-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-purple-400">{{ $user->cards_count }}</div>
                    <div class="text-gray-400">Cards in Collection</div>
                </div>
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-indigo-400">{{ $user->decks_count }}</div>
                    <div class="text-gray-400">Decks Created</div>
                </div>
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-blue-400">{{ (int) $user->created_at->diffInDays(null, true) }}
                    </div>
                    <div class="text-gray-400">Days as Member</div>
                </div>
            </div>
        </div>
    </x-atoms.neo-brutal-panel>

    <!-- Decks Collection Section -->
    <div class="mb-8" x-data="{ showAllDecks: false }">
        <x-molecules.section-heading title="Deck Collection" subtitle="Player's constructed decks"
            action-text="Show All" @click="showAllDecks = !showAllDecks" />

        <div class="grid grid-cols-1 gap-4">
            @foreach ($user->decks as $index => $deck)
                <div class="relative group" x-data="{ expanded: false }">
                    <div
                        :class="{
                            'opacity-40': !showAllDecks && {{ $index }} >= 6,
                            ' shadow-purple-900/30': !
                                expanded
                        }">
                        <x-atoms.neo-brutal-panel class="p-4">
                            <div class="p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-xl font-bold text-white">{{ $deck->name }}</h3>
                                    <button @click="expanded = !expanded"
                                        class="px-3 py-1 text-sm text-white bg-purple-600 rounded-md hover:bg-purple-700 focus:outline-none">
                                        <span x-text="expanded ? 'Collapse' : 'Expand'"></span>
                                    </button>
                                </div>
                                <p class="text-gray-400">{{ $deck->description }}</p>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-gray-400">{{ $deck->cards->count() }} cards</span>
                                </div>
                                <div class="relative grid grid-cols-10 gap-2 transition-all duration-300"
                                    :class="{
                                        'h-auto': expanded,
                                        'h-40 overflow-hidden shadow-purple-900/30': !
                                            expanded
                                    }">
                                    @foreach ($deck->cards as $card)
                                        <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
                                            class="w-full h-auto rounded">
                                    @endforeach
                                    <div x-show="!expanded"
                                        class="absolute inset-x-0 bottom-0 h-8 bg-gradient-to-t from-gray-900 to-transparent">
                                    </div>
                                </div>

                            </div>
                        </x-atoms.neo-brutal-panel>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Cards Section -->
    <div class="mb-8" x-data="{ currentSlide: 0 }">
        <x-molecules.section-heading title="Recent Cards" subtitle="Last 20 cards added to collection" />

        <div class="relative" x-data="{ expandedView: false }">
            <div class="overflow-hidden" :class="expandedView ? 'h-auto' : 'h-64 shadow-lg shadow-purple-900/30'">
                <div class="flex transition-transform duration-300 ease-in-out"
                    :style="{ transform: `translateX(-${currentSlide * 100}%)` }">
                    @foreach ($user->cards as $card)
                        <div class="flex-none w-1/5 px-2">
                            <div class="relative group">
                                <div
                                    class="overflow-hidden transition-all duration-300 transform bg-gray-900 border border-purple-900 rounded-lg shadow-lg hover:scale-105">
                                    <div class="h-48" x-data="{ expanded: false }">
                                        <img src="{{ $card->image_url }}" alt="{{ $card->name }}"
                                            class="object-cover w-full" :class="expanded ? 'h-auto' : 'h-48'">
                                        <div
                                            class="absolute inset-0 flex flex-col justify-between p-4 transition-opacity bg-black bg-opacity-50 opacity-0 group-hover:opacity-100">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-bold text-white">{{ $card->name }}</h4>
                                                <button @click="expanded = !expanded"
                                                    class="px-2 py-1 text-sm text-white bg-purple-600 rounded hover:bg-purple-700">
                                                    <span x-text="expanded ? 'Close' : 'View'"></span>
                                                </button>
                                            </div>
                                            <p class="text-sm text-gray-300">Added
                                                {{ $card->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex justify-center mt-2">
                <button @click="expandedView = !expandedView"
                    class="px-4 py-2 text-sm text-white transition-colors bg-purple-600 rounded-md hover:bg-purple-700">
                    <span x-text="expandedView ? 'Show Less' : 'Show More'"></span>
                </button>
            </div>
        </div>
    </div>
</div>
