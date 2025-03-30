@props(['variant' => 'primary'])

@php
    $baseClasses = 'px-4 py-2 font-semibold transition-all rounded-lg shadow-lg backdrop-blur-sm';
    $variants = [
        'primary' =>
            'text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 hover:shadow-purple-500/30',
        'secondary' => 'text-purple-200 bg-transparent border border-purple-700 hover:bg-purple-700/30',
        'disabled' => 'opacity-50 cursor-not-allowed',
    ];
    $classes = $baseClasses . ' ' . $variants[$variant];
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
