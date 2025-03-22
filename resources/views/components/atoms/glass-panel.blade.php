@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'glass-effect p-4 rounded-lg ' . $class]) }}>
    {{ $slot }}
</div>
