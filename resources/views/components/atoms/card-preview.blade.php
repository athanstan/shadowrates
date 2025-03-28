@props(['card', 'collectible' => false])

<div class="relative z-10 overflow-hidden transition-all duration-300 transform cursor-pointer card-container hover:shadow-purple-700/30 hover:scale-125 hover:z-30"
    wire:key="card-{{ $card->id }}" x-data="{
        showModal: false,
        showAnimation: false,
        animationType: '',
        addCard() {
            $wire.cardCollection[{{ $card->id }}] = ($wire.cardCollection[{{ $card->id }}] || 0) + 1;
            this.showAnimation = true;
            this.animationType = 'add';
            setTimeout(() => this.showAnimation = false, 500);
        },
        removeCard() {
            if ($wire.cardCollection[{{ $card->id }}] > 0) {
                $wire.cardCollection[{{ $card->id }}] = Math.max(0, $wire.cardCollection[{{ $card->id }}] - 1);
                this.showAnimation = true;
                this.animationType = 'subtract';
                setTimeout(() => this.showAnimation = false, 500);
            }
        }
    }" @click="showModal = true">
    <div class="relative">
        <!-- Card Image -->
        <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
            class="object-cover w-full h-auto transition-transform duration-300 transform-gpu"
            style="image-rendering: -webkit-optimize-contrast; backface-visibility: hidden;">

        @auth
            <div class="absolute inset-0 z-50 flex items-center justify-center pointer-events-none" x-show="showAnimation"
                x-transition.duration.500ms>
                <span x-show="animationType === 'subtract'" class="text-5xl font-bold game-number-bad animate-bounce">
                    -1
                </span>
                <span x-show="animationType === 'add'" class="text-5xl font-bold game-number-good animate-bounce">
                    +1
                </span>
            </div>

            @if ($collectible ?? false)
                <div class="relative">
                    <div class="absolute bottom-0 left-0 right-0 flex items-center justify-center p-2 bg-black/70"
                        @click.stop>
                        <button class="px-3 py-1 text-lg font-bold transition-colors rounded-l-full"
                            :class="$wire.cardCollection[{{ $card->id }}] > 0 ?
                                'text-purple-300 hover:text-purple-100 hover:bg-purple-900/50' :
                                'text-purple-900 cursor-default'"
                            @click="removeCard()">
                            <span class="sr-only">Remove card</span>
                            -
                        </button>
                        <span class="mx-3 text-lg font-bold text-purple-100 min-w-[2ch] text-center"
                            x-text="$wire.cardCollection[{{ $card->id }}] ?? 0"></span>
                        <button
                            class="px-3 py-1 text-lg font-bold text-purple-300 transition-colors rounded-r-full hover:text-purple-100 hover:bg-purple-900/50"
                            @click="addCard()">
                            <span class="sr-only">Add card</span>
                            +
                        </button>
                    </div>
                </div>
            @endif
        @endauth

    </div>

    <!-- Modal -->
    <template x-teleport="body">
        <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
            @click.self="showModal = false" @keydown.escape.window="showModal = false" x-transition>
            <div class="flex w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg shadow-xl">
                <!-- Left side - Card Image -->
                <div class="w-1/2 pr-6">
                    <img src="{{ $card->getImage() }}" alt="{{ $card->name }}" class="w-full rounded-lg">
                    @if ($card->evolved_image)
                        <img src="{{ $card->getEvolvedImage() }}" alt="{{ $card->name }} (Evolved)"
                            class="w-full mt-4 rounded-lg">
                    @endif
                </div>

                <!-- Right side - Card Details -->
                <div class="w-1/2 space-y-4">
                    <h2 class="text-2xl font-bold text-purple-100">{{ $card->name }}</h2>

                    <div class="space-y-2">
                        <p class="text-purple-300"><span class="font-semibold">Type:</span> {{ $card->cardType->name }}
                        </p>
                        <p class="text-purple-300"><span class="font-semibold">Craft:</span> {{ $card->craft->name }}
                        </p>
                        <p class="text-purple-300"><span class="font-semibold">Set:</span> {{ $card->cardSet->name }}
                        </p>
                        <p class="text-purple-300"><span class="font-semibold">Rarity:</span> {{ $card->rarity }}</p>
                        <p class="text-purple-300"><span class="font-semibold">Cost:</span> {{ $card->cost }} PP</p>

                        @if ($card->traits)
                            <p class="text-purple-300"><span class="font-semibold">Traits:</span> {{ $card->traits }}
                            </p>
                        @endif

                        @if ($card->cardType && $card->cardType->name === 'Follower')
                            <div class="pt-2 border-t border-purple-700">
                                <p class="text-purple-300"><span class="font-semibold">Stats:</span>
                                    {{ $card->atk }}/{{ $card->health }}</p>
                                @if ($card->evolved_atk && $card->evolved_health)
                                    <p class="text-purple-300"><span class="font-semibold">Evolved:</span>
                                        {{ $card->evolved_atk }}/{{ $card->evolved_health }}</p>
                                @endif
                            </div>
                        @endif

                        @if ($card->effects)
                            <div class="pt-2 border-t border-purple-700">
                                <p class="font-semibold text-purple-200">Effect:</p>
                                <p class="text-purple-300 card-effect">{!! $card->effects !!}</p>
                            </div>
                        @endif
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('cards.show', $card) }}" wire:navigate
                            class="inline-block px-4 py-2 font-semibold text-white transition-colors duration-200 bg-purple-700 rounded hover:bg-purple-600">
                            View Full Details
                        </a>
                        <button @click="showModal = false"
                            class="inline-block px-4 py-2 ml-2 font-semibold text-purple-200 transition-colors duration-200 bg-transparent border border-purple-700 rounded hover:bg-purple-700/30">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
