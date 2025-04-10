@props(['card'])

<div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/80"
    @click.self="showModal = false" @keydown.escape.window="showModal = false" x-transition>
    <div class="flex w-full max-w-4xl p-6 mx-4 bg-gray-800 rounded-lg shadow-xl">
        <!-- Left side - Card Image -->
        <div class="w-1/2 pr-6">
            <img src="{{ $card->getImage() }}" alt="{{ $card->name }}" class="w-full rounded-lg">
        </div>

        <!-- Right side - Card Details -->
        <div class="w-1/2 space-y-4">
            <h2 class="text-2xl font-bold text-purple-100">{{ $card->name }}
            </h2>

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
                <p class="text-purple-300"><span class="font-semibold">Rarity:</span>
                    {{ $card->rarity }}</p>
                <p class="text-purple-300"><span class="font-semibold">Cost:</span>
                    {{ $card->cost }} PP</p>

                @if ($card->traits)
                    <p class="text-purple-300"><span class="font-semibold">Traits:</span>
                        {{ $card->traits }}
                    </p>
                @endif

                @if ($card->cardType && $card->cardType->name === 'Follower')
                    <div class="pt-2 border-t border-purple-700">
                        <p class="text-purple-300"><span class="font-semibold">Stats:</span>
                            {{ $card->atk }}/{{ $card->health }}</p>
                        @if ($card->evolved_atk && $card->evolved_health)
                            <p class="text-purple-300"><span class="font-semibold">Evolved:</span>
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
                <button @click="showModal = false"
                    class="px-4 py-2 font-semibold text-purple-200 transition-colors duration-200 bg-transparent border border-purple-700 rounded hover:bg-purple-700/30">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
