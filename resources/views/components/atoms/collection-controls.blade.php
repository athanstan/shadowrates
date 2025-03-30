@props(['card', 'cardCollection'])

<div x-data class="flex-col items-center justify-between space-y-2">
    <div
        class="flex items-center justify-between p-1 border rounded-lg bg-purple-800/30 backdrop-blur-sm border-purple-600/20">
        <button x-cloak x-show="$wire.cardQuantity > 0" @click="if ($wire.cardQuantity > 0) $wire.cardQuantity--"
            class="px-3 py-2 text-purple-200 transition-all rounded-md hover:bg-purple-700/60 hover:shadow-lg">
            <span class="sr-only">Remove from collection</span>
            <span>-</span>
        </button>
        <div x-show="$wire.cardQuantity <= 0" class="w-10"></div>

        <span x-text="$wire.cardQuantity" class="w-10 text-lg font-semibold text-center text-purple-100"></span>

        <button @click="$wire.cardQuantity++"
            class="px-3 py-2 text-purple-200 transition-all rounded-md hover:bg-purple-700/60 hover:shadow-lg">
            <span class="sr-only">Add to collection</span>
            <span>+</span>
        </button>
    </div>

    <x-atoms.button.primary wire:click="saveCollection" class="w-full">Add to Collection</x-atoms.button.primary>
</div>
