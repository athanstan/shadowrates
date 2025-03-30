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
        <x-atoms.card-image :card="$card" />

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
                        <x-atoms.action-button variant="secondary" @click="removeCard()">
                            <span class="sr-only">Remove card</span>
                            -
                        </x-atoms.action-button>
                        <span class="mx-3 text-lg font-bold text-purple-100 min-w-[2ch] text-center"
                            x-text="$wire.cardCollection[{{ $card->id }}] ?? 0"></span>
                        <x-atoms.action-button variant="secondary" @click="addCard()">
                            <span class="sr-only">Add card</span>
                            +
                        </x-atoms.action-button>
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
                    <x-atoms.card-image :card="$card" :showEvolved="true" />
                </div>

                <!-- Right side - Card Details -->
                <div class="w-1/2 space-y-4">
                    <x-atoms.card-header :card="$card" />
                    <x-atoms.card-details :card="$card" />

                    <div class="pt-4">
                        <a href="{{ route('cards.show', $card) }}" wire:navigate>
                            <x-atoms.action-button>View Full Details</x-atoms.action-button>
                        </a>
                        <x-atoms.action-button variant="secondary"
                            @click="showModal = false">Close</x-atoms.action-button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
