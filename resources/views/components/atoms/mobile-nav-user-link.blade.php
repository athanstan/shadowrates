@props([
    'route' => null,
    'href' => '#',
    'params' => [],
])

@php
    $classes = 'block px-3 py-2 text-sm font-medium text-purple-300 rounded-md hover:bg-gray-800 hover:text-white';
@endphp

@if ($route)
    <a href="{{ isset($params) && !empty($params) ? route($route, $params) : route($route) }}" wire:navigate
        class="{{ $classes }} {{ request()->routeIs($route) ? 'bg-gray-800 text-white' : '' }}">
        {{ $slot }}
    </a>
@else
    <a href="{{ $href }}"
        class="{{ $classes }} {{ url()->current() == $href ? 'bg-gray-800 text-white' : '' }}">
        {{ $slot }}
    </a>
@endif
