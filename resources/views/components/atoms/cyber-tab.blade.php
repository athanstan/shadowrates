@props(['active' => false])

<button
    {{ $attributes->merge(['class' => 'px-3 py-2 text-sm font-medium cyber-tab ' . ($active ? 'active text-purple-200' : 'text-purple-400')]) }}>
    {{ $slot }}
</button>
