@props(['id' => 'card-modal-js'])

<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
    @click.self="showModal = false" @keydown.escape.window="showModal = false" x-transition>
    <div class="flex w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg shadow-xl">
        <!-- Left side - Card Image -->
        <div class="w-1/2 pr-6">
            <img :src="card.image" :alt="card.name" class="w-full rounded-lg">
        </div>

        <!-- Right side - Card Details -->
        <div class="w-1/2 space-y-4">
            <h2 class="text-2xl font-bold text-purple-100" x-text="card.name"></h2>

            <div class="space-y-2">
                <p class="text-purple-300">
                    <span class="font-semibold">Type:</span>
                    <span x-text="card.card_type"></span>
                </p>
                <template x-if="card.craft">
                    <p class="text-purple-300">
                        <span class="font-semibold">Craft:</span>
                        <span x-text="card.craft.name"></span>
                    </p>
                </template>
                <template x-if="card.card_set">
                    <p class="text-purple-300">
                        <span class="font-semibold">Set:</span>
                        <span x-text="card.card_set.name"></span>
                    </p>
                </template>
                <p class="text-purple-300">
                    <span class="font-semibold">Rarity:</span>
                    <span x-text="card.rarity"></span>
                </p>
                <p class="text-purple-300">
                    <span class="font-semibold">Cost:</span>
                    <span x-text="card.cost + ' PP'"></span>
                </p>

                <template x-if="card.sub_type">
                    <p class="text-purple-300">
                        <span class="font-semibold">Sub Type:</span>
                        <span x-text="card.sub_type"></span>
                    </p>
                </template>

                <template x-if="card.traits">
                    <p class="text-purple-300">
                        <span class="font-semibold">Traits:</span>
                        <span x-text="card.traits"></span>
                    </p>
                </template>

                <template x-if="card.card_type === 'Follower'">
                    <div class="pt-2 border-t border-purple-700">
                        <template x-if="card.atk !== undefined && card.health !== undefined">
                            <p class="text-purple-300">
                                <span class="font-semibold">Stats:</span>
                                <span x-text="card.atk + '/' + card.health"></span>
                            </p>
                        </template>
                        <template x-if="card.evolved_atk && card.evolved_health">
                            <p class="text-purple-300">
                                <span class="font-semibold">Evolved:</span>
                                <span x-text="card.evolved_atk + '/' + card.evolved_health"></span>
                            </p>
                        </template>
                    </div>
                </template>

                <template x-if="card.effects">
                    <div class="pt-2 border-t border-purple-700">
                        <p class="font-semibold text-purple-200">Effect:</p>
                        <p class="text-purple-300" x-html="card.effects"></p>
                    </div>
                </template>
            </div>

            <div class="flex pt-4 space-x-2">
                <button @click="showModal = false"
                    class="px-4 py-2 font-semibold text-purple-200 transition-colors duration-200 bg-transparent border border-purple-700 rounded hover:bg-purple-700/30">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
