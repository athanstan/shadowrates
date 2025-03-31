<div class="min-h-screen py-12">
    <div class="container px-4 mx-auto">
        <!-- Alert Components -->
        <x-atoms.success-alert position="top-center" />
        <x-atoms.error-alert position="top-center" />

        <!-- Epic Banner with Leader Card and Deck Info -->
        <div
            class="relative mb-8 overflow-hidden shadow-2xl rounded-3xl shadow-purple-900/50 bg-gradient-to-r from-purple-950 to-indigo-950">
            <div class="absolute inset-0 opacity-20 bg-[url('https://via.placeholder.com/1920x400')] bg-center bg-cover">
            </div>
            <div class="relative z-10 flex flex-col items-center p-6 md:flex-row md:p-8">
                <!-- Leader Card -->
                <div
                    class="w-full mb-6 transition-transform duration-500 transform md:w-1/3 lg:w-1/4 md:mb-0 hover:scale-105">
                    @if ($leaderCard)
                        <div class="overflow-hidden shadow-lg rounded-2xl shadow-purple-900">
                            <x-atoms.card-image :card="$leaderCard" :showEvolved="true" />
                        </div>
                    @else
                        <div
                            class="flex items-center justify-center h-64 border-2 border-purple-700 border-dashed bg-purple-900/50 rounded-2xl">
                            <span class="text-lg text-purple-300">No Leader Card</span>
                        </div>
                    @endif
                </div>

                <!-- Deck Info -->
                <div class="w-full text-center md:w-2/3 lg:w-3/4 md:pl-8 md:text-left">
                    <h1 class="mb-4 text-4xl font-bold text-white md:text-5xl text-shadow-lg">{{ $deck->name }}</h1>

                    <div class="flex flex-wrap items-center justify-center gap-4 mb-4 md:justify-start">
                        @if ($deck->craft)
                            <span class="px-3 py-1.5 rounded-full bg-purple-700/70 text-purple-100 font-medium">
                                {{ $deck->craft->name }}
                            </span>
                        @endif
                        <span class="px-3 py-1.5 rounded-full bg-blue-700/70 text-blue-100 font-medium">
                            @if ($deck->format === 1)
                                Rotation
                            @elseif ($deck->format === 2)
                                Unlimited
                            @else
                                Custom
                            @endif
                        </span>
                        <span
                            class="px-3 py-1.5 rounded-full {{ $deck->is_public ? 'bg-green-700/70 text-green-100' : 'bg-red-700/70 text-red-100' }} font-medium">
                            {{ $deck->is_public ? 'Public' : 'Private' }}
                        </span>
                        <span class="px-3 py-1.5 rounded-full bg-indigo-700/70 text-indigo-100 font-medium">
                            {{ $deck->cards->sum('pivot.quantity') }} cards
                        </span>
                    </div>

                    @if ($deck->description)
                        <p class="max-w-3xl text-lg text-purple-200">{{ $deck->description }}</p>
                    @endif

                    <div class="mt-4 text-sm text-purple-300">
                        Created by <span class="font-semibold text-purple-100">{{ $deck->user?->name }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cards List Container -->
        <x-organisms.container.neo-brutal>
            <div class="p-4">
                <x-atoms.section-header title="Cards in Deck" />

                @if ($deck->cards->isEmpty())
                    <div class="py-8 text-center">
                        <p class="text-purple-300">No cards in this deck yet.</p>
                    </div>
                @else
                    <div class="divide-y divide-purple-800">
                        @foreach ($deck->cards as $card)
                            <div class="flex items-center py-4">
                                <!-- Card Image (Clickable) -->
                                <div class="flex-shrink-0 w-20 overflow-hidden rounded-lg shadow-md cursor-pointer h-28 hover:shadow-purple-700/50"
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
