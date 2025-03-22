@props([
    'imageUrl' => 'https://via.placeholder.com/80',
    'cardName' => 'Card Name',
    'cardType' => 'Unknown Type',
    'cardRarity' => 'Unknown Rarity',
    'rating' => 5,
    'maxRating' => 5,
    'voteCount' => 0,
])

<div class="flex items-center p-4 rounded-lg glass-effect">
    <img src="{{ $imageUrl }}" alt="{{ $cardName }}" class="w-16 h-16 mr-4 rounded-lg pixel-corners" />

    <div class="flex-1">
        <div class="flex items-start justify-between">
            <div>
                <h4 class="font-bold text-purple-200">{{ $cardName }}</h4>
                <div class="text-xs text-purple-400">{{ $cardType }} • {{ $cardRarity }}</div>
            </div>
            <div class="flex">
                @for ($i = 1; $i <= $maxRating; $i++)
                    <span class="{{ $i <= $rating ? 'text-yellow-300 star-glow' : 'text-gray-600' }}">★</span>
                @endfor
            </div>
        </div>

        <div class="mt-2">
            <div class="flex justify-between mb-1 text-xs text-purple-300">
                <span>Community Rating</span>
                <span>{{ number_format($rating, 1) }}/{{ $maxRating }} ({{ $voteCount }} votes)</span>
            </div>
            <x-atoms.rating-meter :rating="$rating" :maxRating="$maxRating" />
        </div>
    </div>
</div>
