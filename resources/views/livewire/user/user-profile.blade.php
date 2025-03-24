<div class="container px-4 mx-auto">
    <!-- Profile Header -->
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
                        <p class="text-gray-400">Member since {{ $user->created_at->format('F Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Stats Section -->
    <x-molecules.section-heading title="Player Stats" subtitle="Game performance and collection statistics" />
    <div class="mb-8">
        <x-atoms.neo-brutal-panel>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-purple-400">{{ $user->cards->count() }}</div>
                    <div class="text-gray-400">Cards in Collection</div>
                </div>
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-indigo-400">{{ $user->decks->count() }}</div>
                    <div class="text-gray-400">Decks Created</div>
                </div>
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-blue-400">{{ $user->ratings->count() }}</div>
                    <div class="text-gray-400">Ratings Submitted</div>
                </div>
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-teal-400">{{ $user->created_at->diffInDays() }}</div>
                    <div class="text-gray-400">Days as Member</div>
                </div>
            </div>
        </x-atoms.neo-brutal-panel>
    </div>

    <!-- Decks Collection Section -->
    <x-molecules.section-heading title="Deck Collection" subtitle="Player's constructed decks" action-text="View All"
        action-url="#" />
    <div class="mb-8">
        @if ($decks->count() > 0)
            <x-molecules.deck-grid>
                @foreach ($decks as $deck)
                    <x-atoms.deck-preview :deck="$deck" />
                @endforeach
            </x-molecules.deck-grid>
        @else
            <x-atoms.empty-state message="No decks created yet" />
        @endif
    </div>

    <!-- Recent Cards Section -->
    <x-molecules.section-heading title="Recent Cards" subtitle="Recently added to collection" action-text="View All"
        action-url="#" />
    <div class="mb-8">
        @if ($cards->count() > 0)
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ($cards as $card)
                    <x-atoms.card-preview :card="$card" />
                @endforeach
            </div>
        @else
            <x-atoms.empty-state message="No cards in collection yet" />
        @endif
    </div>

    <!-- Recent Ratings Section -->
    <x-molecules.section-heading title="Recent Ratings" subtitle="Player's latest card ratings" />
    <div class="mb-8">
        @if ($ratings->count() > 0)
            <x-atoms.neo-brutal-panel>
                <div class="divide-y divide-gray-700">
                    @foreach ($ratings as $rating)
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 mr-4">
                                    <img src="{{ $rating->card->image_url }}" alt="{{ $rating->card->name }}"
                                        class="w-12 h-12 rounded">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-medium text-white">{{ $rating->card->name }}</h3>
                                    <div class="mt-1">
                                        <x-atoms.star-rating :rating="$rating->value" readonly />
                                    </div>
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{ $rating->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </x-atoms.neo-brutal-panel>
        @else
            <x-atoms.empty-state message="No ratings submitted yet" />
        @endif
    </div>
</div>
