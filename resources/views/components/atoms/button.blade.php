@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
])

@php
    $baseClasses =
        'inline-flex items-center justify-center font-medium border-2 transition duration-200 shadow-md rounded-sm';

    $variantClasses = [
        'primary' => 'border-purple-800 bg-purple-700 text-white hover:bg-purple-600 hover:border-purple-700',
        'secondary' => 'border-blue-800 bg-blue-700 text-white hover:bg-blue-600 hover:border-blue-700',
        'success' => 'border-green-800 bg-green-700 text-white hover:bg-green-600 hover:border-green-700',
        'danger' => 'border-red-800 bg-red-700 text-white hover:bg-red-600 hover:border-red-700',
        'outline' => 'border-gray-800 bg-transparent text-gray-800 hover:bg-gray-800 hover:text-white',
        'pixel' => 'border-gray-900 bg-gray-800 text-white hover:bg-gray-700 pixel-corners pixel-shadow',
    ];

    $sizeClasses = [
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-4 py-2',
        'lg' => 'px-6 py-3 text-lg',
    ];

    $classes =
        $baseClasses .
        ' ' .
        $variantClasses[$variant] .
        ' ' .
        $sizeClasses[$size] .
        ' ' .
        ($attributes->get('class') ?? '');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
