@props([
    'title' => 'No items found',
    'message' => 'Try adjusting your search or filter criteria',
])

<div class="col-span-full flex flex-col items-center justify-center py-12 glass-effect rounded-lg">
    <svg class="w-16 h-16 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <h3 class="mt-4 text-xl font-medium text-purple-200">{{ $title }}</h3>
    <p class="mt-2 text-purple-400">{{ $message }}</p>

    @if (isset($actions))
        <div class="mt-4">
            {{ $actions }}
        </div>
    @endif
</div>
