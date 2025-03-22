<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-purple-100">Your Decks</h1>
            <a href="{{ route('decks.create') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white">
                Create New Deck
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($decks->isEmpty())
            <div class="bg-purple-900 rounded-lg p-8 text-center">
                <p class="text-purple-300 mb-4">You haven't created any decks yet.</p>
                <a href="{{ route('decks.create') }}"
                    class="inline-block px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white">
                    Create Your First Deck
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($decks as $deck)
                    <div class="bg-purple-900 rounded-lg overflow-hidden shadow-lg">
                        <div class="p-6">
                            <h2 class="text-xl font-bold text-purple-100 mb-2">{{ $deck->name }}</h2>
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
                                <p class="text-purple-400 text-sm mb-4">{{ Str::limit($deck->description, 100) }}</p>
                            @endif
                            <div class="flex justify-between mt-4">
                                <a href="{{ route('decks.show', $deck) }}" class="text-purple-300 hover:text-white">
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
