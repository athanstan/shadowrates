@props([
    'placeholder' => 'Search...',
    'wire:model' => null,
])

<div class="relative">
    <input
        {{ $attributes->merge(['class' => 'w-full bg-gray-800 border-purple-700 p-4 rounded-md shadow-inner shadow-purple-900/30 focus:border-purple-500 focus:ring focus:ring-purple-500/20 focus:ring-opacity-50 focus:outline-none text-purple-100 placeholder-purple-300/50']) }}
        type="text" placeholder="{{ $placeholder }}"
        @if (isset($attributes['wire:model'])) wire:model{{ $attributes['wire:model'] ? '.' . $attributes['wire:model'] : '' }}="{{ $attributes['name'] ?? 'search' }}" @endif>
    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
        <svg class="w-5 h-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
</div>
