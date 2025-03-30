@props(['card'])

<div class="space-y-2">
    <p class="text-purple-300">
        <span class="font-semibold">Type:</span>
        <span class="text-purple-100">{{ $card->cardType->name }}</span>
    </p>
    <p class="text-purple-300">
        <span class="font-semibold">Craft:</span>
        <span class="text-purple-100">{{ $card->craft->name }}</span>
    </p>
    <p class="text-purple-300">
        <span class="font-semibold">Set:</span>
        <span class="text-purple-100">{{ $card->cardSet->name }}</span>
    </p>
    <p class="text-purple-300">
        <span class="font-semibold">Rarity:</span>
        <span class="text-purple-100">{{ $card->rarity }}</span>
    </p>
    <p class="text-purple-300">
        <span class="font-semibold">Cost:</span>
        <span class="text-purple-100">{{ $card->cost }} PP</span>
    </p>

    @if ($card->traits)
        <p class="text-purple-300">
            <span class="font-semibold">Traits:</span>
            <span class="text-purple-100">{{ $card->traits }}</span>
        </p>
    @endif

    @if ($card->cardType && $card->cardType->name === 'Follower')
        <div class="pt-2 border-t border-purple-700">
            <p class="text-purple-300">
                <span class="font-semibold">Stats:</span>
                <span class="text-purple-100">{{ $card->atk }}/{{ $card->health }}</span>
            </p>
            @if ($card->evolved_atk && $card->evolved_health)
                <p class="text-purple-300">
                    <span class="font-semibold">Evolved:</span>
                    <span class="text-purple-100">{{ $card->evolved_atk }}/{{ $card->evolved_health }}</span>
                </p>
            @endif
        </div>
    @endif

    @if ($card->effects)
        <div class="pt-2 border-t border-purple-700">
            <p class="font-semibold text-purple-300">Effect:</p>
            <p class="text-purple-100 card-effect">{!! $card->effects !!}</p>
        </div>
    @endif
</div>
