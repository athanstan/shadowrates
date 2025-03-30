@props(['card', 'showEvolved' => false])

<div class="relative">
    <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
        class="object-cover w-full h-auto transition-transform duration-300 transform-gpu"
        style="image-rendering: -webkit-optimize-contrast; backface-visibility: hidden;"
        {{ $attributes->merge(['class' => '']) }}>

    @if ($showEvolved && $card->evolved_image)
        <img src="{{ $card->getEvolvedImage() }}" alt="{{ $card->name }} (Evolved)" class="w-full mt-4 rounded-lg">
    @endif
</div>
