@props([
    'small' => false,
])

<button
    {{ $attributes->merge(['class' => 'rounded font-medium text-white bg-gradient-to-b from-violet-500 to-violet-600 border border-purple-600 shadow-lg shadow-violet-500/30 transition duration-200 ease-in-out hover:from-violet-600 hover:to-violet-500 hover:shadow-violet-500/40 hover:-translate-y-0.5 active:translate-y-0.5 active:shadow-md ' . ($small ? 'py-1 px-4 text-sm' : 'py-2 px-8')]) }}>
    {{ $slot }}
</button>
