<x-app-layout>
    <div class="container py-8 mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-purple-100">Your Decks</h1>
            <a href="{{ route('decks.create') }}" wire:navigate
                class="px-4 py-2 text-white bg-purple-600 rounded hover:bg-purple-700">
                Create New Deck
            </a>
        </div>

        @if (session('success'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($decks->isEmpty())
            <div class="p-8 text-center bg-purple-900 rounded-lg">
                <p class="mb-4 text-purple-300">You haven't created any decks yet.</p>
                <a href="{{ route('decks.create') }}"
                    class="inline-block px-4 py-2 text-white bg-purple-600 rounded hover:bg-purple-700">
                    Create Your First Deck
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($decks as $deck)
                    <div class="overflow-hidden bg-purple-900 rounded-lg shadow-lg">
                        <div class="p-6">
                            <h2 class="mb-2 text-xl font-bold text-purple-100">{{ $deck->name }}</h2>
                            <div class="flex items-center mb-4">
                                <span class="text-sm text-purple-300">{{ $deck->craft->name }}</span>
                                <span class="mx-2 text-purple-500">•</span>
                                <span class="text-sm text-purple-300">{{ $deck->cards->sum('pivot.quantity') }}
                                    cards</span>
                                <span class="mx-2 text-purple-500">•</span>
                                <span class="text-sm {{ $deck->is_public ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $deck->is_public ? 'Public' : 'Private' }}
                                </span>
                            </div>
                            @if ($deck->description)
                                <p class="mb-4 text-sm text-purple-400">{{ Str::limit($deck->description, 100) }}</p>
                            @endif
                            <div class="flex justify-between mt-4">
                                <a href="{{ route('decks.show', $deck->slug) }}"
                                    class="text-purple-300 hover:text-white">
                                    View Deck
                                </a>
                                <a href="{{ route('decks.edit', $deck) }}" class="text-purple-300 hover:text-white">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $decks->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
