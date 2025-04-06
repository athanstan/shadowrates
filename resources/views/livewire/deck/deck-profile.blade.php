<div class="min-h-screen py-12">
    <div class="container px-4 mx-auto">
        <!-- Alert Components -->
        <x-atoms.success-alert position="top-center" />
        <x-atoms.error-alert position="top-center" />

        <div class="flex justify-end mb-4">
            <x-atoms.action-button variant="secondary" href="{{ route('decks.edit', $deck) }}" wire:navigate>
                Edit Deck
            </x-atoms.action-button>
        </div>
        <x-organisms.container.neo-brutal>
            <div class="w-full mb-6">
                <article
                    class="grid grid-cols-1 overflow-hidden duration-300 rounded-2xl group md:grid-cols-8 text-on-surface dark:text-on-surface-dark">
                    <!-- image -->
                    <div class="relative col-span-2 overflow-hidden">
                        <img src="{{ $leaderCard?->getImage() }}"
                            class="object-cover w-full transition duration-700 ease-out h-52 md:h-full group-hover:scale-105"
                            alt="{{ $leaderCard->name }}" />
                        <div class="absolute bottom-0 right-0 px-2 py-1 m-2 text-xs font-bold text-white rounded-md">
                            LEADER
                        </div>
                    </div>
                    <!-- body -->
                    <div class="flex flex-col justify-start col-span-5 p-6">

                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span
                                    class="px-3 py-1 text-sm font-medium text-white rounded-full bg-purple-600/80 backdrop-filter backdrop-blur-sm">{{ $leaderCard->craft->name }}</span>

                                @if ($deck->is_public)
                                    <span
                                        class="px-3 py-1 text-sm font-medium text-white rounded-full bg-gradient-to-r from-purple-600 to-indigo-500 backdrop-filter backdrop-blur-sm">Public</span>
                                @else
                                    <span
                                        class="px-3 py-1 text-sm font-medium text-white rounded-full bg-gradient-to-r from-red-600 to-pink-500 backdrop-filter backdrop-blur-sm">Private</span>
                                @endif
                            </div>
                            <div class="flex items-center w-1/3 space-x-1.5">
                                <div
                                    class="w-full bg-gray-200/80 rounded-full h-2.5 dark:bg-gray-700/80 backdrop-filter backdrop-blur-sm">
                                    <div class="bg-gradient-to-r from-purple-600 to-indigo-500 h-2.5 rounded-full"
                                        style="width: {{ ($deck->cards->count() / 50) * 100 }}%"></div>
                                </div>
                                <span class="text-xs font-medium text-blue-100">{{ $deck->cards->count() }}/50</span>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-balance text-on-surface-strong lg:text-2xl dark:text-on-surface-dark-strong"
                            aria-describedby="articleDescription">{{ $deck->name }}</h3>
                        <p id="articleDescription" class="max-w-lg my-4 text-sm text-pretty">
                            {{ $deck->description }}
                        </p>

                    </div>
                </article>
            </div>
        </x-organisms.container.neo-brutal>

        <!-- Cards List Container -->
        <x-organisms.container.neo-brutal>
            <div class="p-4">
                <x-atoms.section-header title="Cards in Deck" />

                @if ($deck->cards->isEmpty())
                    <div class="py-8 text-center">
                        <p class="text-purple-300">No cards in this deck yet.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 gap-4 divide-y divide-purple-800 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($deck->cards as $card)
                            <div
                                class="flex items-center px-4 py-4 overflow-hidden transition-shadow duration-300 border border-white shadow-lg rounded-2xl group rounded-radius border-outline backdrop-blur-md bg-surface-alt/80 text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt/80 dark:text-on-surface-dark hover:shadow-xl backdrop-filter bg-white/10 dark:bg-black/10">
                                <!-- Card Image (Clickable) -->
                                <div class="flex-shrink-0 w-20 overflow-hidden rounded-lg cursor-pointer h-28"
                                    x-data="{ showModal: false }" @click="showModal = true">
                                    <x-atoms.card-image :card="$card" />

                                    <!-- Modal (reusing card-preview modal logic) -->
                                    <template x-teleport="body">
                                        <div x-show="showModal" x-cloak
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
                                            @click.self="showModal = false" @keydown.escape.window="showModal = false"
                                            x-transition>
                                            <div
                                                class="flex w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg shadow-xl">
                                                <!-- Left side - Card Image -->
                                                <div class="w-1/2 pr-6">
                                                    <x-atoms.card-image :card="$card" :showEvolved="true" />
                                                </div>

                                                <!-- Right side - Card Details -->
                                                <div class="w-1/2 space-y-4">
                                                    <x-atoms.card-header :card="$card" />
                                                    <x-atoms.card-details :card="$card" />

                                                    <div class="pt-4">
                                                        <a href="{{ route('cards.show', $card) }}" wire:navigate>
                                                            <x-atoms.action-button>View Full
                                                                Details</x-atoms.action-button>
                                                        </a>
                                                        <x-atoms.action-button variant="secondary"
                                                            @click="showModal = false">Close</x-atoms.action-button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                <!-- Card Details -->
                                <div class="flex-grow ml-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="flex items-center">
                                                <div
                                                    class="flex items-center justify-center w-6 h-6 mr-2 text-purple-100 bg-purple-800 rounded">
                                                    {{ $card->cost }}
                                                </div>
                                                <a href="{{ route('cards.show', $card) }}"
                                                    class="text-lg font-medium text-purple-100 hover:text-white"
                                                    wire:navigate>
                                                    {{ $card->name }}
                                                </a>
                                            </div>
                                            <div class="mt-1 text-sm text-purple-400">
                                                {{ $card->rarity }} · {{ $card->cardType->name }}
                                                @if ($card->main_type)
                                                    · <span class="capitalize">{{ $card->main_type }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-purple-300">
                                            x{{ $card->pivot->quantity }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </x-organisms.container.neo-brutal>
    </div>
</div>
