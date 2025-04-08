@props(['href' => '#'])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 rounded-lg text-white font-medium tracking-wide neo-brutal-link']) }}>
    {{ $slot }}
</a>
