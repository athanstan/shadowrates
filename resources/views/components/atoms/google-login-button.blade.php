@props([
    'size' => 'md',
    'class' => '',
])

<x-atoms.button href="{{ route('auth.google.redirect') }}" variant="secondary" :size="$size"
    class="flex items-center gap-2 {{ $class }}">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5">
        <path fill="#EA4335"
            d="M5.266 9.765A7.077 7.077 0 0 1 12 4.909c1.96 0 3.729.8 5.029 2.09l3.057-3.058A11.084 11.084 0 0 0 12 .727a11.05 11.05 0 0 0-9.834 6.078l3.1 2.96z" />
        <path fill="#34A853"
            d="M16.04 18.013c-1.177.785-2.677 1.25-4.04 1.25a7.08 7.08 0 0 1-6.723-4.823l-3.112 2.954a11.052 11.052 0 0 0 9.834 6.052c2.87 0 5.59-.989 7.648-2.9l-3.607-2.533z" />
        <path fill="#4A90E2"
            d="M19.834 11.182c0-.638-.057-1.252-.164-1.841H12v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716l3.607 2.533c2.106-1.95 3.323-4.823 3.323-8.216" />
        <path fill="#FBBC05"
            d="M5.277 14.268a7.034 7.034 0 0 1-.384-2.27c0-.79.139-1.548.384-2.27l-3.1-2.96a11.033 11.033 0 0 0-1.172 5.23c0 1.791.334 3.506.962 5.09l3.11-2.82z" />
    </svg>
    <span>{{ $slot }}</span>
</x-atoms.button>
