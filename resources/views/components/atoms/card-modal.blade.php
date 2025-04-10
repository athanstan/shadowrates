@props([
    'id' => 'card-modal',
    'card' => null,
])

{{--
    Card Modal Component

    Usage:

    1. Basic usage (JS event triggered):
    <x-atoms.card-modal />

    Then trigger with JavaScript:
    $dispatch('open-card-modal', cardData)

    2. With slot as trigger:
    <x-atoms.card-modal>
        <button>Open Card</button>
    </x-atoms.card-modal>

    3. With pre-loaded card:
    <x-atoms.card-modal :card="$card">
        <button>Open Card</button>
    </x-atoms.card-modal>
--}}

<div x-data="{
    open: false,
    cardData: null,
    init() {
        // Listen for events to open modal
        this.$watch('cardData', (value) => {
            if (value) this.open = true;
        });

        // Listen for open-card-modal event
        window.addEventListener('open-card-modal', (e) => {
            this.cardData = e.detail;
            this.open = true;
        });
    },
    close() {
        this.open = false;
        // Reset card data after animation completes
        setTimeout(() => {
            this.cardData = null;
        }, 300);
    }
}" x-id="['card-modal']" @keydown.escape.window="close()" :id="$id('card-modal')">
    <!-- Modal Trigger - Can be used optionally -->
    @if ($slot->isEmpty())
        <span></span>
    @else
        <div @click="cardData = {{ $card ? json_encode($card) : 'null' }}; open = true;">
            {{ $slot }}
        </div>
    @endif

    <!-- Modal -->
    <template x-teleport="body">
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center overflow-auto bg-black/80"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95" @click.self="close()">
            <div class="relative w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg shadow-xl">
                <!-- Close button -->
                <button @click="close()" class="absolute text-purple-300 top-4 right-4 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="flex flex-col md:flex-row">
                    <!-- Left side - Card Image -->
                    <div class="w-full mb-6 md:w-1/2 md:pr-6 md:mb-0">
                        <img :src="cardData?.image" :alt="cardData?.name" class="w-full rounded-lg">
                    </div>

                    <!-- Right side - Card Details -->
                    <div class="w-full space-y-4 md:w-1/2">
                        <h2 class="text-2xl font-bold text-purple-100" x-text="cardData?.name"></h2>

                        <div class="space-y-2">
                            <p class="text-purple-300">
                                <span class="font-semibold">Type:</span>
                                <span x-text="cardData?.card_type || cardData?.cardType?.name"></span>
                            </p>
                            <p class="text-purple-300">
                                <span class="font-semibold">Craft:</span>
                                <span x-text="cardData?.craft?.name"></span>
                            </p>
                            <p class="text-purple-300">
                                <span class="font-semibold">Set:</span>
                                <span x-text="cardData?.card_set?.name || cardData?.cardSet?.name"></span>
                            </p>
                            <p class="text-purple-300">
                                <span class="font-semibold">Rarity:</span>
                                <span x-text="cardData?.rarity"></span>
                            </p>
                            <p class="text-purple-300">
                                <span class="font-semibold">Cost:</span>
                                <span x-text="cardData?.cost + ' PP'"></span>
                            </p>

                            <template x-if="cardData?.traits">
                                <p class="text-purple-300">
                                    <span class="font-semibold">Traits:</span>
                                    <span x-text="cardData?.traits"></span>
                                </p>
                            </template>

                            <template
                                x-if="(cardData?.card_type === 'Follower') || (cardData?.cardType?.name === 'Follower')">
                                <div class="pt-2 border-t border-purple-700">
                                    <p class="text-purple-300">
                                        <span class="font-semibold">Stats:</span>
                                        <span x-text="cardData?.atk + '/' + cardData?.health"></span>
                                    </p>
                                    <template x-if="cardData?.evolved_atk && cardData?.evolved_health">
                                        <p class="text-purple-300">
                                            <span class="font-semibold">Evolved:</span>
                                            <span
                                                x-text="cardData?.evolved_atk + '/' + cardData?.evolved_health"></span>
                                        </p>
                                    </template>
                                </div>
                            </template>

                            <template x-if="cardData?.effects">
                                <div class="pt-2 border-t border-purple-700">
                                    <p class="font-semibold text-purple-200">Effect:</p>
                                    <p class="text-purple-300" x-html="cardData?.effects"></p>
                                </div>
                            </template>
                        </div>

                        <div class="flex pt-4 space-x-2">
                            <button @click="close()"
                                class="px-4 py-2 font-semibold text-purple-200 transition-colors duration-200 bg-transparent border border-purple-700 rounded hover:bg-purple-700/30">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
