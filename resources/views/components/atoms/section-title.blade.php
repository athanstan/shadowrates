@props(['from' => 'blue-400', 'via' => 'purple-500', 'to' => 'purple-400'])

<h2 class="relative inline-block text-2xl font-bold md:text-3xl">
    <span
        class="text-transparent bg-gradient-to-r from-{{ $from }} via-{{ $via }} to-{{ $to }} bg-clip-text">
        {{ $slot }}
    </span>
    <div class="w-full h-1 bg-gradient-to-r from-transparent via-{{ $via }} to-transparent"></div>
</h2>
