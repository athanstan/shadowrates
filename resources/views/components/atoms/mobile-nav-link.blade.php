@props([
    'route' => null,
    'href' => '#',
    'section' => '',
])

@php
    $classes = 'block px-3 py-2 text-sm font-medium text-purple-400 rounded-md hover:bg-purple-900/30 hover:text-white';
    $activeClass = ':class="{ \'bg-purple-900/30 text-white\': activeSection === \'' . $section . '\' }"';
@endphp

@if ($route)
    <a href="{{ route($route) }}" wire:navigate {!! $activeClass !!} class="{{ $classes }}">
        {{ $slot }}
    </a>
@else
    <a href="{{ $href }}" @click.prevent="activeSection = '{{ $section }}'" {!! $activeClass !!}
        class="{{ $classes }}">
        {{ $slot }}
    </a>
@endif
