<div class="container px-4 mx-auto">
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

    <!-- Decks Collection Section @TODO: add this section to the Deck Profile Page -->
    {{-- <div class="mb-8" x-data="{ showAllDecks: false }">
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
    </div> --}}

    <!-- Decks Section -->
    <div class="mt-16 mb-16">
        <x-molecules.section-heading :title="$user->name . '\'s Decks'" subtitle="See more details about each deck" />

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach ($user->decks as $deck)
                @if ($deck->getLeaderCard() !== null)
                    <x-cards.leader :leader="$deck->getLeaderCard()" :craft="$deck->getLeaderCard()->craft->name" :title="$deck->name" :description="$deck->description"
                        :count="$deck->cards_count" :deckUrl="route('decks.show', $deck)" />
                @endif
            @endforeach
        </div>
    </div>

    <!-- Recent Cards Section -->
    <div class="mt-16 mb-16 ">
        <x-molecules.section-heading title="Recent Cards" subtitle="Last 20 cards added to collection" />

        <x-molecules.card-grid>
            @forelse($user->cards as $card)
                <x-atoms.card-preview :card="$card" />
            @empty
            @endforelse
        </x-molecules.card-grid>
    </div>
</div>
