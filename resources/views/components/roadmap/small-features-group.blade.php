@props([
    'title' => 'Small Improvements',
    'columns' => 3,
])

<div class="relative grid grid-cols-1 gap-6 mt-16 ml-8 lg:ml-0 animate-fade-in">
    <h3 class="text-xl font-bold text-indigo-400">{{ $title }}</h3>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-{{ $columns }}">
        {{ $slot }}
    </div>
</div>
