<div class="container px-4 mx-auto py-8">
    <!-- Alert Components -->
    <x-atoms.success-alert position="top-center" />
    <x-atoms.error-alert position="top-center" />

    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white mb-2">Your Decks</h1>
            <p class="text-purple-300">Build, manage, and share your deck creations</p>
        </div>
        <a href="{{ route('decks.create') }}" class="mt-4 md:mt-0">
            <x-atoms.action-button>Create New Deck</x-atoms.action-button>
        </a>
    </div>

    @if ($decks->isEmpty())
        <x-organisms.container.neo-brutal>
            <div class="p-8 text-center">
                <p class="text-xl text-purple-300 mb-6">You haven't created any decks yet.</p>
                <a href="{{ route('decks.create') }}">
                    <x-atoms.action-button size="lg">Create Your First Deck</x-atoms.action-button>
                </a>
            </div>
        </x-organisms.container.neo-brutal>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($decks as $deck)
                <x-organisms.container.neo-brutal>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-purple-100 mb-2">{{ $deck->name }}</h2>
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            @if ($deck->craft)
                                <span class="px-2 py-1 text-xs rounded-full bg-purple-700/70 text-purple-100">
                                    {{ $deck->craft->name }}
                                </span>
                            @endif
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-700/70 text-blue-100">
                                @if ($deck->format === 1)
                                    Rotation
                                @elseif ($deck->format === 2)
                                    Unlimited
                                @else
                                    Custom
                                @endif
                            </span>
                            <span
                                class="px-2 py-1 text-xs rounded-full {{ $deck->is_public ? 'bg-green-700/70 text-green-100' : 'bg-red-700/70 text-red-100' }}">
                                {{ $deck->is_public ? 'Public' : 'Private' }}
                            </span>
                            <span class="px-2 py-1 text-xs rounded-full bg-indigo-700/70 text-indigo-100">
                                {{ $deck->cards->sum('pivot.quantity') ?? 0 }} cards
                            </span>
                        </div>

                        @if ($deck->description)
                            <p class="text-purple-400 text-sm mb-4">{{ Str::limit($deck->description, 100) }}</p>
                        @endif

                        <div class="mt-6 flex justify-between">
                            <a href="{{ route('decks.show', $deck) }}"
                                class="text-purple-300 hover:text-white transition" wire:navigate>
                                View Deck
                            </a>
                            <a href="{{ route('decks.edit', $deck) }}"
                                class="text-purple-300 hover:text-white transition">
                                Edit
                            </a>
                        </div>
                    </div>
                </x-organisms.container.neo-brutal>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $decks->links() }}
        </div>
    @endif
</div>
