<div class="min-h-screen py-12">
    <div class="container px-4 mx-auto">
        <!-- Alert Components -->
        <x-atoms.success-alert position="top-center" />
        <x-atoms.error-alert position="top-center" />

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-12">
            <!-- Left Column - Card Image (Sticky) -->
            <div class="lg:col-span-3 md:col-span-1">
                <div class="sticky space-y-4 top-8">
                    <div class="overflow-hidden shadow-lg rounded-3xl shadow-purple-900">
                        <x-atoms.card-image :card="$card" :showEvolved="true" />
                    </div>

                    <!-- Collection Actions -->
                    @auth
                        <x-organisms.container.neo-brutal>
                            <x-atoms.collection-controls :card="$card" :cardCollection="$cardCollection" />
                        </x-organisms.container.neo-brutal>
                    @else
                        <x-organisms.container.neo-brutal>
                            <div class="text-center">
                                <a href="#login">
                                    <x-atoms.button>Sign in to add to collection</x-atoms.button>
                                </a>
                            </div>
                        </x-organisms.container.neo-brutal>
                    @endauth
                </div>
            </div>

            <!-- Middle Column - Card Details, Related Cards, Wanted By Players -->
            <div class="space-y-8 lg:col-span-6 md:col-span-1">

                <!-- Card Profile Header -->
                <div class="mb-8">
                    <x-atoms.card-header :card="$card" />
                </div>
                <!-- Card Details -->
                <x-organisms.container.neo-brutal>
                    <x-atoms.section-header title="Card Details" />
                    <x-atoms.card-details :card="$card" />
                </x-organisms.container.neo-brutal>

                <!-- Related Cards Section -->
                <x-organisms.container.neo-brutal>
                    <div class="rounded-lg shadow-lg">
                        <x-atoms.section-header title="Related Cards" />

                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                            @foreach ($this->relatedCards as $relatedCard)
                                <x-atoms.card-preview :card="$relatedCard" />
                            @endforeach
                        </div>
                    </div>
                </x-organisms.container.neo-brutal>

                <!-- Wanted By Players Section -->
                <x-organisms.container.neo-brutal>
                    <div class="rounded-lg shadow-lg">
                        <x-atoms.section-header title="Wanted By Players" />

                        @if ($this->wantedByPlayers->isNotEmpty())
                            <ul class="space-y-3">
                                @foreach ($this->wantedByPlayers as $user)
                                    <li class="flex items-center justify-between p-3 rounded-lg bg-purple-700/30">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0 w-10 h-10 overflow-hidden rounded-full">
                                                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"
                                                    class="object-cover w-full h-full">
                                            </div>
                                            <div>
                                                <a href="{{ route('users.profile', $user) }}" wire:navigate
                                                    class="font-medium text-purple-100 hover:text-white">
                                                    {{ $user->name }}
                                                </a>
                                            </div>
                                        </div>
                                        <span class="text-sm text-purple-300">{{ $cardCollection[$card->id] ?? 0 }}
                                            owned</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div class="p-4 text-center rounded-lg bg-purple-700/30">
                                <p class="text-purple-300">No players are currently looking for this card.</p>
                            </div>
                        @endif
                    </div>
                </x-organisms.container.neo-brutal>
            </div>

            <!-- Right Column - Stats -->
            <div class="lg:col-span-3 md:col-span-2 lg:md:col-span-3">
                <div class="sticky space-y-8 top-8">
                    <!-- Stats Section -->
                    <x-organisms.container.neo-brutal>
                        <x-atoms.section-header title="Card Statistics" />

                        <div class="space-y-6">
                            <div class="relative pt-1">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-purple-300">Deck Usage</span>
                                    <span class="text-sm font-semibold text-purple-100">{{ $this->cardDeckCount }} /
                                        {{ $this->totalDeckCount }}</span>
                                </div>
                                <div class="flex h-2 mb-4 overflow-hidden text-xs rounded bg-purple-700/30">
                                    <div style="width: {{ $this->totalDeckCount > 0 ? ($this->cardDeckCount / $this->totalDeckCount) * 100 : 0 }}%"
                                        class="flex flex-col justify-center text-center text-white shadow-none whitespace-nowrap bg-gradient-to-r from-purple-500 to-indigo-500">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-1">
                                <x-molecules.card.simple-stats :count="$this->wishlistUsersCount" title="On Wishlists" />
                                <x-molecules.card.simple-stats :count="$this->tradingUsersCount" title="Players Trading" />
                            </div>
                        </div>
                    </x-organisms.container.neo-brutal>
                </div>
            </div>
        </div>
    </div>
</div>
