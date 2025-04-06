@props([
    'title' => 'Feature Title',
    'description' => 'Feature description goes here',
    'status' => 'completed', // completed, in-progress, coming-soon, planned
])

@php
    $statusConfig = [
        'completed' => [
            'label' => 'COMPLETED ✓',
            'color' => 'green',
            'borderColor' => 'border-indigo-500/30',
        ],
        'in-progress' => [
            'label' => 'IN PROGRESS',
            'color' => 'yellow',
            'borderColor' => 'border-yellow-500/30',
        ],
        'coming-soon' => [
            'label' => 'COMING SOON',
            'color' => 'purple',
            'borderColor' => 'border-purple-500/30',
        ],
        'planned' => [
            'label' => 'PLANNED',
            'color' => 'blue',
            'borderColor' => 'border-blue-500/30',
        ],
    ];

    $config = $statusConfig[$status] ?? $statusConfig['planned'];
@endphp

<div
    class="relative px-6 py-6 transition-all border rounded-lg shadow-md card-glow {{ $config['borderColor'] }} backdrop-blur-sm bg-black/40 hover:bg-black/80 transform hover:scale-105 duration-500 hover:shadow-lg hover:shadow-indigo-500/30 rotate-2 hover:rotate-0">
    <div
        class="absolute px-2 py-1 font-mono text-xs rounded-md -top-3 -left-3 text-{{ $config['color'] }}-400 bg-{{ $config['color'] }}-400/10 ring-1 ring-inset ring-{{ $config['color'] }}-400/30">
        {{ $config['label'] }}
    </div>
    <h3 class="text-xl font-bold text-white">{{ $title }}</h3>
    <p class="mt-2 text-gray-300">{{ $description }}</p>

    <ul class="mt-4 space-y-3">
        {{ $slot }}
    </ul>
</div>
