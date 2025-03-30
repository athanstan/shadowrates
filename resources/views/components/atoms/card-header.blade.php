@props(['card'])

<div class="text-center">
    <h1 class="mb-2 text-4xl font-bold text-purple-100">{{ $card->name }}</h1>
    <p class="text-xl text-purple-300">{{ $card->cardType->name }} • {{ $card->craft->name }} •
        {{ $card->cardSet->name }}</p>
</div>
