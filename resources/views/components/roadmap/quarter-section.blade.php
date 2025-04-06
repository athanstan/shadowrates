@props([
    'quarter' => 'Q1 2024',
    'badge' => 'Right Now',
    'badgeEmoji' => '😎',
    'badgeColor' => 'indigo',
])

@php
    $badgeClasses = [
        'indigo' => 'text-indigo-300 border-indigo-500/30 bg-indigo-500/10',
        'purple' => 'text-purple-300 border-purple-500/30 bg-purple-500/10',
        'blue' => 'text-blue-300 border-blue-500/30 bg-blue-500/10',
    ];

    $gradientClasses = [
        'indigo' => 'from-purple-600 to-indigo-600',
        'purple' => 'from-purple-600 to-indigo-600',
        'blue' => 'from-blue-600 to-indigo-600',
    ];

    $badgeClass = $badgeClasses[$badgeColor] ?? $badgeClasses['indigo'];
    $gradientClass = $gradientClasses[$badgeColor] ?? $gradientClasses['indigo'];
@endphp

<div class="mb-24" x-data="{}">
    <div class="relative">
        <div
            class="inline-flex items-center justify-center px-4 py-2 ml-4 font-mono text-lg border rounded-md shadow-glow-sm lg:ml-0 lg:absolute lg:-left-48 lg:top-0 {{ $badgeClass }}">
            <span class="text-xs uppercase">{{ $badge }}</span>
            <span class="ml-2 font-bold">{{ $badgeEmoji }}</span>
        </div>
        <h2
            class="inline-block px-4 py-2 text-xl font-bold text-white rounded-md bg-gradient-to-r {{ $gradientClass }} shadow-glow-md">
            {{ $quarter }}</h2>
    </div>

    {{ $slot }}
</div>
