@props([
    'route' => null,
    'href' => '#',
    'active' => false,
    'section' => '',
    'params' => [],
])

@php
    $classes = 'px-3 py-2 text-sm font-medium transition-all duration-300 cyber-tab';
    $isActive = $route && request()->routeIs($route);
    $activeClass =
        ':class="{ \'active text-purple-200\': activeSection === \'' .
        $section .
        '\' || ' .
        ($isActive ? 'true' : 'false') .
        ', \'text-purple-400\': activeSection !== \'' .
        $section .
        '\' && ' .
        (!$isActive ? 'true' : 'false') .
        ' }"';
@endphp

@if ($route)
    <a href="{{ isset($params) && !empty($params) ? route($route, $params) : route($route) }}" wire:navigate
        @click.prevent="activeSection = '{{ $section }}'" {!! $activeClass !!} class="{{ $classes }}">
        {{ $slot }}
    </a>
@else
    <a href="{{ $href }}" @click.prevent="activeSection = '{{ $section }}'" {!! $activeClass !!}
        class="{{ $classes }}">
        {{ $slot }}
    </a>
@endif
