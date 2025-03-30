@props(['title', 'subtitle' => null])

<div class="mb-6">
    <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-100 to-indigo-200">
        {{ $title }}
    </h2>
    @if ($subtitle)
        <p class="mt-1 text-sm text-purple-300">{{ $subtitle }}</p>
    @endif
</div>
