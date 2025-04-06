@props([
    'title' => 'Coming Soon',
    'description' => 'This feature is coming soon',
    'icon' => 'sparkles',
    'section' => '',
    'textColor' => 'text-yellow-400',
    'mobile' => false,
])

@php
    $icons = [
        'sparkles' =>
            '<svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm7 8a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1zm-5 4a1 1 0 100 2 1 1 0 000-2zm7-11a1 1 0 10-2 0 1 1 0 002 0zM8 5a1 1 0 100-2 1 1 0 000 2z"></path></svg>',
        'construction' =>
            '<svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9.504 1.132a1 1 0 01.992 0l1.75 1a1 1 0 11-.992 1.736L10 3.152l-1.254.716a1 1 0 11-.992-1.736l1.75-1zM5.618 4.504a1 1 0 01-.372 1.364L5.016 6l.23.132a1 1 0 11-.992 1.736L4 7.723V8a1 1 0 01-2 0V6a.996.996 0 01.52-.878l1.734-.99a1 1 0 011.364.372zm8.764 0a1 1 0 011.364-.372l1.733.99A1.002 1.002 0 0118 6v2a1 1 0 11-2 0v-.277l-.254.145a1 1 0 11-.992-1.736l.23-.132-.23-.132a1 1 0 01-.372-1.364zm-7 4a1 1 0 011.364-.372L10 8.848l1.254-.716a1 1 0 11.992 1.736L11 10.58V12a1 1 0 11-2 0v-1.42l-1.246-.712a1 1 0 01-.372-1.364zM3 11a1 1 0 011 1v1.42l1.246.712a1 1 0 11-.992 1.736l-1.75-1A1 1 0 012 14v-2a1 1 0 011-1zm14 0a1 1 0 011 1v2a1 1 0 01-.504.868l-1.75 1a1 1 0 11-.992-1.736L16 13.42V12a1 1 0 011-1zm-9.618 5.504a1 1 0 011.364-.372l.254.145V16a1 1 0 112 0v.277l.254-.145a1 1 0 11.992 1.736l-1.735.992a.995.995 0 01-1.022 0l-1.735-.992a1 1 0 01-.372-1.364z" clip-rule="evenodd"></path></svg>',
        'hot' =>
            '<svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>',
    ];

    $iconSvg = $icons[$icon] ?? $icons['sparkles'];
@endphp

@if ($mobile)
    <div x-data="{ showTooltip: false }" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false" class="relative block">
        <a href="#" @click.prevent="activeSection = '{{ $section }}'"
            :class="{ 'bg-purple-900/30 {{ $textColor }}': activeSection === '{{ $section }}' }"
            class="relative block px-3 py-2 text-sm font-medium rounded-md {{ $textColor }} hover:bg-purple-900/30 hover:text-white">
            {{ $slot }}
            <span class="inline-flex items-center">{!! $iconSvg !!}</span>
        </a>

        <div x-cloak x-show="showTooltip" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute z-50 px-3 py-2 mt-1 text-sm text-white transform -translate-x-1/2 bg-gray-900 border border-gray-800 rounded-md shadow-lg left-1/2 w-48">
            <div class="font-semibold">{{ $title }}</div>
            <div class="text-xs text-gray-400">{{ $description }}</div>
        </div>
    </div>
@else
    <div x-data="{ showTooltip: false }" @mouseenter="showTooltip = true" @mouseleave="showTooltip = false"
        class="relative inline-flex">
        <a href="#" @click.prevent="activeSection = '{{ $section }}'"
            :class="{ 'active {{ $textColor }}': activeSection === '{{ $section }}', '{{ $textColor }}': activeSection !== '{{ $section }}' }"
            class="relative px-3 py-2 text-sm font-medium transition-all duration-300 cyber-tab flex items-center">
            {{ $slot }}
            <span class="inline-flex items-center">{!! $iconSvg !!}</span>
        </a>

        <div x-cloak x-show="showTooltip" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute z-50 px-3 py-2 mt-1 text-sm text-white transform -translate-x-1/2 bg-gray-900 border border-gray-800 rounded-md shadow-lg left-1/2 w-48 top-full">
            <div class="font-semibold">{{ $title }}</div>
            <div class="text-xs text-gray-400">{{ $description }}</div>
        </div>
    </div>
@endif
