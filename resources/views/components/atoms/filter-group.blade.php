@props([
    'label' => '',
    'for' => '',
    'colspan' => '1',
])

<div class="col-span-{{ $colspan }}">
    <label for="{{ $for }}" class="block text-sm font-medium text-purple-200 mb-1">{{ $label }}</label>
    <div class="relative">
        {{ $slot }}
    </div>
</div>
