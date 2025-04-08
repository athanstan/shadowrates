<div class="container px-4 mx-auto" x-data="wishlistProfile">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 my-6">
        <!-- Wishlist Info Panel -->
        <div class="col-span-1 lg:col-span-3">
            <x-atoms.neo-brutal-panel class="relative overflow-hidden">
                <div class="px-6 py-6 space-y-2">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-bold text-white">{{ $wishlist->title }}</h1>
                            <p class="text-gray-400 text-sm">
                                Created by
                                <a href="{{ route('users.profile', $wishlist->user->slug) }}"
                                    class="text-purple-400 hover:text-purple-300 transition font-medium">
                                    {{ $wishlist->user->name }}
                                </a>
                                <span class="mx-2">•</span>
                                {{ $wishlist->created_at->diffForHumans() }}
                                <span class="mx-2">•</span>
                                <span
                                    class="px-2 py-0.5 text-xs rounded-full {{ $wishlist->is_public ? 'bg-green-600/70' : 'bg-red-600/70' }}">
                                    {{ $wishlist->is_public ? 'Public' : 'Private' }}
                                </span>
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <div class="px-4 py-1 text-center bg-purple-900/30 rounded-lg">
                                <div class="text-2xl font-bold text-purple-400">{{ $wishlist->cards->count() }}</div>
                                <div class="text-gray-400 text-xs uppercase tracking-wide">Cards</div>
                            </div>
                            <div class="px-4 py-1 text-center bg-indigo-900/30 rounded-lg">
                                <div class="text-2xl font-bold text-indigo-400">
                                    {{ $wishlist->cards->sum('wishlist_item.quantity') }}</div>
                                <div class="text-gray-400 text-xs uppercase tracking-wide">Copies</div>
                            </div>
                            <div class="px-4 py-1 text-center bg-blue-900/30 rounded-lg">
                                <div class="text-2xl font-bold text-blue-400">
                                    {{ $wishlist->cards->unique('cardSet.id')->count() }}</div>
                                <div class="text-gray-400 text-xs uppercase tracking-wide">Sets</div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-atoms.neo-brutal-panel>
        </div>

        <!-- Craft Distribution Panel -->
        <div class="lg:col-span-2">
            <x-atoms.neo-brutal-panel class="h-full">
                <div class="flex items-center justify-between p-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold text-white">Card Distribution</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4">
                    <!-- Craft Percentages -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-400 mb-3">By Craft</h3>
                        <div class="space-y-2.5">
                            @forelse($craftPercentages as $craftSlug => $percentage)
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center">
                                            <span
                                                class="inline-block w-3 h-3 rounded-sm mr-2 {{ $this->getCraftBackground($craftSlug) }}"></span>
                                            <span
                                                class="text-xs text-white">{{ $this->getCraftName($craftSlug) }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-medium text-indigo-300">
                                                {{ $percentage }}%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex h-1.5 overflow-hidden bg-gray-800 rounded-sm">
                                        <div style="width: {{ $percentage }}%"
                                            class="{{ $this->getCraftBackground($craftSlug) }}"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-2 text-center">
                                    <p class="text-gray-400 text-xs">No craft data available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Rarity Percentages -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-400 mb-3">By Rarity</h3>
                        <div class="space-y-2.5">
                            @forelse($rarityPercentages as $rarityName => $percentage)
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center">
                                            <span
                                                class="inline-block w-3 h-3 rounded-sm mr-2 {{ $this->getRarityBackground($rarityName) }}"></span>
                                            <span class="text-xs text-white">{{ $rarityName }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-medium text-indigo-300">
                                                {{ $percentage }}%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex h-1.5 overflow-hidden bg-gray-800 rounded-sm">
                                        <div style="width: {{ $percentage }}%"
                                            class="{{ $this->getRarityBackground($rarityName) }}"></div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-2 text-center">
                                    <p class="text-gray-400 text-xs">No rarity data available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </x-atoms.neo-brutal-panel>
        </div>

        <!-- Card Counts Panel -->
        <div class="lg:col-span-1">
            <x-atoms.neo-brutal-panel class="h-full">
                <div class="flex items-center justify-between p-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold text-white">Card Counts</h2>
                </div>
                <div class="p-4">
                    <!-- Craft Counts -->
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Craft Breakdown</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @forelse($craftCounts as $craftSlug => $count)
                                <div class="flex items-center justify-between py-1 px-2 bg-gray-800/50 rounded-md">
                                    <div class="flex items-center">
                                        <span
                                            class="w-2 h-2 rounded-full mr-2 {{ $this->getCraftBackground($craftSlug) }}"></span>
                                        <span
                                            class="text-xs text-white truncate">{{ $this->getCraftName($craftSlug) }}</span>
                                    </div>
                                    <span class="text-xs font-semibold text-indigo-300">{{ $count }}</span>
                                </div>
                            @empty
                                <div class="p-2 text-center col-span-2">
                                    <p class="text-gray-400 text-xs">No craft data.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Rarity Counts -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-400 mb-2">Rarity Breakdown</h3>
                        <div class="grid grid-cols-2 gap-2">
                            @forelse($rarityCounts as $rarityName => $count)
                                <div class="flex items-center justify-between py-1 px-2 bg-gray-800/50 rounded-md">
                                    <div class="flex items-center">
                                        <span
                                            class="w-2 h-2 rounded-full mr-2 {{ $this->getRarityBackground($rarityName) }}"></span>
                                        <span class="text-xs text-white">{{ $rarityName }}</span>
                                    </div>
                                    <span class="text-xs font-semibold text-indigo-300">{{ $count }}</span>
                                </div>
                            @empty
                                <div class="p-2 text-center col-span-2">
                                    <p class="text-gray-400 text-xs">No rarity data.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </x-atoms.neo-brutal-panel>
        </div>
    </div>

    <!-- Cards in Wishlist Section -->
    <div class="mt-4 mb-8">
        <x-atoms.neo-brutal-panel>
            <div class="flex items-center justify-between p-4 border-b border-gray-800">
                <h2 class="text-lg font-bold text-white">Cards in Wishlist</h2>
                <span class="text-xs text-gray-400">{{ $wishlist->cards->count() }} cards</span>
            </div>
            <div class="p-4 space-y-3">
                @forelse ($wishlist->cards as $card)
                    <x-molecules.card.list-details :card="$card" />
                @empty
                    <div class="p-8 text-center">
                        <p class="text-gray-400">No cards in this wishlist yet.</p>
                    </div>
                @endforelse
            </div>
        </x-atoms.neo-brutal-panel>
    </div>
</div>
