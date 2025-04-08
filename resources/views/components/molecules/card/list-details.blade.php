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
                    <a href="{{ route('cards.show', $card->slug) }}"
                        class="transition-colors duration-200 hover:text-purple-400">
                        {{ $card->name }}
                    </a>
                </h3>

                <!-- Quantity Indicator -->
                <div
                    class="flex items-center justify-center w-10 h-10 ml-2 text-lg font-bold text-white transition-all duration-300 border rounded-full shadow-lg bg-gradient-to-r from-purple-900 to-indigo-800 shadow-purple-500/30 border-purple-400/20 hover:shadow-purple-500/50">
                    <span class="text-transparent bg-clip-text bg-gradient-to-b from-white to-purple-100">
                        x{{ isset($card->wishlist_item) ? $card->wishlist_item->quantity : $card->quantity ?? 1 }}
                    </span>
                </div>
            </div>

            <!-- Card Metadata -->
            <div class="flex flex-wrap gap-2 mt-2">
                @if (isset($card->cardSet) && $card->cardSet)
                    <span class="px-2 py-1 text-xs font-medium text-white bg-indigo-600 rounded-md">
                        {{ $card->cardSet->name ?? 'Unknown Set' }}
                    </span>
                @endif

                @if (isset($card->craft) && $card->craft)
                    <span class="px-2 py-1 text-xs font-medium text-white rounded-md {{ $craftBackground }}">
                        {{ $card->craft->name ?? 'Unknown Craft' }}
                    </span>
                @endif

                @if (isset($card->rarity))
                    <span class="px-2 py-1 text-xs font-medium text-white rounded-md {{ $rarityBackground }}">
                        {{ $card->rarity }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Card Statistics -->
        <div class="flex items-center justify-between mt-4">
            <div class="text-sm font-medium text-gray-300">Cost: {{ $card->cost ?? '?' }}</div>

            @if ($showActions)
                <div class="flex space-x-2">
                    <button
                        class="px-3 py-1 text-xs font-medium text-white transition-colors duration-200 bg-purple-600 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                        Edit
                    </button>
                    <button
                        class="px-3 py-1 text-xs font-medium text-white transition-colors duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                        Remove
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
