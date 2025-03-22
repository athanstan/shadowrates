<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="flex flex-col md:flex-row bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <!-- Card Image -->
            <div class="w-full md:w-1/3 lg:w-1/4">
                <div class="relative">
                    <img src="{{ $card->image_url ?? 'https://via.placeholder.com/400x550?text=Card+Image' }}"
                        alt="{{ $card->name }}" class="w-full h-auto">

                    <!-- Card Cost -->
                    <div
                        class="absolute top-4 left-4 bg-blue-500 text-white font-bold rounded-full w-12 h-12 flex items-center justify-center text-xl">
                        {{ $card->cost }}
                    </div>

                    <!-- Card Rarity -->
                    <div class="absolute top-4 right-4">
                        <span
                            class="inline-block h-5 w-5 rounded-full
                            {{ $card->rarity === 'Bronze'
                                ? 'bg-yellow-700'
                                : ($card->rarity === 'Silver'
                                    ? 'bg-gray-400'
                                    : ($card->rarity === 'Gold'
                                        ? 'bg-yellow-400'
                                        : 'bg-yellow-200')) }}"></span>
                    </div>
                </div>
            </div>

            <!-- Card Details -->
            <div class="w-full md:w-2/3 lg:w-3/4 p-6">
                <div class="flex flex-col lg:flex-row justify-between mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $card->name }}</h1>
                        <div class="flex space-x-4 mt-2">
                            <span
                                class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">
                                {{ $card->cardType->name ?? 'Unknown Type' }}
                            </span>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                {{ $card->craft->name ?? 'Unknown Craft' }}
                            </span>
                            <span
                                class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">
                                {{ $card->cardSet->name ?? 'Unknown Set' }}
                            </span>
                            <span
                                class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                {{ $card->rarity }}
                            </span>
                        </div>
                    </div>

                    @if ($card->cardType && $card->cardType->name === 'Follower')
                        <div class="mt-4 lg:mt-0 flex items-center">
                            <div class="text-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-l-md">
                                <span class="block text-sm text-gray-500 dark:text-gray-400">Attack</span>
                                <span class="text-2xl font-bold text-red-500">{{ $card->attack }}</span>
                            </div>
                            <div
                                class="text-center px-4 py-2 border-t border-b border-r border-gray-200 dark:border-gray-700 rounded-r-md">
                                <span class="block text-sm text-gray-500 dark:text-gray-400">Defense</span>
                                <span class="text-2xl font-bold text-blue-500">{{ $card->defense }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Description</h2>
                    <div class="prose dark:prose-invert max-w-none">
                        <p class="text-gray-700 dark:text-gray-300">{{ $card->description }}</p>
                    </div>
                </div>

                <!-- Card Effect -->
                @if ($card->effect)
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Effect</h2>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md">
                            <p class="text-gray-700 dark:text-gray-300">{{ $card->effect }}</p>
                        </div>
                    </div>
                @endif

                <!-- Card Evolution (for Followers) -->
                @if ($card->cardType && $card->cardType->name === 'Follower' && $card->evolved_effect)
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">Evolved Form</h2>
                        <div class="flex items-center space-x-4 mb-2">
                            <span class="font-medium text-gray-700 dark:text-gray-300">Stats:</span>
                            <span class="text-xl font-bold text-red-500">{{ $card->evolved_attack ?? '?' }}</span>
                            <span class="text-gray-400">/</span>
                            <span class="text-xl font-bold text-blue-500">{{ $card->evolved_defense ?? '?' }}</span>
                        </div>
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-md">
                            <p class="text-gray-700 dark:text-gray-300">{{ $card->evolved_effect }}</p>
                        </div>
                    </div>
                @endif

                <!-- Add to Deck Button -->
                <div class="mt-8 flex items-center space-x-4">
                    <a href="{{ route('cards.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white transition duration-150 ease-in-out">
                        Back to Collection
                    </a>
                    <button
                        class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-md transition duration-150 ease-in-out">
                        Add to Deck
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
