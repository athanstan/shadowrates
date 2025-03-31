<div class="container px-4 mx-auto" x-data="userWishlists">
    <x-atoms.neo-brutal-panel class="my-8">
        <!-- User Header Section -->
        <div class="mb-8">
            <div class="overflow-hidden bg-gray-900 border border-purple-900 rounded-lg shadow-md">
                <div class="px-6 py-8">
                    <div class="flex flex-col items-center md:flex-row md:items-start">
                        <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                            <img class="object-cover w-24 h-24 p-1 rounded-lg pixel-corners"
                                src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                style="image-rendering: pixelated;">
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h1 class="text-2xl font-bold text-white">{{ $user->name }}'s Wishlists</h1>
                            <p class="text-gray-400">
                                <a href="{{ route('users.profile', $user->slug) }}"
                                    class="text-purple-400 hover:text-purple-300">
                                    Back to Profile
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-atoms.neo-brutal-panel>

    <!-- Wishlists Section -->
    <div class="mt-8">
        <x-molecules.section-heading title="Wishlists" subtitle="Collections of cards to acquire" />

        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">
            @forelse ($user->wishlists as $wishlist)
                <x-atoms.neo-brutal-panel>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-xl font-bold text-white">
                                <a href="{{ route('wishlists.show', $wishlist->slug) }}"
                                    class="hover:text-purple-400 wire:navigate">
                                    {{ $wishlist->title }}
                                </a>
                            </h3>
                            <span
                                class="px-2 py-1 text-xs text-white {{ $wishlist->is_public ? 'bg-green-600' : 'bg-red-600' }} rounded">
                                {{ $wishlist->is_public ? 'Public' : 'Private' }}
                            </span>
                        </div>

                        <div class="mb-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-purple-400">{{ $wishlist->cards_count }}</div>
                                    <div class="text-gray-400">Cards</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-indigo-400">{{ $wishlist->total_quantity }}
                                    </div>
                                    <div class="text-gray-400">Total Quantity</div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('wishlists.show', $wishlist->slug) }}"
                                class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700 wire:navigate">
                                View Wishlist
                            </a>
                        </div>
                    </div>
                </x-atoms.neo-brutal-panel>
            @empty
                <div class="col-span-2">
                    <x-atoms.neo-brutal-panel>
                        <div class="p-8 text-center">
                            <p class="text-gray-400">No wishlists found.</p>
                        </div>
                    </x-atoms.neo-brutal-panel>
                </div>
            @endforelse
        </div>
    </div>
</div>
