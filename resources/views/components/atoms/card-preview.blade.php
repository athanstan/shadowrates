@props(['card'])

<div class="overflow-hidden transition-shadow duration-300 card-container neo-brutal-panel hover:shadow-purple-700/30 pixel-corners"
    wire:key="card-{{ $card->id }}">
    <div class="relative">
        <!-- Card Image -->
        <img src="{{ $card->getImage() }}" alt="{{ $card->name }}" class="object-cover w-full h-auto">

        <!-- Card Cost -->
        <div
            class="absolute flex items-center justify-center w-8 h-8 font-bold text-white bg-blue-500 rounded-full shadow-lg top-2 left-2 shadow-blue-500/30">
            {{ $card->cost }}
        </div>

        <!-- Card Rarity -->
        <div class="absolute top-2 right-2">
            <span
                class="inline-block h-3 w-3 rounded-full shadow-glow
                {{ $card->rarity === 'Bronze'
                    ? 'bg-yellow-700 shadow-yellow-700/70'
                    : ($card->rarity === 'Silver'
                        ? 'bg-gray-400 shadow-gray-400/70'
                        : ($card->rarity === 'Gold'
                            ? 'bg-yellow-400 shadow-yellow-400/70'
                            : 'bg-yellow-200 shadow-yellow-200/70')) }}"></span>
        </div>
    </div>

    <div class="p-3">
        <!-- Card Name -->
        <h3 class="font-bold text-purple-100 truncate">{{ $card->name }}</h3>

        <!-- Card Info (Type / Craft) -->
        <div class="flex justify-between mb-1 text-sm text-purple-300">
            <span>{{ $card->cardType->name ?? 'Unknown Type' }}</span>
            <span>{{ $card->craft->name ?? 'Unknown Craft' }}</span>
        </div>

        <!-- Card Stats (for followers) -->
        @if ($card->cardType && $card->cardType->name === 'Follower')
            <div class="flex justify-between text-sm font-medium">
                <span class="text-red-400">{{ $card->attack ?? '?' }}/{{ $card->defense ?? '?' }}</span>
                <span class="text-purple-300">{{ $card->cardSet->name ?? 'Unknown Set' }}</span>
            </div>
        @else
            <div class="text-sm font-medium text-purple-300">
                {{ $card->cardSet->name ?? 'Unknown Set' }}
            </div>
        @endif
    </div>

    <!-- View Details Button -->
    <a href="{{ route('cards.show', $card) }}" wire:navigate
        class="block w-full py-2 font-semibold text-center text-white transition-colors duration-200 bg-purple-700 hover:bg-purple-600">
        View Details
    </a>
</div>
