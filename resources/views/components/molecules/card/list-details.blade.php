@props(['card', 'showActions' => false])

@php
    use App\Enums\Craft;
    use App\Enums\Rarity;

    // Get the craft background dynamically
    $craftBackground =
        isset($card->craft) && $card->craft
            ? Craft::tryFrom($card->craft->slug)?->background() ?? 'bg-gray-700'
            : 'bg-gray-700';

    // Get the rarity background dynamically
    $rarityBackground =
        isset($card->rarity) && $card->rarity
            ? Rarity::tryFrom($card->rarity)?->background() ?? 'bg-gray-700'
            : 'bg-gray-700';
@endphp

<div
    class="flex flex-col overflow-hidden bg-gradient-to-b from-neutral-900 to-neutral-950 border border-neutral-800 hover:border-purple-900 rounded-lg transition-all duration-300 hover:shadow-[0_0_10px_rgba(168,85,247,0.3)] md:flex-row">
    <!-- Card Image -->
    <div class="flex-shrink-0 md:w-1/6">
        <img src="{{ $card->getImage() }}" alt="{{ $card->name }}" class="object-cover w-full h-auto">
    </div>

    <!-- Card Details -->
    <div class="flex flex-col justify-between flex-1 p-4">
        <div>
            <div class="flex items-start justify-between">
                <h3 class="text-xl font-bold text-white">
                    <a href="{{ route('cards.show', $card->slug) }}" class="hover:text-purple-400">
                        {{ $card->name }}
                    </a>
                </h3>

                <!-- Quantity Badge - Emphasized -->
                <div
                    class="px-3 py-1 w-10 h-10 flex items-center justify-center ml-2 text-lg font-bold text-white bg-gradient-to-b from-black to-gray-900 rounded-full shadow-[0_0_8px_rgba(168,85,247,0.5)]">
                    x{{ isset($card->wishlist_item) ? $card->wishlist_item->quantity : $card->quantity ?? 1 }}
                </div>
            </div>

            <!-- Card Tags -->
            <div class="flex flex-wrap gap-2 mt-2">
                @if (isset($card->cardSet) && $card->cardSet)
                    <span class="px-2 py-1 text-xs text-white bg-indigo-600 rounded">
                        {{ $card->cardSet->name ?? 'Unknown Set' }}
                    </span>
                @endif

                @if (isset($card->craft) && $card->craft)
                    <span class="px-2 py-1 text-xs text-white rounded {{ $craftBackground }}">
                        {{ $card->craft->name ?? 'Unknown Craft' }}
                    </span>
                @endif

                @if (isset($card->rarity))
                    <span class="px-2 py-1 text-xs text-white rounded {{ $rarityBackground }}">
                        {{ $card->rarity }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Card Footer -->
        <div class="flex items-center justify-between mt-4">
            <div class="text-sm text-gray-400">Cost: {{ $card->cost ?? '?' }}</div>

            @if ($showActions)
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs text-white bg-purple-600 rounded hover:bg-purple-700">
                        Edit
                    </button>
                    <button class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700">
                        Remove
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
