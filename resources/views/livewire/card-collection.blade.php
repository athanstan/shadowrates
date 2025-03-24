<div class="container py-6 mx-auto">
    <h1 class="text-3xl font-bold text-center text-purple-100 ">Card Collection</h1>
    <p class="mb-8 text-lg text-center text-purple-300">Browse and manage your card collection.</p>

    <!-- Alert Components -->
    <x-atoms.success-alert position="top-center" />
    <x-atoms.error-alert position="top-center" />

    <!-- Filters Section -->
    <x-molecules.filter-section>
        <!-- Basic Filters -->
        <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-12">
            <!-- Search Bar with Owned Toggle -->
            <div class="md:col-span-6 lg:col-span-6">
                <x-atoms.filter-group label="Search" for="search">
                    <div class="flex items-center w-full space-x-4">
                        <div class="relative flex-grow">
                            <x-atoms.search-input wire:model.live.debounce.300ms="search" id="search"
                                placeholder="Search by name or text" class="w-full" />
                        </div>
                        <div class="flex items-center space-x-2 whitespace-nowrap">
                            <label for="owned" class="text-sm font-medium text-purple-300">Owned</label>
                            <x-atoms.toggle-input wire:model.live.debounce.300ms="ownedFilter" id="owned" />
                        </div>
                    </div>
                </x-atoms.filter-group>
            </div>

            <div class="grid grid-cols-2 gap-4 md:col-span-3 lg:col-span-3">
                <!-- Card Type Filter -->
                <div class="">
                    <x-atoms.filter-group label="Card Type" for="cardType">
                        <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardType" id="cardType"
                            :options="$cardTypes" emptyOption="All Types" class="w-full" />
                    </x-atoms.filter-group>
                </div>
                <!-- Card Sub type Filter -->
                <div class="">
                    <x-atoms.filter-group label="Card SubType" for="cardSubType">
                        <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardSubType" id="cardSubType"
                            :options="$cardSubTypes" optionValue="value" optionLabel="name" emptyOption="All SubTypes"
                            class="w-full" />
                    </x-atoms.filter-group>
                </div>

            </div>

            <!-- Craft Filter -->
            <div class="md:col-span-3 lg:col-span-3">
                <x-atoms.filter-group label="Craft" for="craft">
                    <x-atoms.select-input wire:model.live.debounce.300ms="selectedCraft" id="craft"
                        :options="$crafts" emptyOption="All Crafts" class="w-full" />
                </x-atoms.filter-group>
            </div>
        </div>

        <!-- More Filters Toggle -->
        <div class="mb-4" x-data="{ showMoreFilters: false }" x-init="console.log($wire.cardCollection)">
            <button @click="showMoreFilters = !showMoreFilters"
                class="flex items-center px-4 py-2 text-sm font-medium text-purple-300 transition-colors rounded-md hover:bg-purple-700/50">
                <span x-text="showMoreFilters ? 'Less Filters' : 'More Filters'"></span>
                <svg class="w-4 h-4 ml-2 transition-transform" :class="showMoreFilters ? 'rotate-180' : ''"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Advanced Filters -->
            <div x-show="showMoreFilters" x-transition>
                <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Card Set Filter -->
                    <x-atoms.filter-group label="Card Set" for="cardSet">
                        <x-atoms.select-input wire:model.live.debounce.300ms="selectedCardSet" id="cardSet"
                            :options="$cardSets" emptyOption="All Card Sets" />
                    </x-atoms.filter-group>

                    <!-- Cost Filter -->
                    <x-atoms.filter-group label="PP Cost" for="cost">
                        <x-atoms.select-input wire:model.live.debounce.300ms="costFilter" id="cost"
                            :options="$costs" emptyOption="All Costs" />
                    </x-atoms.filter-group>

                    <!-- Rarity Filter -->
                    <x-atoms.filter-group label="Rarity" for="rarity">
                        <x-atoms.select-input wire:model.live.debounce.300ms="rarityFilter" id="rarity"
                            :options="$rarities" emptyOption="All Rarities" />
                    </x-atoms.filter-group>
                </div>
            </div>
        </div>

        <!-- Sort Options -->
        <div class="flex flex-col items-center justify-between mt-4 sm:flex-row">
            <div class="flex items-center mb-3 space-x-4 sm:mb-0">
                <span class="text-sm font-medium text-purple-300">Sort by:</span>
                <x-atoms.sort-button wire:click="sortBy('name')" :active="$sortBy === 'name'" :direction="$sortDirection">
                    Name
                </x-atoms.sort-button>
                <x-atoms.sort-button wire:click="sortBy('cost')" :active="$sortBy === 'cost'" :direction="$sortDirection">
                    Cost
                </x-atoms.sort-button>
                <x-atoms.sort-button wire:click="sortBy('created_at')" :active="$sortBy === 'created_at'" :direction="$sortDirection">
                    Newest
                </x-atoms.sort-button>
                <x-atoms.sort-button wire:click="$set('perPage', 12)" :active="$perPage === 12">
                    12
                </x-atoms.sort-button>
                <x-atoms.sort-button wire:click="$set('perPage', 24)" :active="$perPage === 24">
                    24
                </x-atoms.sort-button>
                <x-atoms.sort-button wire:click="$set('perPage', 48)" :active="$perPage === 48">
                    48
                </x-atoms.sort-button>
                <x-atoms.sort-button wire:click="$set('perPage', 96)" :active="$perPage === 96">
                    96
                </x-atoms.sort-button>
            </div>

            <div>
                <x-atoms.reset-button wire:click="resetFilters">
                    Reset Filters
                </x-atoms.reset-button>
            </div>
        </div>
    </x-molecules.filter-section>

    <!-- Results Count -->
    <x-molecules.pagination-results :paginator="$cards" />

    <div class="flex justify-end mb-4">
        <x-atoms.button wire:click="saveCardCollection" variant="primary">
            Save Card Collection
        </x-atoms.button>
    </div>

    <!-- Cards Grid -->
    <x-molecules.card-grid>
        @forelse($cards as $card)
            <x-atoms.card-preview :card="$card" collectible />
        @empty
            <x-atoms.empty-state title="No cards found" message="Try adjusting your search or filter criteria">
                <x-slot name="actions">
                    <x-atoms.reset-button wire:click="resetFilters">
                        Reset Filters
                    </x-atoms.reset-button>
                </x-slot>
            </x-atoms.empty-state>
        @endforelse
    </x-molecules.card-grid>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $cards->links() }}
    </div>
</div>
