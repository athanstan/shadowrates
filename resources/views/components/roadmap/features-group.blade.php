@props([
    'columns' => 2,
])

<div class="relative grid grid-cols-1 gap-12 ml-8 mt-16 lg:grid-cols-{{ $columns }} lg:ml-0 animate-fade-in">
    {{ $slot }}
</div>
