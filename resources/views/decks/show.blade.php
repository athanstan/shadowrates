<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-purple-100">{{ $deck->name }}</h1>
            <div class="flex gap-2">
                @if ($deck->user_id === auth()->id())
                    <a href="{{ route('decks.edit', $deck) }}"
                        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white">
                        Edit Deck
                    </a>
                    <form action="{{ route('decks.destroy', $deck) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this deck?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded text-white">
                            Delete
                        </button>
                    </form>
                @endif
                <a href="{{ route('decks.index') }}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded text-white">
                    Back to Decks
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Deck Info -->
            <div class="lg:col-span-1">
                <div class="bg-purple-900 rounded-lg p-6 mb-6">
                    <div class="flex items-center mb-4">
                        <span class="text-sm text-purple-300">{{ $deck->craft->name }}</span>
                        <span class="mx-2 text-purple-500">•</span>
                        <span class="text-sm text-purple-300">{{ $deck->cards->sum('pivot.quantity') }} cards</span>
                        <span class="mx-2 text-purple-500">•</span>
                        <span class="text-sm {{ $deck->is_public ? 'text-green-400' : 'text-red-400' }}">
                            {{ $deck->is_public ? 'Public' : 'Private' }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-purple-100 font-bold mb-2">Created by</h3>
                        <p class="text-purple-300">{{ $deck->user->name }}</p>
                    </div>

                    @if ($deck->description)
                        <div class="mb-4">
                            <h3 class="text-purple-100 font-bold mb-2">Description</h3>
                            <p class="text-purple-300">{{ $deck->description }}</p>
                        </div>
                    @endif

                    <div>
                        <h3 class="text-purple-100 font-bold mb-2">Format</h3>
                        <p class="text-purple-300">
                            @if ($deck->format === 1)
                                Rotation
                            @elseif ($deck->format === 2)
                                Unlimited
                            @else
                                Custom
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card List -->
            <div class="lg:col-span-2">
                <div class="bg-purple-900 rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold text-purple-100">Cards ({{ $deck->cards->sum('pivot.quantity') }})
                        </h2>
                        @if ($deck->user_id === auth()->id())
                            <a href="#" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded text-white">
                                Add Cards
                            </a>
                        @endif
                    </div>

                    @if ($deck->cards->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-purple-300">No cards in this deck yet.</p>
                        </div>
                    @else
                        <div class="divide-y divide-purple-800">
                            @foreach ($deck->cards->sortBy('cost') as $card)
                                <div class="py-3 flex justify-between items-center">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 flex items-center justify-center rounded bg-purple-800 text-purple-100">
                                            {{ $card->cost }}
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('cards.show', $card) }}"
                                                class="text-purple-100 hover:text-white">
                                                {{ $card->name }}
                                            </a>
                                            <div class="text-xs text-purple-400">{{ $card->rarity }} ·
                                                {{ $card->cardType->name }}</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-purple-300 mr-2">x{{ $card->pivot->quantity }}</span>
                                        @if ($deck->user_id === auth()->id())
                                            <form action="{{ route('decks.cards.destroy', [$deck, $card]) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
