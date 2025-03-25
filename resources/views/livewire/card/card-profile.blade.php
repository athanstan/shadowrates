<div class="min-h-screen py-12">
    <div class="container px-4 mx-auto">
        <!-- Alert Components -->
        <x-atoms.success-alert position="top-center" />
        <x-atoms.error-alert position="top-center" />

        <!-- Card Profile Header -->
        <div class="mb-8 text-center">
            <h1 class="mb-2 text-4xl font-bold text-purple-100">{{ $card->name }}</h1>
            <p class="text-xl text-purple-300">{{ $card->cardType->name }} • {{ $card->craft->name }} •
                {{ $card->cardSet->name }}</p>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-7">
            <!-- Left Column - Card Image -->
            <div class="flex-col col-span-2 space-y-8">
                <div class="overflow-hidden shadow-lg rounded-3xl shadow-purple-900">
                    <img src="{{ $card->getImage() }}" alt="{{ $card->name }}" class="object-cover w-full">

                    @if ($card->evolved_image)
                        <div class="p-4 text-center">
                            <h3 class="mb-2 text-lg font-semibold text-purple-100">Evolved Form</h3>
                            <img src="{{ $card->getEvolvedImage() }}" alt="{{ $card->name }} (Evolved)"
                                class="object-cover w-full rounded-lg">
                        </div>
                    @endif
                </div>
                <!-- Stats Section -->
                <div class="p-6 rounded-lg shadow-lg bg-gradient-to-b from-purple-800 to-purple-950">
                    <h2 class="mb-4 text-2xl font-bold text-purple-100">Card Statistics</h2>

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

                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 text-center rounded-lg bg-purple-700/30">
                                <div class="text-2xl font-bold text-purple-100">{{ $this->tradingUsersCount }}</div>
                                <div class="text-sm text-purple-300">Players Trading</div>
                            </div>

                            <div class="p-4 text-center rounded-lg bg-purple-700/30">
                                <div class="text-2xl font-bold text-purple-100">{{ $this->wishlistUsersCount }}</div>
                                <div class="text-sm text-purple-300">On Wishlists</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Card Details & Stats -->
            <div class="col-span-5 space-y-8">
                <!-- Card Details -->
                <div
                    class="p-6 border rounded-lg shadow-xl backdrop-blur-md bg-gradient-to-br from-purple-800/90 to-purple-950/90 border-purple-700/30">
                    <h2
                        class="mb-6 text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-100 to-indigo-200">
                        Card Details</h2>

                    <div class="mb-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-purple-300">Type:</span>
                            <span class="font-semibold text-purple-100">{{ $card->cardType->name }}</span>
                        </div>

                        @if ($card->sub_type)
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-purple-300">Subtype:</span>
                                <span class="font-semibold text-purple-100">{{ $card->sub_type }}</span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-purple-300">Craft:</span>
                            <span class="font-semibold text-purple-100">{{ $card->craft->name }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-purple-300">Card Set:</span>
                            <span class="font-semibold text-purple-100">{{ $card->cardSet->name }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-purple-300">Rarity:</span>
                            <span class="font-semibold text-purple-100">{{ $card->rarity }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-purple-300">PP Cost:</span>
                            <span class="font-semibold text-purple-100">{{ $card->cost }}</span>
                        </div>

                        @if ($card->traits)
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-purple-300">Traits:</span>
                                <span class="font-semibold text-purple-100">{{ $card->traits }}</span>
                            </div>
                        @endif

                        @if ($card->cardType && $card->cardType->name === 'Follower')
                            <div class="pt-3 border-t border-purple-700/50">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-purple-300">Stats:</span>
                                    <span
                                        class="px-3 py-1 font-semibold text-purple-100 rounded-full bg-purple-700/30 backdrop-blur-sm">{{ $card->atk }}/{{ $card->health }}</span>
                                </div>

                                @if ($card->evolved_atk && $card->evolved_health)
                                    <div class="flex items-center justify-between mt-2">
                                        <span class="font-medium text-purple-300">Evolved:</span>
                                        <span
                                            class="px-3 py-1 font-semibold text-purple-100 rounded-full bg-indigo-700/30 backdrop-blur-sm">{{ $card->evolved_atk }}/{{ $card->evolved_health }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    @if ($card->effects)
                        <div class="pt-5 mt-5 border-t border-purple-700/50">
                            <h3
                                class="mb-3 text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-purple-100 to-indigo-200">
                                Card Effect</h3>
                            <div class="p-4 border rounded-lg bg-purple-800/30 backdrop-blur-sm border-purple-600/20">
                                <p class="text-purple-100">{!! $card->effects !!}</p>
                            </div>
                        </div>
                    @endif

                    @if ($card->description)
                        <div class="pt-5 mt-5 italic border-t border-purple-700/50">
                            <p class="leading-relaxed text-purple-300">{{ $card->description }}</p>
                        </div>
                    @endif

                    <!-- Collection Actions -->
                    @auth
                        <div class="pt-6 mt-6 border-t border-purple-700/50">
                            <h3
                                class="mb-4 text-lg font-semibold text-transparent bg-clip-text bg-gradient-to-r from-purple-100 to-indigo-200">
                                Collection</h3>
                            <div class="flex items-center justify-between">
                                <div
                                    class="flex items-center p-1 space-x-3 border rounded-lg bg-purple-800/30 backdrop-blur-sm border-purple-600/20">
                                    <button wire:click="removeFromCollection"
                                        class="px-3 py-2 text-purple-200 transition-all rounded-md hover:bg-purple-700/60 hover:shadow-lg {{ isset($cardCollection[$card->id]) && $cardCollection[$card->id] > 0 ? '' : 'opacity-50 cursor-not-allowed' }}"
                                        {{ isset($cardCollection[$card->id]) && $cardCollection[$card->id] > 0 ? '' : 'disabled' }}>
                                        <span class="sr-only">Remove from collection</span>
                                        -
                                    </button>

                                    <span class="w-10 text-lg font-semibold text-center text-purple-100">
                                        {{ $cardCollection[$card->id] ?? 0 }}
                                    </span>

                                    <button wire:click="addToCollection"
                                        class="px-3 py-2 text-purple-200 transition-all rounded-md hover:bg-purple-700/60 hover:shadow-lg">
                                        <span class="sr-only">Add to collection</span>
                                        +
                                    </button>
                                </div>

                                <button wire:click="addToCollection"
                                    class="px-5 py-2.5 font-medium text-white transition-all rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 shadow-lg hover:shadow-purple-500/30 backdrop-blur-sm">
                                    Add to Collection
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="pt-6 mt-6 text-center border-t border-purple-700/50">
                            <a href="#login"
                                class="inline-block px-6 py-3 font-medium text-white transition-all rounded-lg shadow-lg bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 hover:shadow-purple-500/30 backdrop-blur-sm">
                                Sign in to add to collection
                            </a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>

        <!-- Related Cards Section -->
        <div class="mt-8">
            <div class="p-6 rounded-lg shadow-lg bg-gradient-to-b from-purple-800 to-purple-950">
                <h2 class="mb-4 text-2xl font-bold text-purple-100">Related Cards</h2>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6">
                    @foreach ($this->relatedCards as $relatedCard)
                        <a href="{{ route('cards.show', $relatedCard) }}" wire:navigate
                            class="block overflow-hidden transition-transform transform rounded-lg hover:scale-105">
                            <img src="{{ $relatedCard->getImage() }}" alt="{{ $relatedCard->name }}"
                                class="object-cover w-full">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Wanted By Players Section -->
        <div class="mt-8">
            <div class="p-6 rounded-lg shadow-lg bg-gradient-to-b from-purple-800 to-purple-950">
                <h2 class="mb-4 text-2xl font-bold text-purple-100">Wanted By Players</h2>

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
        </div>
    </div>
</div>
