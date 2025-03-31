<div class="container px-4 mx-auto" x-data="wishlistProfile">
    <x-atoms.neo-brutal-panel class="my-8">
        <!-- Wishlist Header Section -->
        <div class="mb-8">
            <div class="overflow-hidden bg-gray-900 border border-purple-900 rounded-lg shadow-md">
                <div class="px-6 py-8">
                    <div class="flex flex-col items-center md:flex-row md:items-start">
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-2xl font-bold text-white">{{ $wishlist->title }}</h1>
                            <p class="text-gray-400">Created by
                                <a href="{{ route('users.profile', $wishlist->user->slug) }}"
                                    class="text-purple-400 hover:text-purple-300">
                                    {{ $wishlist->user->name }}
                                </a>
                            </p>
                            <p class="text-gray-400">Created {{ $wishlist->created_at->diffForHumans() }}</p>
                            <div class="mt-2">
                                <span
                                    class="px-2 py-1 text-xs text-white {{ $wishlist->is_public ? 'bg-green-600' : 'bg-red-600' }} rounded">
                                    {{ $wishlist->is_public ? 'Public' : 'Private' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Wishlist Stats Section -->
        <x-molecules.section-heading title="Wishlist Stats" subtitle="Cards and estimated costs" />
        <div class="mb-8">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-purple-400">{{ $wishlist->cards->count() }}</div>
                    <div class="text-gray-400">Total Cards</div>
                </div>
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-indigo-400">
                        {{ $wishlist->cards->sum('wishlist_item.quantity') }}</div>
                    <div class="text-gray-400">Total Quantity</div>
                </div>
                <div class="p-4 text-center">
                    <div class="text-3xl font-bold text-blue-400">{{ $wishlist->cards->unique('cardSet.id')->count() }}
                    </div>
                    <div class="text-gray-400">Card Sets</div>
                </div>
            </div>
        </div>
    </x-atoms.neo-brutal-panel>

    <!-- Cards in Wishlist Section -->
    <div class="mt-8">
        <x-molecules.section-heading title="Cards in Wishlist" subtitle="Cards you want to acquire" />

        <div class="overflow-hidden mb-8">
            <x-atoms.neo-brutal-panel>
                <div class="p-4 space-y-4">
                    @forelse ($wishlist->cards as $card)
                        <div
                            class="flex flex-col md:flex-row bg-gray-800 border border-purple-900 rounded-lg overflow-hidden">
                            <div class="flex-shrink-0 md:w-1/6">
                                <img src="{{ $card->getImage() }}" alt="{{ $card->name }}"
                                    class="w-full h-auto object-cover">
                            </div>
                            <div class="flex-1 p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-white">
                                        <a href="{{ route('cards.show', $card->slug) }}" class="hover:text-purple-400">
                                            {{ $card->name }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-400 text-sm mt-1">{{ Str::limit($card->description, 100) }}</p>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        <span class="px-2 py-1 text-xs text-white bg-indigo-600 rounded">
                                            {{ $card->cardSet->name ?? 'Unknown Set' }}
                                        </span>
                                        <span class="px-2 py-1 text-xs text-white bg-blue-600 rounded">
                                            {{ $card->craft->name ?? 'Unknown Craft' }}
                                        </span>
                                        <span class="px-2 py-1 text-xs text-white bg-green-600 rounded">
                                            {{ $card->rarity }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-between items-center">
                                    <div class="text-sm text-gray-400">Cost: {{ $card->cost }}</div>
                                    <div class="text-sm font-semibold text-purple-400">
                                        Quantity: {{ $card->wishlist_item->quantity }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center">
                            <p class="text-gray-400">No cards in this wishlist yet.</p>
                        </div>
                    @endforelse
                </div>
            </x-atoms.neo-brutal-panel>
        </div>
    </div>
</div>

@script
    document.addEventListener('alpine:init', () => {
    Alpine.data('wishlistProfile', () => ({
    init() {
    // Any initialization logic for the wishlist profile page
    }
    }))
    })
@endScript
