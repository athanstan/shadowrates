<div>
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
                    <button @click.prevent="saveDeck()"
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
                                <x-atoms.sort-button wire:click="sortBy('created_at')" :active="$sortBy === 'created_at'"
                                    :direction="$sortDirection" class="text-xs">
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
                                            @click="addCardToDeck({
                                            id: {{ $card->id }},
                                            name: '{{ addslashes($card->name) }}',
                                            cost: '{{ $card->cost }}',
                                            rarity: '{{ $card->rarity }}',
                                            cardType: { name: '{{ $card->cardType->name }}' },
                                            sub_type: '{{ $card->sub_type }}',
                                            getImage: '{{ $card->getImage() }}'
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

                                    <!-- Modal -->
                                    <template x-teleport="body">
                                        <div x-show="showModal" x-cloak
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
                                            @click.self="showModal = false" @keydown.escape.window="showModal = false"
                                            x-transition>
                                            <div
                                                class="flex w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg shadow-xl">
                                                <!-- Left side - Card Image -->
                                                <div class="w-1/2 pr-6">
                                                    <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
                                                        class="w-full rounded-lg">
                                                </div>

                                                <!-- Right side - Card Details -->
                                                <div class="w-1/2 space-y-4">
                                                    <h2 class="text-2xl font-bold text-purple-100">{{ $card->name }}
                                                    </h2>

                                                    <div class="space-y-2">
                                                        <p class="text-purple-300"><span
                                                                class="font-semibold">Type:</span>
                                                            {{ $card->cardType->name }}
                                                        </p>
                                                        <p class="text-purple-300"><span
                                                                class="font-semibold">Craft:</span>
                                                            {{ $card->craft->name }}
                                                        </p>
                                                        <p class="text-purple-300"><span
                                                                class="font-semibold">Set:</span>
                                                            {{ $card->cardSet->name }}
                                                        </p>
                                                        <p class="text-purple-300"><span
                                                                class="font-semibold">Rarity:</span>
                                                            {{ $card->rarity }}</p>
                                                        <p class="text-purple-300"><span
                                                                class="font-semibold">Cost:</span>
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
                                                            @click="addCardToDeck({
                                                                id: {{ $card->id }},
                                                                name: '{{ addslashes($card->name) }}',
                                                                cost: '{{ $card->cost }}',
                                                                rarity: '{{ $card->rarity }}',
                                                                cardType: { name: '{{ $card->cardType->name }}' },
                                                                sub_type: '{{ $card->sub_type }}',
                                                                getImage: '{{ $card->getImage() }}'
                                                            }); showModal = false"
                                                            class="px-4 py-2 font-semibold text-white transition-colors duration-200 bg-purple-700 rounded hover:bg-purple-600">
                                                            Add to Main Deck
                                                        </button>
                                                        <button type="button"
                                                            @click="addCardToEvoDeck({
                                                                id: {{ $card->id }},
                                                                name: '{{ addslashes($card->name) }}',
                                                                cost: '{{ $card->cost }}',
                                                                rarity: '{{ $card->rarity }}',
                                                                cardType: { name: '{{ $card->cardType->name }}' },
                                                                sub_type: '{{ $card->sub_type }}',
                                                                getImage: '{{ $card->getImage() }}'
                                                            }); showModal = false"
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
                                    <svg class="w-4 h-4 ml-2 transition-transform"
                                        :class="showFilters ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
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
                                <span
                                    class="px-3 py-1 text-sm font-medium text-purple-300 rounded-full bg-purple-900/50">
                                    <span x-text="getMainDeckCount()"></span> / 50
                                </span>
                            </div>

                            <div class="grid grid-cols-5 gap-2 md:grid-cols-10 lg:grid-cols-10 xl:grid-cols-10">
                                <template x-for="(slot, index) in generateMainDeckSlots()" :key="index">
                                    <div class="aspect-[3/4] relative rounded-md overflow-hidden"
                                        :class="slot.card ? 'border-2 border-purple-500' : 'border border-purple-900/80'"
                                        style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzPgogICAgPHBhdHRlcm4gaWQ9InBhdHRlcm4iIHg9IjAiIHk9IjAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgcGF0dGVyblRyYW5zZm9ybT0icm90YXRlKDQ1KSI+CiAgICAgIDxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSI2IiBoZWlnaHQ9IjYiIGZpbGw9IiMyMzFmMzkwMCIgLz4KICAgIDwvcGF0dGVybj4KICA8L2RlZnM+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgZmlsbD0iIzEzMTEyMCIgLz4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3BhdHRlcm4pIiAvPgo8L3N2Zz4=');">
                                        <template x-if="slot.card">
                                            <div>
                                                <img :src="slot.card.image" :alt="slot.card.name"
                                                    class="absolute inset-0 object-cover w-full h-full">
                                                <button type="button" @click="removeCardFromMainDeck(slot.card.id)"
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
                    <div>
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
                                        <div>
                                            <img :src="slot.card.image" :alt="slot.card.name"
                                                class="absolute inset-0 object-cover w-full h-full">
                                            <button type="button" @click="removeCardFromEvoDeck(slot.card.id)"
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
                                    </template>
                                </div>
                            </template>
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
                                <template x-for="i in 10" :key="i">
                                    <div class="flex flex-col items-center flex-1">
                                        <div class="w-full rounded-t bg-purple-900/30"
                                            :style="{ height: `${calculateCostPercentage(i)}%` }"></div>
                                        <span class="mt-1 text-xs text-purple-400" x-text="i < 10 ? i : '10+'"></span>
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
                                    <span class="text-xs text-purple-200" x-text="getCardTypeCount('Spell')"></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-purple-400">Amulet</span>
                                    <span class="text-xs text-purple-200" x-text="getCardTypeCount('Amulet')"></span>
                                </div>
                            </div>
                        </div>

                        <!-- Rarity Distribution -->
                        <div class="p-3 rounded-lg bg-gray-900/50">
                            <h3 class="mb-2 text-sm font-medium text-purple-300">Rarity</h3>
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-purple-400">Bronze</span>
                                    <span class="text-xs text-purple-200" x-text="getRarityCount('Bronze')"></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-purple-400">Silver</span>
                                    <span class="text-xs text-purple-200" x-text="getRarityCount('Silver')"></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-purple-400">Gold</span>
                                    <span class="text-xs text-purple-200" x-text="getRarityCount('Gold')"></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-purple-400">Legendary</span>
                                    <span class="text-xs text-purple-200" x-text="getRarityCount('Legendary')"></span>
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
                    mainDeck: {},
                    evoDeck: {},

                    init() {
                        // Initialize from Livewire data if available
                        this.mainDeck = Object.keys($wire.mainDeck).length > 0 ? $wire.mainDeck : {};
                        this.evoDeck = Object.keys($wire.evolutionDeck).length > 0 ? $wire.evolutionDeck : {};
                    },

                    addCardToDeck(card) {
                        // Check if we already have this card in the deck
                        if (this.mainDeck[card.id]) {
                            // Check card limit based on rarity
                            const currentQuantity = this.mainDeck[card.id].quantity;
                            const maxCopies = (card.rarity === 'Legendary') ? 1 : 3;

                            if (currentQuantity >= maxCopies) {
                                // Show error notification
                                $wire.dispatch('notify', {
                                    type: 'error',
                                    message: `You can't add more than ${maxCopies} copies of this card`
                                });
                                return;
                            }

                            // Increment quantity
                            this.mainDeck[card.id].quantity++;
                        } else {
                            // Add the card to the deck with quantity 1
                            this.mainDeck[card.id] = {
                                id: card.id,
                                name: card.name,
                                cost: card.cost,
                                rarity: card.rarity,
                                card_type: card.cardType.name,
                                quantity: 1,
                                image: card.getImage
                            };
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

                    addCardToEvoDeck(card) {
                        // Check if it's an evolution card
                        if (card.sub_type !== 'Evolved') {
                            $wire.dispatch('notify', {
                                type: 'error',
                                message: 'Only Evolution cards can be added to the Evolution deck'
                            });
                            return;
                        }

                        // Check if we already have this card in the deck
                        if (this.evoDeck[card.id]) {
                            // Check limit (1 copy per evo card)
                            const currentQuantity = this.evoDeck[card.id].quantity;

                            if (currentQuantity >= 1) {
                                $wire.dispatch('notify', {
                                    type: 'error',
                                    message: "You can only have 1 copy of each Evolution card"
                                });
                                return;
                            }

                            // Increment quantity
                            this.evoDeck[card.id].quantity++;
                        } else {
                            // Add the card to the evo deck with quantity 1
                            this.evoDeck[card.id] = {
                                id: card.id,
                                name: card.name,
                                cost: card.cost,
                                rarity: card.rarity,
                                card_type: card.cardType.name,
                                quantity: 1,
                                image: card.getImage
                            };
                        }

                        // Check evolution deck limit
                        const totalCards = this.getEvoDeckCount();
                        if (totalCards > 10) {
                            delete this.evoDeck[card.id];

                            $wire.dispatch('notify', {
                                type: 'error',
                                message: 'Evolution deck cannot have more than 10 cards'
                            });
                            return;
                        }
                    },

                    removeCardFromEvoDeck(cardId) {
                        if (this.evoDeck[cardId]) {
                            if (this.evoDeck[cardId].quantity > 1) {
                                this.evoDeck[cardId].quantity--;
                            } else {
                                delete this.evoDeck[cardId];
                            }
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

                            for (const card of deckCards) {
                                // Calculate where this card ends
                                const cardEndIndex = currentIndex + card.quantity - 1;
                                if (index >= currentIndex && index <= cardEndIndex) {
                                    slotCard = card;
                                    break;
                                }
                                currentIndex = cardEndIndex + 1;
                            }

                            return {
                                card: slotCard,
                                index: index
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

                            for (const card of deckCards) {
                                const cardEndIndex = currentIndex + card.quantity - 1;
                                if (index >= currentIndex && index <= cardEndIndex) {
                                    slotCard = card;
                                    break;
                                }
                                currentIndex = cardEndIndex + 1;
                            }

                            return {
                                card: slotCard,
                                index: index
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
</div>
