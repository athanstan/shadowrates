<div class="container px-4 py-8 mx-auto">
    <!-- Alert Components -->
    <x-atoms.success-alert position="top-center" />
    <x-atoms.error-alert position="top-center" />

    <div class="flex flex-col items-center justify-between mb-8 md:flex-row">
        <div>
            <h1 class="mb-2 text-3xl font-bold text-white">Public Decks</h1>
            <p class="text-purple-300">Check out what other players have built</p>
        </div>
        <a href="{{ route('decks.create') }}" wire:navigate class="mt-4 md:mt-0">
            <x-atoms.action-button>Create New Deck</x-atoms.action-button>
        </a>
    </div>

    @if ($decks->isEmpty())
        <x-atoms.neo-brutal-panel>
            <div class="p-8 text-center">
                <p class="mb-6 text-xl text-purple-300">No decks have been created yet.</p>
                <a href="{{ route('decks.create') }}">
                    <x-atoms.action-button size="lg">Create Your First Deck</x-atoms.action-button>
                </a>
            </div>
        </x-atoms.neo-brutal-panel>
    @else
        @foreach ($decksByUser as $username => $userDecks)
            <div class="mt-16 mb-16">
                <x-molecules.section-heading title="{{ $username }}'s Decks"
                    subtitle="See more details about each deck" />

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @foreach ($userDecks as $deck)
                        <x-cards.leader :leader="$deck->getLeaderCard()" :craft="$deck->getLeaderCard()->craft->name ?? 'Unknown'" :title="$deck->name" :description="$deck->description"
                            :count="$deck->cards_count" :deckUrl="route('decks.show', $deck->slug)" />
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="mt-8">
            {{ $decks->links() }}
        </div>
    @endif
</div>
