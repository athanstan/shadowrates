@props([
    'status' => 'completed', // completed, in-progress, coming-soon, planned
])

@php
    $statusConfig = [
        'completed' => [
            'icon' => '✓',
            'color' => 'green',
        ],
        'in-progress' => [
            'icon' => '⟳',
            'color' => 'yellow',
        ],
        'coming-soon' => [
            'icon' => '★',
            'color' => 'purple',
        ],
        'planned' => [
            'icon' => '●',
            'color' => 'blue',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['planned'];
@endphp

<li class="flex items-start">
    <span
        class="inline-flex items-center justify-center flex-shrink-0 w-5 h-5 mr-2 rounded-full text-{{ $config['color'] }}-400 bg-{{ $config['color'] }}-400/20">{{ $config['icon'] }}</span>
    <span class="text-gray-200">{{ $slot }}</span>
</li>
