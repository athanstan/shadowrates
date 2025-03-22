@props([
    'active' => false,
    'direction' => 'asc',
])

<button
    {{ $attributes->merge([
        'class' =>
            'text-sm px-3 py-1 rounded-md transition-all ' .
            ($active
                ? 'bg-purple-700 text-purple-100 shadow-md shadow-purple-900/50'
                : 'bg-gray-800 text-purple-300 hover:bg-gray-700'),
    ]) }}>
    {{ $slot }}
    @if ($active)
        <span class="ml-1">{{ $direction === 'asc' ? '↑' : '↓' }}</span>
    @endif
</button>
