<div class="container px-4 mx-auto" x-data="userWishlists">
    <div class="my-8">
        <div class="overflow-hidden bg-gray-900 border border-purple-900 rounded-lg shadow-md">
            <div class="px-6 py-8">
                <div class="flex flex-col items-center">
                    <div class="flex-shrink-0 mb-4">
                        <img class="object-cover w-24 h-24 p-1 rounded-lg pixel-corners"
                            src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                            style="image-rendering: pixelated;">
                    </div>
                    <div class="flex-1 text-center">
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

    <!-- Wishlists Section -->
    <div class="mt-8">
        <div class="grid grid-cols-1 gap-6 mb-8">
            @forelse ($user->wishlists as $wishlist)
                <div
                    class="relative p-6 overflow-hidden bg-gradient-to-b from-neutral-900 to-neutral-950 rounded-md transition-all duration-300 hover:shadow-[0_0_15px_rgba(168,85,247,0.4)] shadow-[0_0_8px_rgba(168,85,247,0.2)] group border border-purple-900">
                    <div
                        class="absolute top-0 right-0 w-20 h-20 transition-opacity duration-300 opacity-0 bg-gradient-to-br from-purple-500/20 to-transparent rounded-tr-3xl group-hover:opacity-100">
                    </div>
                    <div
                        class="pointer-events-none absolute left-1/2 top-0 -ml-20 -mt-2 h-full w-full [mask-image:linear-gradient(white,transparent)]">
                        <div
                            class="absolute inset-0 bg-gradient-to-r [mask-image:radial-gradient(farthest-side_at_top,white,transparent)] from-zinc-900/30 to-zinc-900/30 opacity-100">
                            <!-- Grid pattern would go here -->
                        </div>
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
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

                            <div class="flex items-center space-x-6">
                                <div class="flex items-center space-x-1">
                                    <span class="text-lg font-bold text-purple-400">{{ $wishlist->cards_count }}</span>
                                    <span class="text-sm text-gray-400">Cards</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <span
                                        class="text-lg font-bold text-indigo-400">{{ $wishlist->total_quantity }}</span>
                                    <span class="text-sm text-gray-400">Total</span>
                                </div>
                                <a href="{{ route('wishlists.show', $wishlist->slug) }}"
                                    class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700 wire:navigate">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <x-atoms.neo-brutal-panel>
                    <div class="p-8 text-center">
                        <p class="text-gray-400">No wishlists found.</p>
                    </div>
                </x-atoms.neo-brutal-panel>
            @endforelse
        </div>
    </div>
</div>
