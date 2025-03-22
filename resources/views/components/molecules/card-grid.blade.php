@props(['class' => ''])

<div
    {{ $attributes->merge(['class' => 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 ' . $class]) }}>
    {{ $slot }}
</div>
