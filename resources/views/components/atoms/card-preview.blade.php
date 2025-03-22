@props(['card'])

<div class="card-container neo-brutal-panel overflow-hidden hover:shadow-purple-700/30 transition-shadow duration-300 pixel-corners"
    wire:key="card-{{ $card->id }}">
    <div class="relative">
        <!-- Card Image -->
        <img src="{{ $card->image_url ?? 'https://via.placeholder.com/250x350?text=Card+Image' }}"
            alt="{{ $card->name }}" class="w-full h-auto object-cover">

        <!-- Card Cost -->
        <div
            class="absolute top-2 left-2 bg-blue-500 text-white font-bold rounded-full w-8 h-8 flex items-center justify-center shadow-lg shadow-blue-500/30">
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
        <div class="flex justify-between text-sm text-purple-300 mb-1">
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
        class="block w-full bg-purple-700 hover:bg-purple-600 text-white font-semibold text-center py-2 transition-colors duration-200">
        View Details
    </a>
</div>
