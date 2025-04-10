<div x-data='deckBuilder'>
    <div class="container py-6 mx-auto">
        <div class="flex items-center justify-between mb-6">
            @auth
                <div class="flex flex-col items-start" x-data="{ showDeckNameInput: false, showDeckDescInput: false }">
                    <div class="flex items-center">
                        <h1 class="text-3xl font-bold text-purple-100" x-text="$wire.deckName"></h1>
                        <button @click="showDeckNameInput = true" x-show="!showDeckNameInput"
                            class="p-1 ml-2 text-purple-300 transition-colors rounded-full hover:bg-purple-900/50 hover:text-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-2" x-show="showDeckNameInput">
                        <div class="flex items-center">
                            <input type="text" wire:model="deckName"
                                class="px-3 py-1 text-white bg-transparent border-b border-purple-500 focus:border-purple-300 focus:outline-none"
                                placeholder="Deck Name" @blur="showDeckNameInput = false">
                            <button @click="showDeckNameInput = false"
                                class="p-1 ml-2 text-purple-300 transition-colors rounded-full hover:bg-purple-900/50 hover:text-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center mt-1">
                        <p class="text-sm text-purple-300" x-text="$wire.deckDescription || 'No description'"></p>
                        <button @click="showDeckDescInput = true" x-show="!showDeckDescInput"
                            class="p-1 ml-2 text-purple-300 transition-colors rounded-full hover:bg-purple-900/50 hover:text-purple-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-2" x-show="showDeckDescInput">
                        <div class="flex items-center">
                            <input type="text" wire:model="deckDescription"
                                class="px-3 py-1 text-white bg-transparent border-b border-purple-500 focus:border-purple-300 focus:outline-none"
                                placeholder="Deck Description" @blur="showDeckDescInput = false">
                            <button @click="showDeckDescInput = false"
                                class="p-1 ml-2 text-purple-300 transition-colors rounded-full hover:bg-purple-900/50 hover:text-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex-col space-y-4">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('decks.index') }}" wire:navigate
                            class="px-4 py-2 text-sm font-medium text-purple-300 transition-colors rounded-md bg-purple-900/50 hover:bg-purple-800">
                            Cancel
                        </a>
                        <button wire:click.debounce.1000ms="saveDeck"
                            class="px-4 py-2 text-sm font-medium text-white transition-colors bg-purple-700 rounded-md hover:bg-purple-600">
                            Save Deck
                        </button>
                    </div>
                </div>

            @endauth
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Cards Collection Panel - Left -->
            <div class="space-y-4 lg:col-span-1">
                <div class="p-4 border rounded-lg shadow-lg bg-gray-800/50 border-purple-900/50 ">
                    <h2 class="mb-4 text-xl font-bold text-purple-100">Card Collection</h2>

                    <!-- Search Bar -->
                    <div class="mb-4">
                        <x-atoms.search-input wire:model.live.debounce.300ms="search" id="search"
                            placeholder="Search by name or text" class="w-full" small />
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
                    </div>

                    <!-- Card Grid -->
                    <div
                        class="grid grid-cols-2 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-4 max-h-[calc(100vh-100px)] overflow-y-auto">
                        @forelse($cards as $card)
                            <div class="relative z-10 overflow-hidden transition-all duration-300 transform card-container hover:scale-110 hover:z-30"
                                wire:key="card-{{ $card->id }}" x-data="{ showModal: false }">
                                <div class="relative">
                                    <!-- Card Image -->
                                    <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
                                        @click="addCardToDeck({
                                            id: {{ $card->id }},
                                            name: '{{ addslashes($card->name) }}',
                                            cost: '{{ $card->cost }}',
                                            rarity: '{{ $card->rarity }}',
                                            card_type: '{{ $card->cardType->name }}',
                                            sub_type: '{{ $card->sub_type }}',
                                            image: '{{ $card->getImage() }}'
                                        });"
                                        class="object-cover w-full h-auto transition-transform duration-300 cursor-pointer transform-gpu"
                                        style="image-rendering: -webkit-optimize-contrast; backface-visibility: hidden;">

                                    <!-- Info Button -->
                                    <div class="absolute top-1 right-1">
                                        <button type="button" @click="showModal = true"
                                            class="p-1 text-purple-300 transition-colors rounded-full bg-black/80 hover:bg-purple-900/80">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                @if ($loop->last && $cards->hasMorePages())
                                    <div x-data x-intersect="$wire.loadMore()" class="w-full h-4"
                                        id="cards-end-marker">
                                    </div>
                                @endif

                                <!-- Modal -->
                                <template x-teleport="body">
                                    <x-atoms.card-details-modal :card="$card" />
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

                    @if ($cards->hasMorePages())
                        <div wire:loading.remove wire:target="loadMore" class="flex justify-center mt-4">
                            <p class="text-sm text-purple-300 cursor-pointer" wire:click.prevent="loadMore">
                                Scroll to load more cards
                            </p>
                        </div>
                    @endif

                    @if (!$cards->hasMorePages() && count($cards) > 0)
                        <div class="mt-4 text-sm text-center text-purple-300">
                            All cards loaded
                        </div>
                    @endif
                </div>
            </div>

            <!-- Deck Builder Panel - Right -->
            <div class="space-y-4 lg:col-span-2">
                <div class="p-4 border rounded-lg shadow-lg bg-gray-800/50 border-purple-900/50">
                    <!-- Deck Stats Section -->
                    <div class="mb-6">
                        <div class="mb-6">
                            <div x-data="{ showStats: false, showActions: false }" class="mb-4">
                                <div class="flex items-center justify-between cursor-pointer">
                                    <div @click="showStats = !showStats" class="flex items-center space-x-4">
                                        <h2 class="text-xl font-bold text-purple-100">Deck Stats</h2>
                                        <svg class="w-5 h-5 text-purple-300 transition-transform"
                                            :class="showStats ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        @auth
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-medium text-purple-300">Public Deck</span>
                                                <x-atoms.toggle-input wire:model='isPublic' id="deckPublic" />
                                            </div>
                                            <!-- Deck Actions Dropdown -->
                                            <div class="relative">
                                                <button @click="showActions = !showActions"
                                                    class="p-1 text-purple-300 transition-colors rounded-full hover:bg-purple-900/50 hover:text-purple-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                </button>
                                                <div x-show="showActions" @click.away="showActions = false"
                                                    class="absolute right-0 z-50 w-48 mt-2 overflow-hidden bg-gray-800 border border-purple-900 rounded-md shadow-lg">
                                                    <div class="py-1">
                                                        <button @click="$dispatch('open-wishlist-modal')"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-left text-purple-200 hover:bg-purple-900/50">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                            </svg>
                                                            Create Wishlist for this Deck
                                                        </button>
                                                        <button wire:click="copyDeck"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-left text-purple-200 hover:bg-purple-900/50">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                            </svg>
                                                            Copy this Deck
                                                        </button>
                                                    </div>
                                                    <div class="py-1 border-t border-purple-900/50">
                                                        <div class="px-4 py-1 text-xs font-semibold text-red-400">Danger
                                                            Zone</div>
                                                        <button wire:click="deleteDeck"
                                                            wire:confirm="Are you sure you want to delete this deck?"
                                                            class="flex items-center w-full px-4 py-2 text-sm text-left text-red-400 hover:bg-red-900/30">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Delete Deck
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endauth
                                    </div>
                                </div>

                                <div x-show="showStats" x-transition
                                    class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2 lg:grid-cols-3">
                                    <!-- Cost Curve -->
                                    <div class="p-3 rounded-lg bg-gray-900/50">
                                        <h3 class="mb-2 text-sm font-medium text-purple-300">Mana Curve</h3>
                                        <div class="flex items-end h-24 space-x-1">
                                            <template x-for="i in 10" :key="i">
                                                <div class="flex flex-col items-center flex-1">
                                                    <div class="w-full rounded-t bg-purple-900/30"
                                                        :style="{ height: `${calculateCostPercentage(i)}%` }"></div>
                                                    <span class="mt-1 text-xs text-purple-400"
                                                        x-text="i < 10 ? i : '10+'"></span>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Card Types -->
                                    <div class="p-3 rounded-lg bg-gray-900/50">
                                        <h3 class="mb-2 text-sm font-medium text-purple-300">Card Types</h3>
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-purple-400">Follower</span>
                                                <span class="text-xs text-purple-200"
                                                    x-text="getCardTypeCount('Follower')"></span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-purple-400">Spell</span>
                                                <span class="text-xs text-purple-200"
                                                    x-text="getCardTypeCount('Spell')"></span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-purple-400">Amulet</span>
                                                <span class="text-xs text-purple-200"
                                                    x-text="getCardTypeCount('Amulet')"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rarity Distribution -->
                                    <div class="p-3 rounded-lg bg-gray-900/50">
                                        <h3 class="mb-2 text-sm font-medium text-purple-300">Rarity</h3>
                                        <div class="space-y-2">
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-purple-400">Bronze</span>
                                                <span class="text-xs text-purple-200"
                                                    x-text="getRarityCount('Bronze')"></span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-purple-400">Silver</span>
                                                <span class="text-xs text-purple-200"
                                                    x-text="getRarityCount('Silver')"></span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-purple-400">Gold</span>
                                                <span class="text-xs text-purple-200"
                                                    x-text="getRarityCount('Gold')"></span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-purple-400">Legendary</span>
                                                <span class="text-xs text-purple-200"
                                                    x-text="getRarityCount('Legendary')"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Deck Filters -->
                        <div class="mb-6">
                            <div x-data="{ showFilters: false }" class="mb-4">
                                <div class="flex items-center justify-between cursor-pointer">
                                    <div @click="showFilters = !showFilters" class="flex items-center space-x-4">
                                        <h2 class="text-xl font-bold text-purple-100">Deck Filters</h2>
                                        <svg class="w-5 h-5 text-purple-300 transition-transform"
                                            :class="showFilters ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>

                                <div x-show="showFilters" x-transition class="grid grid-cols-4 gap-4 mt-4 space-y-2">
                                    <!-- Card Type Filter -->
                                    <div>
                                        <x-atoms.filter-group label="Card Type" for="cardType">
                                            <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardType"
                                                id="cardType" :options="$cardTypes" emptyOption="All Types" small
                                                class="w-full" />
                                        </x-atoms.filter-group>
                                    </div>

                                    <!-- Card Sub type Filter -->
                                    <div>
                                        <x-atoms.filter-group label="Card SubType" for="cardSubType">
                                            <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardSubType"
                                                id="cardSubType" :options="$cardSubTypes" optionValue="value"
                                                optionLabel="name" emptyOption="All SubTypes" small class="w-full" />
                                        </x-atoms.filter-group>
                                    </div>

                                    <!-- Craft Filter -->
                                    <div>
                                        <x-atoms.filter-group label="Craft" for="craft">
                                            <x-atoms.select-input wire:model.live.debounce.300ms="selectedCraft"
                                                id="craft" :options="$crafts" emptyOption="All Crafts" small
                                                class="w-full" />
                                        </x-atoms.filter-group>
                                    </div>

                                    <!-- Card Set Filter -->
                                    <div>
                                        <x-atoms.filter-group label="Card Set" for="cardSet">
                                            <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardSet"
                                                id="cardSet" :options="$cardSets" emptyOption="All Card Sets" small
                                                class="w-full" />
                                        </x-atoms.filter-group>
                                    </div>

                                    <!-- Cost Filter -->
                                    <div>
                                        <x-atoms.filter-group label="PP Cost" for="cost">
                                            <x-atoms.select-input wire:model.live.debounce.300ms="costFilter"
                                                id="cost" :options="$costs" emptyOption="All Costs" small
                                                class="w-full" />
                                        </x-atoms.filter-group>
                                    </div>

                                    <!-- Rarity Filter -->
                                    <div>
                                        <x-atoms.filter-group label="Rarity" for="rarity">
                                            <x-atoms.select-input wire:model.live.debounce.300ms="rarityFilter"
                                                id="rarity" :options="$rarities" emptyOption="All Rarities" small
                                                class="w-full" />
                                        </x-atoms.filter-group>
                                    </div>

                                    <div class="flex justify-end col-span-full">
                                        <x-atoms.reset-button wire:click="resetFilters" small>
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
                                <span
                                    class="px-3 py-1 text-sm font-medium text-purple-300 rounded-full bg-purple-900/50">
                                    <span x-text="getMainDeckCount()"></span> / 50
                                </span>
                            </div>

                            @if ($errors->any())
                                <x-atoms.alert.danger class="mb-2" :errors="$errors" />
                            @endif

                            <div class="grid grid-cols-5 gap-2 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10">
                                <template x-for="(slot, index) in generateMainDeckSlots()" :key="index">
                                    <div class="aspect-[3/4] relative rounded-md overflow-hidden"
                                        :class="slot.card ? 'border-2 border-purple-500' : 'border border-purple-900/80'"
                                        style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzPgogICAgPHBhdHRlcm4gaWQ9InBhdHRlcm4iIHg9IjAiIHk9IjAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+CiAgICAgIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSI2IiBoZWlnaHQ9IjYiIGZpbGw9IiMyMzFmMzkwMCIgLz4KICAgIDwvcGF0dGVybj4KICA8L2RlZnM+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzEzMTEyMCIgLz4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIiAvPgo8L3N2Zz4=');">
                                        <template x-if="slot.card">
                                            <div class="relative w-full h-full" :key="slot.card.id + '-' + slot.index">
                                                <img :src="slot.card.image" :alt="slot.card.name"
                                                    @click="removeCardFromMainDeck(slot.card.id)"
                                                    class="absolute inset-0 object-cover w-full h-full"
                                                    :class="{ 'filter grayscale': !slot.isOwned }">

                                                <!-- Info button -->
                                                <div x-data="{ showModal: false, card: slot.card }" class="absolute z-10 top-1 right-1">
                                                    <button type="button"
                                                        @click.stop="showModal = true; card = slot.card"
                                                        class="p-1 text-purple-300 transition-colors rounded-full bg-black/80 hover:bg-purple-900/80">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                    <template x-teleport="body">
                                                        <x-atoms.card-details-modal-js />
                                                    </template>
                                                </div>
                                            </div>
                                        </template>
                                        <template x-if="!slot.card">
                                            <div
                                                class="absolute inset-0 flex items-center justify-center text-purple-900/50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Evolution Deck Section -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-purple-100">Evolution Deck</h2>
                            <span class="px-3 py-1 text-sm font-medium text-purple-300 rounded-full bg-purple-900/50">
                                <span x-text="getEvoDeckCount()"></span> / 10
                            </span>
                        </div>

                        <div class="grid grid-cols-5 gap-2 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10">
                            <template x-for="(slot, index) in generateEvoDeckSlots()" :key="index">
                                <div class="aspect-[3/4] relative rounded-md overflow-hidden"
                                    :class="slot.card ? 'border-2 border-purple-500' : 'border border-purple-900/80'"
                                    style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzPgogICAgPHBhdHRlcm4gaWQ9InBhdHRlcm4iIHg9IjAiIHk9IjAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+CiAgICAgIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSI2IiBoZWlnaHQ9IjYiIGZpbGw9IiMyYzFmMzkwMCIgLz4KICAgIDwvcGF0dGVybj4KICA8L2RlZnM+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzEzMTEyMCIgLz4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIiAvPgo8L3N2Zz4=');">
                                    <template x-if="slot.card">
                                        <div class="relative w-full h-full" :key="slot.card.id + '-' + slot.index">
                                            <img :src="slot.card.image" :alt="slot.card.name"
                                                @click="removeCardFromEvoDeck(slot.card.id)"
                                                class="absolute inset-0 object-cover w-full h-full"
                                                :class="{ 'filter grayscale': !slot.isOwned }">

                                            <!-- Info button -->
                                            <div x-data="{ showModal: false, card: slot.card }" class="absolute z-10 top-1 right-1">
                                                <button type="button"
                                                    @click.stop="showModal = true; card = slot.card"
                                                    class="p-1 text-purple-300 transition-colors rounded-full bg-black/80 hover:bg-purple-900/80">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                                <template x-teleport="body">
                                                    <x-atoms.card-details-modal-js />
                                                </template>
                                            </div>
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
                                    </template>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @auth
            <!-- Wishlist Creation Modal -->
            <div x-data="{ showWishlistModal: false }" x-on:open-wishlist-modal.window="showWishlistModal = true">
                <div x-show="showWishlistModal" x-cloak x-trap.noscroll.inert="showWishlistModal"
                    class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black/80"
                    @click.self="showWishlistModal = false" @keydown.escape.window="showWishlistModal = false"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95">
                    <div
                        class="w-full max-w-5xl p-6 mx-4 bg-gray-800 border rounded-lg shadow-xl border-purple-900/50 max-h-[90vh] overflow-y-auto">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-purple-100">Create Wishlist from Deck</h2>
                            <button @click="showWishlistModal = false" class="text-purple-300 hover:text-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <div class="mb-4">
                                    <label for="wishlistTitle"
                                        class="block mb-2 text-sm font-medium text-purple-300">Wishlist Title</label>
                                    <x-atoms.text-input id="wishlistTitle" x-model="$wire.wishlist.title" class="w-full"
                                        placeholder="Enter wishlist title" />
                                </div>

                                <div class="flex items-center space-x-2">
                                    <span class="text-sm font-medium text-purple-300">Public Wishlist</span>
                                    <x-atoms.toggle-input x-model="$wire.wishlist.is_public" id="wishlistPublic" />
                                </div>

                            </div>

                            <div>
                                <h3 class="mb-3 text-lg font-medium text-purple-200">Some cards are already in your
                                    wishlist</h3>

                                <div class="mt-6 text-sm text-purple-300">
                                    <p>This will create a wishlist containing only the cards you don't currently own, based
                                        on your collection.</p>
                                    <p class="mt-2">Each deck can have only one wishlist. If you want to share your
                                        wishlist with others, please ensure it is set to public.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Detailed Cards View (collapsible) -->
                        <div x-data="{ showDetailedCards: false }" class="mb-6">
                            <button @click="showDetailedCards = !showDetailedCards"
                                class="flex items-center space-x-2 text-sm font-medium text-purple-300 hover:text-purple-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform"
                                    :class="showDetailedCards ? 'rotate-90' : ''" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                                <span>Show Detailed Card List</span>
                            </button>

                            <div x-show="showDetailedCards" x-transition class="mt-4 overflow-y-auto">
                                <!-- Main Deck Cards -->
                                <div class="mb-4"
                                    x-show="Object.values($wire.mainDeck).some(c => (c.quantity - (c.owned || 0)) > 0)">
                                    <h4 class="mb-2 text-sm font-medium text-purple-300">Main Deck</h4>
                                    <div
                                        class="grid grid-cols-2 gap-2 p-2 overflow-y-auto rounded-md sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 max-h-64 bg-gray-900/30">
                                        <template x-for="card in Object.values($wire.mainDeck)" :key="card.id">
                                            <template x-if="(card.quantity - (card.owned || 0)) > 0">
                                                <div class="flex flex-col items-center">
                                                    <div class="relative w-16 h-20">
                                                        <img :src="card.image" :alt="card.name"
                                                            class="object-cover w-full h-full rounded">
                                                        <div
                                                            class="absolute bottom-0 right-0 flex items-center justify-center px-2 text-xs font-bold text-white bg-black/70 rounded-xl">
                                                            <span
                                                                x-text="'x' + (card.quantity - (card.owned || 0))"></span>
                                                        </div>
                                                    </div>
                                                    <div class="w-full mt-1 text-xs text-center text-purple-200 truncate"
                                                        :title="card.name" x-text="card.name"></div>
                                                </div>
                                            </template>
                                        </template>
                                    </div>
                                </div>

                                <!-- Evolution Deck Cards -->
                                <div
                                    x-show="Object.values($wire.evolutionDeck).some(c => (c.quantity - (c.owned || 0)) > 0)">
                                    <h4 class="mb-2 text-sm font-medium text-purple-300">Evolution Deck</h4>
                                    <div
                                        class="grid grid-cols-2 gap-2 p-2 overflow-y-auto rounded-md sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 max-h-64 bg-gray-900/30">
                                        <template x-for="card in Object.values($wire.evolutionDeck)"
                                            :key="card.id">
                                            <template x-if="(card.quantity - (card.owned || 0)) > 0">
                                                <div class="flex flex-col items-center">
                                                    <div class="relative w-16 h-20">
                                                        <img :src="card.image" :alt="card.name"
                                                            class="object-cover w-full h-full rounded">
                                                        <div
                                                            class="absolute bottom-0 right-0 flex items-center justify-center px-2 text-xs font-bold text-white bg-black/70 rounded-xl">
                                                            <span
                                                                x-text="'x' + (card.quantity - (card.owned || 0))"></span>
                                                        </div>
                                                    </div>
                                                    <div class="w-full mt-1 text-xs text-center text-purple-200 truncate"
                                                        :title="card.name" x-text="card.name"></div>
                                                </div>
                                            </template>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4 space-x-3 border-t border-purple-900/30">
                            <button @click="showWishlistModal = false"
                                class="px-4 py-2 text-sm font-medium text-purple-300 transition-colors border border-purple-700 rounded-md hover:bg-gray-700">
                                Cancel
                            </button>
                            <button @click="$wire.saveCardsToWishlist(); showWishlistModal = false"
                                class="px-4 py-2 text-sm font-medium text-white transition-colors bg-purple-700 rounded-md hover:bg-purple-600">
                                Save Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endauth

        @script
            <script>
                Alpine.data('deckBuilder', () => ({
                    mainDeck: $wire.mainDeck,
                    evoDeck: $wire.evolutionDeck,

                    init() {
                        this.mainDeck = Object.keys($wire.mainDeck).length > 0 ? $wire.mainDeck : {};
                        this.evoDeck = Object.keys($wire.evolutionDeck).length > 0 ? $wire.evolutionDeck : {};
                    },

                    addCardToDeck(card) {

                        // Check if the card is an evolved card - automatically add to evolution deck
                        if (card.sub_type === 'evolved') {
                            // Check if evolution deck is full
                            if (this.getEvoDeckCount() >= 10) {
                                $wire.dispatch('notify', {
                                    type: 'error',
                                    message: 'Evolution deck cannot have more than 10 cards'
                                });
                                return;
                            }

                            // Check if card is a Leader and we already have a Leader in evo deck
                            if (card.cardType && card.cardType.name === 'Leader') {
                                // Check if we already have a Leader card
                                const hasLeader = Object.values(this.evoDeck).some(deckCard =>
                                    deckCard.card_type === 'Leader');

                                if (hasLeader) {
                                    // If we already have a different Leader
                                    const existingLeader = Object.values(this.evoDeck).find(deckCard =>
                                        deckCard.card_type === 'Leader');

                                    if (existingLeader && existingLeader.id !== card.id) {
                                        $wire.dispatch('show-error', {
                                            message: "You can only have one Leader card in your evolution deck"
                                        });
                                        return;
                                    }

                                    // If we already have this Leader card
                                    if (existingLeader && existingLeader.id === card.id) {
                                        $wire.dispatch('show-error', {
                                            message: "You can only have one copy of each Leader card"
                                        });
                                        return;
                                    }
                                }
                            }

                            const totalCardCountInEvoDeck = Object.values(this.evoDeck).reduce((sum, deckCard) => {
                                return deckCard.name === card.name ? sum + deckCard.quantity : sum;
                            }, 0);

                            // Check if we already have this card in the evolution deck
                            if (!this.evoDeck[card.id] && totalCardCountInEvoDeck < 3) {
                                // Add the card for the first time
                                this.evoDeck[card.id] = {
                                    id: card.id,
                                    name: card.name,
                                    cost: card.cost,
                                    rarity: card.rarity,
                                    card_type: card.card_type,
                                    sub_type: card.sub_type,
                                    quantity: 1,
                                    image: card.image
                                };
                            } else if (this.evoDeck[card.id] && totalCardCountInEvoDeck < 3) {
                                // Increment quantity of this specific card
                                this.evoDeck[card.id].quantity++;
                            } else {
                                $wire.dispatch('show-error', {
                                    message: "You can only have 3 copies of each card"
                                });
                            }
                            return;
                        }

                        // Check if card is a Leader and we already have a Leader
                        if (card.cardType && card.cardType.name === 'Leader') {
                            // Check if we already have a Leader card
                            const hasLeader = Object.values(this.mainDeck).some(deckCard =>
                                deckCard.card_type === 'Leader');

                            if (hasLeader) {
                                // If we already have a different Leader
                                const existingLeader = Object.values(this.mainDeck).find(deckCard =>
                                    deckCard.card_type === 'Leader');

                                if (existingLeader && existingLeader.id !== card.id) {
                                    $wire.dispatch('show-error', {
                                        message: "You can only have one Leader card in your deck"
                                    });
                                    return;
                                }

                                // If we already have this Leader card
                                if (existingLeader && existingLeader.id === card.id) {
                                    $wire.dispatch('show-error', {
                                        message: "You can only have one copy of each Leader card"
                                    });
                                    return;
                                }
                            }
                        }

                        const totalCardCountInDeck = Object.values(this.mainDeck).reduce((sum, deckCard) => {
                            return deckCard.name === card.name ? sum + deckCard.quantity : sum;
                        }, 0);

                        // Check if we already have this card in the deck
                        if (!this.mainDeck[card.id] && totalCardCountInDeck < 3) {
                            // Add the card for the first time
                            this.mainDeck[card.id] = {
                                id: card.id,
                                name: card.name,
                                cost: card.cost,
                                rarity: card.rarity,
                                card_type: card.card_type || (card.cardType ? card.cardType.name : ''),
                                sub_type: card.sub_type,
                                quantity: 1,
                                image: card.image
                            };
                        } else if (this.mainDeck[card.id] && totalCardCountInDeck < 3) {
                            // Increment quantity of this specific card
                            this.mainDeck[card.id].quantity++;
                        } else {
                            $wire.dispatch('show-error', {
                                message: "You can only have 3 copies of each card"
                            });
                        }

                        // Check deck limit
                        const totalCards = this.getMainDeckCount();
                        if (totalCards > 50) {
                            // Decrement the quantity if we just added it
                            if (this.mainDeck[card.id].quantity > 1) {
                                this.mainDeck[card.id].quantity--;
                            } else {
                                delete this.mainDeck[card.id];
                            }

                            $wire.dispatch('notify', {
                                type: 'error',
                                message: 'Main deck cannot have more than 50 cards'
                            });
                            return;
                        }

                        $wire.mainDeck = this.mainDeck;
                        $wire.evolutionDeck = this.evoDeck;
                    },

                    removeCardFromMainDeck(cardId) {
                        if (this.mainDeck[cardId]) {
                            if (this.mainDeck[cardId].quantity > 1) {
                                this.mainDeck[cardId].quantity--;
                            } else {
                                delete this.mainDeck[cardId];
                            }
                        }
                    },

                    removeCardFromEvoDeck(cardId) {
                        if (this.evoDeck[cardId].quantity > 1) {
                            this.evoDeck[cardId].quantity--;
                        } else {
                            delete this.evoDeck[cardId];
                        }
                    },

                    saveDeck() {
                        // Validate deck name
                        if (!$wire.deckName) {
                            $wire.dispatch('notify', {
                                type: 'error',
                                message: 'Please provide a name for your deck'
                            });
                            return false;
                        }

                        // Validate deck size
                        const totalMainDeckCards = this.getMainDeckCount();
                        if (totalMainDeckCards < 40) {
                            $wire.dispatch('notify', {
                                type: 'error',
                                message: 'Your main deck must have at least 40 cards'
                            });
                            return false;
                        }

                        if (totalMainDeckCards > 50) {
                            $wire.dispatch('notify', {
                                type: 'error',
                                message: 'Your main deck cannot have more than 50 cards'
                            });
                            return false;
                        }

                        // Validate that the deck has a Leader card
                        const hasLeader = Object.values(this.mainDeck).some(card => card.sub_type === 'Leader');
                        if (!hasLeader) {
                            $wire.dispatch('notify', {
                                type: 'error',
                                message: 'Your deck must have a Leader card'
                            });
                            return false;
                        }

                        // Sync deck data with Livewire before saving
                        $wire.mainDeck = this.mainDeck;
                        $wire.evolutionDeck = this.evoDeck;

                        // Call the Livewire save method
                        $wire.saveDeck();
                        return true;
                    },

                    getMainDeckCount() {
                        return Object.values(this.mainDeck).reduce((total, current) => total + current.quantity, 0);
                    },

                    getEvoDeckCount() {
                        return Object.values(this.evoDeck).reduce((total, current) => total + current.quantity, 0);
                    },

                    generateMainDeckSlots() {
                        return Array.from({
                            length: 50
                        }, (_, index) => {
                            // Find the card for this slot based on index
                            const deckCards = Object.values(this.mainDeck);
                            let slotCard = null;
                            let currentIndex = 0;
                            let isOwned = false;

                            for (const card of deckCards) {
                                // Calculate where this card ends
                                const cardEndIndex = currentIndex + card.quantity - 1;
                                const cardOwned = card.owned || 0;

                                if (index >= currentIndex && index <= cardEndIndex) {
                                    // Calculate if this specific instance of the card is owned
                                    // If user owns X copies and there are Y copies in deck,
                                    // the first X copies (up to Y) are considered owned
                                    const positionInCardGroup = index - currentIndex;
                                    isOwned = positionInCardGroup < cardOwned;

                                    slotCard = {
                                        ...card
                                    };
                                    break;
                                }
                                currentIndex = cardEndIndex + 1;
                            }

                            return {
                                card: slotCard,
                                index: index,
                                isOwned: isOwned
                            };
                        });
                    },

                    generateEvoDeckSlots() {
                        return Array.from({
                            length: 10
                        }, (_, index) => {
                            const deckCards = Object.values(this.evoDeck);
                            let slotCard = null;
                            let currentIndex = 0;
                            let isOwned = false;

                            for (const card of deckCards) {
                                const cardEndIndex = currentIndex + card.quantity - 1;
                                const cardOwned = card.owned || 0;

                                if (index >= currentIndex && index <= cardEndIndex) {
                                    // Calculate if this specific instance of the card is owned
                                    // If user owns X copies and there are Y copies in deck,
                                    // the first X copies (up to Y) are considered owned
                                    const positionInCardGroup = index - currentIndex;
                                    isOwned = positionInCardGroup < cardOwned;

                                    slotCard = {
                                        ...card
                                    };
                                    break;
                                }
                                currentIndex = cardEndIndex + 1;
                            }

                            return {
                                card: slotCard,
                                index: index,
                                isOwned: isOwned
                            };
                        });
                    },

                    calculateCostPercentage(cost) {
                        // Count cards with this cost
                        const costCards = Object.values(this.mainDeck).filter(card => {
                            return cost < 10 ? parseInt(card.cost) === cost : parseInt(card.cost) >= 10;
                        });

                        // Calculate total cards with this cost
                        const costTotal = costCards.reduce((total, card) => total + card.quantity, 0);

                        // Max height is 100%, min is 5% to always show something if there's at least one card
                        if (costTotal === 0) return 0;

                        // Find the max cost count for scaling
                        const maxCount = Math.max(...Array(11).fill().map((_, i) => {
                            const costCards = Object.values(this.mainDeck).filter(card => {
                                return i < 10 ? parseInt(card.cost) === i : parseInt(card.cost) >=
                                    10;
                            });
                            return costCards.reduce((total, card) => total + card.quantity, 0);
                        }));

                        // Scale the height (5-100%)
                        return maxCount > 0 ? Math.max(5, Math.min(100, (costTotal / maxCount) * 100)) : 0;
                    },

                    getCardTypeCount(type) {
                        const typeCards = Object.values(this.mainDeck).filter(card => card.card_type === type);
                        return typeCards.reduce((total, card) => total + card.quantity, 0);
                    },

                    getRarityCount(rarity) {
                        const rarityCards = Object.values(this.mainDeck).filter(card => card.rarity === rarity);
                        return rarityCards.reduce((total, card) => total + card.quantity, 0);
                    }
                }))
            </script>
        @endscript
    </div>
