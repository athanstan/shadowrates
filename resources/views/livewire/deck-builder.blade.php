<div x-data='deckBuilder'>
    <div class="container py-6 mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <h1 class="text-3xl font-bold text-purple-100">{{ $deckName }}</h1>
                <div class="relative ml-4">
                    <input type="text" wire:model.live="deckName"
                        class="px-3 py-1 text-white bg-transparent border-b border-purple-500 focus:border-purple-300 focus:outline-none"
                        placeholder="Deck Name">
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('decks.index') }}" wire:navigate
                    class="px-4 py-2 text-sm font-medium text-purple-300 transition-colors rounded-md bg-purple-900/50 hover:bg-purple-800">
                    Cancel
                </a>
                <button
                    class="px-4 py-2 text-sm font-medium text-white transition-colors bg-purple-700 rounded-md hover:bg-purple-600">
                    Save Deck
                </button>
            </div>
        </div>

        <!-- Alert Components -->
        <x-atoms.success-alert position="top-center" />
        <x-atoms.error-alert position="top-center" />

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Cards Collection Panel - Left -->
            <div class="space-y-4 lg:col-span-1">
                <div class="p-4 border rounded-lg shadow-lg bg-gray-800/50 border-purple-900/50">
                    <h2 class="mb-4 text-xl font-bold text-purple-100">Card Collection</h2>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <x-atoms.search-input wire:model.live.debounce.300ms="search" id="search"
                            placeholder="Search by name or text" class="w-full" />
                    </div>

                    <!-- Sort Options -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-medium text-purple-300">Sort:</span>
                            <x-atoms.sort-button wire:click="sortBy('name')" :active="$sortBy === 'name'" :direction="$sortDirection"
                                class="text-xs">
                                Name
                            </x-atoms.sort-button>
                            <x-atoms.sort-button wire:click="sortBy('cost')" :active="$sortBy === 'cost'" :direction="$sortDirection"
                                class="text-xs">
                                Cost
                            </x-atoms.sort-button>
                            <x-atoms.sort-button wire:click="sortBy('created_at')" :active="$sortBy === 'created_at'" :direction="$sortDirection"
                                class="text-xs">
                                New
                            </x-atoms.sort-button>
                        </div>

                        <div class="flex items-center space-x-1">
                            <x-atoms.sort-button wire:click="$set('perPage', 12)" :active="$perPage === 12" class="text-xs">
                                12
                            </x-atoms.sort-button>
                            <x-atoms.sort-button wire:click="$set('perPage', 24)" :active="$perPage === 24" class="text-xs">
                                24
                            </x-atoms.sort-button>
                            <x-atoms.sort-button wire:click="$set('perPage', 48)" :active="$perPage === 48" class="text-xs">
                                48
                            </x-atoms.sort-button>
                        </div>
                    </div>

                    <!-- Card Grid -->
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-4">
                        @forelse($cards as $card)
                            <div class="relative z-10 overflow-hidden transition-all duration-300 transform card-container hover:scale-110 hover:z-30"
                                wire:key="card-{{ $card->id }}" x-data="{ showModal: false }">
                                <div class="relative">
                                    <!-- Card Image -->
                                    <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
                                        class="object-cover w-full h-auto transition-transform duration-300 cursor-pointer transform-gpu"
                                        style="image-rendering: -webkit-optimize-contrast; backface-visibility: hidden;">

                                    <!-- Info Button -->
                                    <div class="absolute top-1 right-1">
                                        <button type="button" @click="showModal = true"
                                            class="p-1 text-purple-300 transition-colors rounded-full bg-black/80 hover:bg-purple-900/80">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <template x-teleport="body">
                                    <div x-show="showModal" x-cloak
                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
                                        @click.self="showModal = false" @keydown.escape.window="showModal = false"
                                        x-transition>
                                        <div class="flex w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg shadow-xl">
                                            <!-- Left side - Card Image -->
                                            <div class="w-1/2 pr-6">
                                                <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
                                                    class="w-full rounded-lg">
                                            </div>

                                            <!-- Right side - Card Details -->
                                            <div class="w-1/2 space-y-4">
                                                <h2 class="text-2xl font-bold text-purple-100">{{ $card->name }}</h2>

                                                <div class="space-y-2">
                                                    <p class="text-purple-300"><span class="font-semibold">Type:</span>
                                                        {{ $card->cardType->name }}
                                                    </p>
                                                    <p class="text-purple-300"><span class="font-semibold">Craft:</span>
                                                        {{ $card->craft->name }}
                                                    </p>
                                                    <p class="text-purple-300"><span class="font-semibold">Set:</span>
                                                        {{ $card->cardSet->name }}
                                                    </p>
                                                    <p class="text-purple-300"><span
                                                            class="font-semibold">Rarity:</span>
                                                        {{ $card->rarity }}</p>
                                                    <p class="text-purple-300"><span class="font-semibold">Cost:</span>
                                                        {{ $card->cost }} PP</p>

                                                    @if ($card->traits)
                                                        <p class="text-purple-300"><span
                                                                class="font-semibold">Traits:</span>
                                                            {{ $card->traits }}
                                                        </p>
                                                    @endif

                                                    @if ($card->cardType && $card->cardType->name === 'Follower')
                                                        <div class="pt-2 border-t border-purple-700">
                                                            <p class="text-purple-300"><span
                                                                    class="font-semibold">Stats:</span>
                                                                {{ $card->atk }}/{{ $card->health }}</p>
                                                            @if ($card->evolved_atk && $card->evolved_health)
                                                                <p class="text-purple-300"><span
                                                                        class="font-semibold">Evolved:</span>
                                                                    {{ $card->evolved_atk }}/{{ $card->evolved_health }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    @if ($card->effects)
                                                        <div class="pt-2 border-t border-purple-700">
                                                            <p class="font-semibold text-purple-200">Effect:</p>
                                                            <p class="text-purple-300">{!! $card->effects !!}</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="flex pt-4 space-x-2">
                                                    <button type="button"
                                                        @click="addCardToDeck({{ $card->id }}, '{{ $card->cardSubType ? $card->cardSubType->name : '' }}')"
                                                        class="px-4 py-2 font-semibold text-white transition-colors duration-200 bg-purple-700 rounded hover:bg-purple-600">
                                                        Add to Main Deck
                                                    </button>
                                                    <button type="button"
                                                        @click="addCardToEvoDeck({{ $card->id }})"
                                                        class="px-4 py-2 font-semibold text-white transition-colors duration-200 bg-purple-700 rounded hover:bg-purple-600">
                                                        Add to Evo Deck
                                                    </button>
                                                    <button @click="showModal = false"
                                                        class="px-4 py-2 font-semibold text-purple-200 transition-colors duration-200 bg-transparent border border-purple-700 rounded hover:bg-purple-700/30">
                                                        Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <x-atoms.empty-state title="No cards found"
                                    message="Try adjusting your search or filter criteria">
                                    <x-slot name="actions">
                                        <x-atoms.reset-button wire:click="resetFilters">
                                            Reset Filters
                                        </x-atoms.reset-button>
                                    </x-slot>
                                </x-atoms.empty-state>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $cards->links() }}
                    </div>
                </div>
            </div>

            <!-- Deck Builder Panel - Right -->
            <div class="space-y-4 lg:col-span-2">
                <div class="p-4 border rounded-lg shadow-lg bg-gray-800/50 border-purple-900/50">
                    <!-- Deck Filters -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-purple-100">Deck Filters</h2>
                        </div>
                        <!-- Filters Section -->
                        <div x-data="{ showFilters: false }">
                            <button @click="showFilters = !showFilters"
                                class="flex items-center w-full px-3 py-2 mb-3 text-sm font-medium text-purple-300 transition-colors rounded-md bg-purple-900/30 hover:bg-purple-900/50">
                                <span x-text="showFilters ? 'Hide Filters' : 'Show Filters'"></span>
                                <svg class="w-4 h-4 ml-2 transition-transform" :class="showFilters ? 'rotate-180' : ''"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="showFilters" x-transition class="mb-4 space-y-3">
                                <!-- Card Type Filter -->
                                <div>
                                    <x-atoms.filter-group label="Card Type" for="cardType">
                                        <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardType"
                                            id="cardType" :options="$cardTypes" emptyOption="All Types"
                                            class="w-full" />
                                    </x-atoms.filter-group>
                                </div>

                                <!-- Card Sub type Filter -->
                                <div>
                                    <x-atoms.filter-group label="Card SubType" for="cardSubType">
                                        <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardSubType"
                                            id="cardSubType" :options="$cardSubTypes" optionValue="value"
                                            optionLabel="name" emptyOption="All SubTypes" class="w-full" />
                                    </x-atoms.filter-group>
                                </div>

                                <!-- Craft Filter -->
                                <div>
                                    <x-atoms.filter-group label="Craft" for="craft">
                                        <x-atoms.select-input wire:model.live.debounce.300ms="selectedCraft"
                                            id="craft" :options="$crafts" emptyOption="All Crafts"
                                            class="w-full" />
                                    </x-atoms.filter-group>
                                </div>

                                <!-- Card Set Filter -->
                                <div>
                                    <x-atoms.filter-group label="Card Set" for="cardSet">
                                        <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardSet"
                                            id="cardSet" :options="$cardSets" emptyOption="All Card Sets"
                                            class="w-full" />
                                    </x-atoms.filter-group>
                                </div>

                                <!-- Cost Filter -->
                                <div>
                                    <x-atoms.filter-group label="PP Cost" for="cost">
                                        <x-atoms.select-input wire:model.live.debounce.300ms="costFilter"
                                            id="cost" :options="$costs" emptyOption="All Costs"
                                            class="w-full" />
                                    </x-atoms.filter-group>
                                </div>

                                <!-- Rarity Filter -->
                                <div>
                                    <x-atoms.filter-group label="Rarity" for="rarity">
                                        <x-atoms.select-input wire:model.live.debounce.300ms="rarityFilter"
                                            id="rarity" :options="$rarities" emptyOption="All Rarities"
                                            class="w-full" />
                                    </x-atoms.filter-group>
                                </div>

                                <div class="flex justify-end">
                                    <x-atoms.reset-button wire:click="resetFilters">
                                        Reset Filters
                                    </x-atoms.reset-button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Deck Section -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-purple-100">Main Deck</h2>
                            <span class="px-3 py-1 text-sm font-medium text-purple-300 rounded-full bg-purple-900/50">
                                <span x-text="0"></span> / 50
                            </span>
                        </div>

                        <div class="grid grid-cols-5 gap-2 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10">
                            {{-- <template x-for="(slot, index) in generateMainDeckSlots()" :key="index">
                                <div class="aspect-[3/4] relative rounded-md overflow-hidden"
                                    :class="slot.card ? 'border-2 border-purple-500' : 'border border-purple-900/80'"
                                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzPgogICAgPHBhdHRlcm4gaWQ9InBhdHRlcm4iIHg9IjAiIHk9IjAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+CiAgICAgIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSI2IiBoZWlnaHQ9IjYiIGZpbGw9IiMyMzFmMzkwMCIgLz4KICAgIDwvcGF0dGVybj4KICA8L2RlZnM+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzEzMTEyMCIgLz4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIiAvPgo8L3N2Zz4=');">
                                    <template x-if="slot.card">
                                        <div>
                                            <img :src="slot.card.image" :alt="slot.card.name"
                                                class="absolute inset-0 object-cover w-full h-full">
                                            <button type="button"
                                                class="absolute top-0 right-0 z-10 p-1 text-white bg-red-800/80 rounded-bl-md hover:bg-red-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </template>
                                    <template x-if="!slot.card">
                                        <div
                                            class="absolute inset-0 flex items-center justify-center text-purple-900/50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </div>
                                    </template> --}}
                        </div>
                        </template>
                    </div>
                </div>

                <!-- Evolution Deck Section -->
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-purple-100">Evolution Deck</h2>
                        <span class="px-3 py-1 text-sm font-medium text-purple-300 rounded-full bg-purple-900/50">
                            <span x-text="0"></span> / 10
                        </span>
                    </div>

                    <div class="grid grid-cols-5 gap-2 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10">
                        {{-- <template x-for="(slot, index) in generateEvoDeckSlots()" :key="index">
                            <div class="aspect-[3/4] relative rounded-md overflow-hidden"
                                :class="slot.card ? 'border-2 border-purple-500' : 'border border-purple-900/80'"
                                style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzPgogICAgPHBhdHRlcm4gaWQ9InBhdHRlcm4iIHg9IjAiIHk9IjAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+CiAgICAgIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSI2IiBoZWlnaHQ9IjYiIGZpbGw9IiMyYzFmMzkwMCIgLz4KICAgIDwvcGF0dGVybj4KICA8L2RlZnM+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzEzMTEyMCIgLz4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIiAvPgo8L3N2Zz4=');">
                                <template x-if="slot.card">
                                    <div>
                                        <img :src="slot.card.image" :alt="slot.card.name"
                                            class="absolute inset-0 object-cover w-full h-full">
                                        <button type="button" @click="removeCardFromEvoDeck(slot.card.id, index)"
                                            class="absolute top-0 right-0 z-10 p-1 text-white bg-red-800/80 rounded-bl-md hover:bg-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                                <template x-if="!slot.card">
                                    <div class="absolute inset-0 flex items-center justify-center text-purple-900/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                </template>
                            </div>
                        </template> --}}
                    </div>
                </div>
            </div>

            <!-- Deck Stats Panel -->
            <div class="p-4 border rounded-lg shadow-lg bg-gray-800/50 border-purple-900/50">
                <h2 class="mb-4 text-xl font-bold text-purple-100">Deck Stats</h2>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Cost Curve -->
                    <div class="p-3 rounded-lg bg-gray-900/50">
                        <h3 class="mb-2 text-sm font-medium text-purple-300">Mana Curve</h3>
                        <div class="flex items-end h-24 space-x-1">
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-full rounded-t bg-purple-900/30"
                                        style="height: {{ min(100, rand(10, 90)) }}%"></div>
                                    <span class="mt-1 text-xs text-purple-400">{{ $i < 10 ? $i : '10+' }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <!-- Card Types -->
                    <div class="p-3 rounded-lg bg-gray-900/50">
                        <h3 class="mb-2 text-sm font-medium text-purple-300">Card Types</h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-purple-400">Follower</span>
                                <span class="text-xs text-purple-200">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-purple-400">Spell</span>
                                <span class="text-xs text-purple-200">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-purple-400">Amulet</span>
                                <span class="text-xs text-purple-200">0</span>
                            </div>
                        </div>
                    </div>

                    <!-- Rarity Distribution -->
                    <div class="p-3 rounded-lg bg-gray-900/50">
                        <h3 class="mb-2 text-sm font-medium text-purple-300">Rarity</h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-purple-400">Bronze</span>
                                <span class="text-xs text-purple-200">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-purple-400">Silver</span>
                                <span class="text-xs text-purple-200">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-purple-400">Gold</span>
                                <span class="text-xs text-purple-200">0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-purple-400">Legendary</span>
                                <span class="text-xs text-purple-200">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @script
        <script>
            Alpine.data('deckBuilder', () => ({
                open: false,
                mainDeck: $wire.mainDeck,
                evolutionDeck: $wire.evolutionDeck,

                init() {
                    console.log(this.mainDeck)
                    console.log(this.evolutionDeck)
                },

                generateMainDeckSlots() {
                    return this.mainDeck.map(card => ({
                        card: card,
                        quantity: this.mainDeck[card]
                    }))
                },

                toggle() {
                    this.open = !this.open
                },
            }))
        </script>
    @endscript
</div>
