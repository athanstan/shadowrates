<div class="container px-4 mx-auto" x-data="userProfile">
    <!-- Collection Completion Bar -->
    <div class="container px-4 mx-auto" x-data="userProfile">
        <!-- Main Profile Panel -->
        <div class="grid grid-cols-1 gap-6 my-6 lg:grid-cols-3">
            <!-- Profile Header Panel (Spans full width) -->
            <div class="col-span-1 lg:col-span-3">
                <x-atoms.neo-brutal-panel class="relative overflow-hidden">
                    <div class="px-6 py-6">
                        <div class="flex flex-wrap items-center gap-6">
                            <!-- User Avatar -->
                            <div class="relative">
                                <img class="object-cover w-24 h-24 p-1 border rounded-lg shadow-lg pixel-corners bg-gradient-to-br from-purple-900/30 to-indigo-900/30 border-purple-500/20 shadow-purple-500/10"
                                    src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                    style="image-rendering: pixelated;">
                                <div
                                    class="absolute -bottom-1 -right-1 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow-md">
                                    Lv. {{ (int) ($user->cards_count / 10) + 1 }}
                                </div>
                            </div>

                            <!-- User Info -->
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <div>
                                        <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                                        <p class="text-sm text-gray-400">
                                            Member since {{ $user->created_at->diffForHumans() }}
                                            <span class="mx-2">•</span>
                                            <span
                                                class="text-purple-400">{{ (int) $user->created_at->diffInDays(null, true) }}
                                                days</span>
                                        </p>
                                    </div>

                                    <!-- Quick Actions -->
                                    <div class="flex gap-2">
                                        <a href="{{ route('decks.index', ['user' => $user->slug]) }}"
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-indigo-600/70 hover:bg-indigo-500 rounded transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-4 h-4 mr-1">
                                                <path
                                                    d="M2 4.25A2.25 2.25 0 014.25 2h11.5A2.25 2.25 0 0118 4.25v8.5A2.25 2.25 0 0115.75 15h-3.105a3.501 3.501 0 001.1 1.677A.75.75 0 0113.26 18H6.74a.75.75 0 01-.484-1.323A3.501 3.501 0 007.355 15H4.25A2.25 2.25 0 012 12.75v-8.5zm1.5 0a.75.75 0 01.75-.75h11.5a.75.75 0 01.75.75v7.5a.75.75 0 01-.75.75H4.25a.75.75 0 01-.75-.75v-7.5z" />
                                            </svg>
                                            Decks
                                        </a>
                                        <a href="{{ route('users.wishlists', $user->slug) }}" wire:navigate
                                            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-purple-600/70 hover:bg-purple-500 rounded transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-4 h-4 mr-1">
                                                <path
                                                    d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                            </svg>
                                            Wishlists
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Collection Completion Bar -->
                        <div class="mt-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5 mr-2 text-purple-400">
                                        <path fill-rule="evenodd"
                                            d="M9.315 7.584C12.195 3.883 16.695 1.5 21.75 1.5a.75.75 0 01.75.75c0 5.056-2.383 9.555-6.084 12.436A6.75 6.75 0 019.75 22.5a.75.75 0 01-.75-.75v-4.131A15.838 15.838 0 016.382 15H2.25a.75.75 0 01-.75-.75 6.75 6.75 0 017.815-6.666zM15 6.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"
                                            clip-rule="evenodd" />
                                        <path
                                            d="M5.26 17.242a.75.75 0 10-.897-1.203 5.243 5.243 0 00-2.05 5.022.75.75 0 00.625.627 5.243 5.243 0 005.022-2.051.75.75 0 10-1.202-.897 3.744 3.744 0 01-3.008 1.51c0-1.23.592-2.323 1.51-3.008z" />
                                    </svg>
                                    <h2 class="font-bold text-white">Void Collection</h2>
                                </div>
                                <div class="text-xl font-bold text-purple-400">
                                    {{ $this->collectionPercentage }}%</div>
                            </div>

                            <div
                                class="relative h-12 overflow-hidden border rounded-lg bg-gray-950 border-purple-900/30">
                                <!-- Progress background -->
                                <div
                                    class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogIDxkZWZzPgogICAgPHBhdHRlcm4gaWQ9InN0YXJzIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgcGF0dGVyblVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CiAgICAgIDxjaXJjbGUgY3g9IjUiIGN5PSI1IiByPSIwLjUiIGZpbGw9IndoaXRlIiBvcGFjaXR5PSIwLjQiLz4KICAgICAgPGNpcmNsZSBjeD0iMTUiIGN5PSIxNSIgcj0iMC4zIiBmaWxsPSJ3aGl0ZSIgb3BhY2l0eT0iMC42Ii8+CiAgICAgIDxjaXJjbGUgY3g9IjI1IiBjeT0iMTAiIHI9IjAuNCIgZmlsbD0id2hpdGUiIG9wYWNpdHk9IjAuNCIvPgogICAgICA8Y2lyY2xlIGN4PSIzNSIgY3k9IjMwIiByPSIwLjMiIGZpbGw9IndoaXRlIiBvcGFjaXR5PSIwLjMiLz4KICAgICAgPGNpcmNsZSBjeD0iNDUiIGN5PSI1IiByPSIwLjUiIGZpbGw9IndoaXRlIiBvcGFjaXR5PSIwLjUiLz4KICAgICAgPGNpcmNsZSBjeD0iNTUiIGN5PSIyMCIgcj0iMC4zIiBmaWxsPSJ3aGl0ZSIgb3BhY2l0eT0iMC40Ii8+CiAgICAgIDxjaXJjbGUgY3g9IjY1IiBjeT0iMzUiIHI9IjAuNCIgZmlsbD0id2hpdGUiIG9wYWNpdHk9IjAuNiIvPgogICAgICA8Y2lyY2xlIGN4PSI3NSIgY3k9IjUiIHI9IjAuMyIgZmlsbD0id2hpdGUiIG9wYWNpdHk9IjAuMyIvPgogICAgICA8Y2lyY2xlIGN4PSI4NSIgY3k9IjE1IiByPSIwLjQiIGZpbGw9IndoaXRlIiBvcGFjaXR5PSIwLjQiLz4KICAgICAgPGNpcmNsZSBjeD0iOTUiIGN5PSIyNSIgcj0iMC4zIiBmaWxsPSJ3aGl0ZSIgb3BhY2l0eT0iMC41Ii8+CiAgICA8L3BhdHRlcm4+CiAgPC9kZWZzPgogIDxyZWN0IHdpZHRoPSIxMDAlIiBoZWlnaHQ9IjEwMCUiIGZpbGw9IiMwMDAiLz4KICA8cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI3N0YXJzKSIvPgo8L3N2Zz4=')]">
                                </div>

                                <!-- Progress bar - simplified -->
                                <div class="absolute inset-0 overflow-hidden">
                                    <div class="absolute inset-y-0 left-0 transition-all duration-1000 ease-out opacity-50 bg-gradient-to-r from-purple-900 to-indigo-800"
                                        style="width: 30%;">
                                    </div>
                                </div>

                                <!-- Subtle overlay -->
                                <div
                                    class="absolute inset-0 pointer-events-none bg-gradient-to-t from-black/20 to-transparent">
                                </div>

                                <!-- Collection status -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div
                                        class="flex items-center px-3 py-1 text-sm font-medium text-white rounded-full bg-black/40 backdrop-blur-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="w-4 h-4 mr-1.5 text-purple-300">
                                            <path
                                                d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z" />
                                            <path
                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0010 3H4.75A2.75 2.75 0 002 5.75v9.5A2.75 2.75 0 004.75 18h9.5A2.75 2.75 0 0017 15.25V10a.75.75 0 00-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5z" />
                                        </svg>
                                        {{ $user->cards_count }} / {{ $this->collectionPercentage }}% Complete
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-atoms.neo-brutal-panel>
            </div>

            <!-- Stats Panel (2/3 width) -->
            <div class="lg:col-span-2">
                <x-atoms.neo-brutal-panel class="h-full">
                    <div class="flex items-center justify-between p-4 border-b border-gray-800">
                        <h2 class="text-lg font-bold text-white">Player Statistics</h2>
                    </div>

                    <div class="p-4">
                        <!-- Stats Cards -->
                        <div class="grid grid-cols-2 gap-4 mb-6 md:grid-cols-4">
                            <div
                                class="p-4 border rounded-lg bg-gradient-to-b from-purple-900/20 to-purple-900/5 border-purple-900/10">
                                <div class="text-2xl font-bold text-purple-400">{{ $user->cards_count }}</div>
                                <div class="text-xs tracking-wide text-gray-400 uppercase">Cards Owned</div>
                            </div>
                            <div
                                class="p-4 border rounded-lg bg-gradient-to-b from-indigo-900/20 to-indigo-900/5 border-indigo-900/10">
                                <div class="text-2xl font-bold text-indigo-400">{{ $user->decks_count }}</div>
                                <div class="text-xs tracking-wide text-gray-400 uppercase">Decks Built</div>
                            </div>
                            <div
                                class="p-4 border rounded-lg bg-gradient-to-b from-blue-900/20 to-blue-900/5 border-blue-900/10">
                                <div class="text-2xl font-bold text-blue-400">{{ $user->wishlists_count ?? 0 }}</div>
                                <div class="text-xs tracking-wide text-gray-400 uppercase">Wishlists</div>
                            </div>
                            <div
                                class="p-4 border rounded-lg bg-gradient-to-b from-teal-900/20 to-teal-900/5 border-teal-900/10">
                                <div class="text-2xl font-bold text-teal-400">
                                    {{ number_format($user->win_rate ?? 0) }}%
                                </div>
                                <div class="text-xs tracking-wide text-gray-400 uppercase">Win Rate</div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div>
                            <h3 class="mb-3 font-medium text-white text-md">Recent Activity</h3>
                            <div class="space-y-3">
                                @if (isset($user->recentActivity) && $user->recentActivity->count() > 0)
                                    @foreach ($user->recentActivity as $activity)
                                        <div class="flex items-center p-2 rounded-md bg-gray-800/40">
                                            <div
                                                class="flex items-center justify-center flex-shrink-0 w-8 h-8 mr-3 rounded-full bg-purple-900/30">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-4 h-4 text-purple-400">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-13a.75.75 0 00-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 000-1.5h-3.25V5z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm text-gray-300">{{ $activity->description }}</p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $activity->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="py-6 text-center text-gray-500">
                                        No recent activity to show
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </x-atoms.neo-brutal-panel>
            </div>

            <!-- Side Panel (1/3 width) -->
            <div class="lg:col-span-1">
                <x-atoms.neo-brutal-panel class="h-full">
                    <div class="flex items-center justify-between p-4 border-b border-gray-800">
                        <h2 class="text-lg font-bold text-white">Favorite Crafts</h2>
                    </div>

                    <div class="p-4">
                        <!-- Craft Preferences -->
                        <div class="mb-6 space-y-3">
                            @foreach ($this->crafts as $craft)
                                <div class="relative">
                                    <div class="flex items-center justify-between mb-1">
                                        <div class="flex items-center">
                                            <span
                                                class="inline-block w-3 h-3 rounded-sm mr-2 {{ $this->getCraftBackground($craft->slug) }}"></span>
                                            <span class="text-xs text-white">{{ $craft->name }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-medium text-indigo-300">
                                                {{ $this->craftCounts[$craft->slug . '_percentage'] }}%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex h-1.5 overflow-hidden bg-gray-800 rounded-sm">
                                        <div style="width: {{ $this->craftCounts[$craft->slug . '_percentage'] }}%"
                                            class="{{ $this->getCraftBackground($craft->slug) }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </x-atoms.neo-brutal-panel>
            </div>
        </div>

        <!-- Wishlists Section -->
        <div class="mt-6 mb-8">
            <x-atoms.neo-brutal-panel>
                <div class="flex items-center justify-between p-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold text-white">Latest Wishlists</h2>
                    <a href="{{ route('users.wishlists', $user->slug) }}" wire:navigate
                        class="text-xs text-purple-400 transition hover:text-purple-300">
                        View All
                    </a>
                </div>

                <div class="p-4">
                    @if (isset($user->wishlists) && $user->wishlists->count() > 0)
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($user->wishlists->take(3) as $wishlist)
                                <a href="{{ route('wishlists.show', $wishlist->slug) }}"
                                    class="block p-4 transition border border-gray-700 rounded-lg bg-gradient-to-b from-gray-800 to-gray-900 hover:border-purple-700 group">
                                    <div class="flex items-start justify-between mb-2">
                                        <h3
                                            class="font-bold text-white transition text-md group-hover:text-purple-400">
                                            {{ $wishlist->title }}</h3>
                                        <span
                                            class="px-2 py-0.5 text-xs text-white rounded-full {{ $wishlist->is_public ? 'bg-green-600/70' : 'bg-red-600/70' }}">
                                            {{ $wishlist->is_public ? 'Public' : 'Private' }}
                                        </span>
                                    </div>
                                    <div class="mb-3 text-xs text-gray-400">
                                        {{ $wishlist->created_at->diffForHumans() }}
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-4 h-4 mr-1 text-indigo-400">
                                                <path
                                                    d="M9.654 16.052a3.326 3.326 0 01-3.162-2.33A.528.528 0 006 13.2v-.348c0-.265-.264-.375-.41-.196l-.387.446a1.15 1.15 0 01-1.613.073l-.21-.207a1.06 1.06 0 01.073-1.53l.387-.446c.152-.176.03-.437-.191-.414l-.493.022a1.109 1.109 0 01-1.15-1.041v-.616a1.11 1.11 0 011.15-1.04l.493.02c.221.023.343-.239.191-.413l-.387-.447a1.06 1.06 0 01-.073-1.53l.21-.207a1.15 1.15 0 011.613.073l.387.447c.147.178.41.068.41-.197v-.348c0-.265.18-.49.43-.528A3.326 3.326 0 019.654 3.95a.75.75 0 00-.692 0 3.326 3.326 0 013.163 2.329c.25.38.429.262.429.528v.348c0 .264.263.375.41.196l.387-.446a1.15 1.15 0 011.613-.073l.21.207a1.06 1.06 0 01-.073 1.53l-.387.446c-.152.176-.03.437.191.414l.493-.022a1.109 1.109 0 011.15 1.041v.616a1.11 1.11 0 01-1.15 1.04l-.493-.02c-.221-.023-.343.239-.191.413l.387.447a1.06 1.06 0 01.073 1.53l-.21.207a1.15 1.15 0 01-1.613-.073l-.387-.447c-.147-.178-.41-.068-.41.197v.348c0 .265-.18.49-.43.528a3.325 3.325 0 01-3.162 2.329.754.754 0 00.346-.128.75.75 0 00.345.128z" />
                                            </svg>
                                            {{ $wishlist->cards->count() }} cards
                                        </div>
                                        <div
                                            class="font-medium text-purple-400 transition group-hover:text-purple-300">
                                            View →
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        @if ($user->wishlists->count() > 3)
                            <div class="mt-4 text-center">
                                <a href="{{ route('users.wishlists', $user->slug) }}" wire:navigate
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition rounded bg-purple-600/70 hover:bg-purple-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-4 h-4 mr-1">
                                        <path
                                            d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm8 1a1 1 0 100-2 1 1 0 000 2zm-3-1a1 1 0 11-2 0 1 1 0 012 0zm7 1a1 1 0 100-2 1 1 0 000 2z" />
                                    </svg>
                                    See All {{ $user->wishlists->count() }} Wishlists
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="flex flex-col items-center justify-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                            <p class="mt-4 text-gray-400">No wishlists created yet</p>
                            @if (Auth::check() && Auth::id() === $user->id)
                                <a href="{{ route('wishlists.create') }}"
                                    class="px-4 py-2 mt-4 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    Create Your First Wishlist
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </x-atoms.neo-brutal-panel>
        </div>

        <!-- Decks Section -->
        <div class="mt-6 mb-8">
            <x-atoms.neo-brutal-panel>
                <div class="flex items-center justify-between p-4 border-b border-gray-800">
                    <h2 class="text-lg font-bold text-white">Latest Decks</h2>
                    <a href="{{ route('decks.index', ['user' => $user->slug]) }}"
                        class="text-xs text-indigo-400 transition hover:text-indigo-300">
                        View All
                    </a>
                </div>

                <div class="p-4">
                    @if (isset($user->decks) && $user->decks->count() > 0)
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($user->decks->take(3) as $deck)
                                <a href="{{ route('decks.show', $deck->slug) }}"
                                    class="block p-4 transition border border-gray-700 rounded-lg bg-gradient-to-b from-gray-800 to-gray-900 hover:border-indigo-700 group">
                                    <div class="flex items-start justify-between mb-2">
                                        <h3
                                            class="font-bold text-white transition text-md group-hover:text-indigo-400">
                                            {{ $deck->name }}</h3>
                                        <span
                                            class="px-2 py-0.5 text-xs text-white rounded-full {{ $deck->is_public ? 'bg-green-600/70' : 'bg-red-600/70' }}">
                                            {{ $deck->is_public ? 'Public' : 'Private' }}
                                        </span>
                                    </div>
                                    <div class="mb-3 text-xs text-gray-400">
                                        {{ isset($deck->craft) ? $deck->craft->name : 'Unknown Craft' }}
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="w-4 h-4 mr-1 text-indigo-400">
                                                <path
                                                    d="M7 3.5A1.5 1.5 0 018.5 2h3.879a1.5 1.5 0 011.06.44l3.122 3.12A1.5 1.5 0 0117 6.622V12.5a1.5 1.5 0 01-1.5 1.5h-1v-3.379a3 3 0 00-.879-2.121L10.5 5.379A3 3 0 008.379 4.5H7v-1z" />
                                                <path
                                                    d="M4.5 6A1.5 1.5 0 003 7.5v9A1.5 1.5 0 004.5 18h7a1.5 1.5 0 001.5-1.5v-5.879a1.5 1.5 0 00-.44-1.06L9.44 6.439A1.5 1.5 0 008.378 6H4.5z" />
                                            </svg>
                                            {{ $deck->cards_count ?? 0 }} cards
                                        </div>
                                        <div
                                            class="font-medium text-indigo-400 transition group-hover:text-indigo-300">
                                            View →
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        @if ($user->decks->count() > 3)
                            <div class="mt-4 text-center">
                                <a href="{{ route('decks.index', ['user' => $user->slug]) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition rounded bg-indigo-600/70 hover:bg-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-4 h-4 mr-1">
                                        <path fill-rule="evenodd"
                                            d="M3.5 2A1.5 1.5 0 002 3.5V15a3 3 0 106 0V3.5A1.5 1.5 0 006.5 2h-3zm11.753 6.99L9.5 14.743V6.257l5.753 2.733a.75.75 0 010 1.346z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    See All {{ $user->decks->count() }} Decks
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="flex flex-col items-center justify-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            <p class="mt-4 text-gray-400">No decks created yet</p>
                            @if (Auth::check() && Auth::id() === $user->id)
                                <a href="{{ route('decks.create') }}"
                                    class="px-4 py-2 mt-4 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Create Your First Deck
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </x-atoms.neo-brutal-panel>
        </div>
    </div>
