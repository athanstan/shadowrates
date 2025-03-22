@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'neo-brutal-panel p-5 rounded-lg mb-6 ' . $class]) }}>
    {{ $slot }}
</div>
