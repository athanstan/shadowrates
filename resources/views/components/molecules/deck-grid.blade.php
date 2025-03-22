@props(['decks', 'columns' => 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3'])

<div {{ $attributes->merge(['class' => "grid $columns gap-6"]) }}>
    @forelse($decks as $deck)
        <x-atoms.deck-preview :deck="$deck" />
    @empty
        <div class="col-span-full py-10 text-center">
            <p class="text-gray-400">No decks found.</p>
        </div>
    @endforelse
</div>
