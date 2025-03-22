@props(['href' => null])

@if ($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'inline-block px-6 py-3 text-lg font-semibold text-white rounded-md neo-brutal-button hover:bg-purple-700']) }}>
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['class' => 'inline-block px-6 py-3 text-lg font-semibold text-white rounded-md neo-brutal-button hover:bg-purple-700']) }}>
        {{ $slot }}
    </button>
@endif
