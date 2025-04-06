@props([
    'title' => 'Feature Title',
    'status' => 'completed', // completed, in-progress, coming-soon
])

@php
    $statusConfig = [
        'completed' => [
            'icon' => '✓',
            'color' => 'green',
            'borderColor' => 'border-green-500/30',
        ],
        'in-progress' => [
            'icon' => '⟳',
            'color' => 'yellow',
            'borderColor' => 'border-yellow-500/30',
        ],
        'coming-soon' => [
            'icon' => '★',
            'color' => 'purple',
            'borderColor' => 'border-purple-500/30',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['completed'];
@endphp

<div class="px-4 py-3 border rounded-lg shadow-md {{ $config['borderColor'] }} backdrop-blur-sm bg-black/30">
    <div class="flex items-center justify-between">
        <span class="font-mono text-sm text-gray-200">{{ $title }}</span>
        <span
            class="inline-flex items-center justify-center w-5 h-5 rounded-full text-{{ $config['color'] }}-400 bg-{{ $config['color'] }}-400/20">{{ $config['icon'] }}</span>
    </div>
</div>
