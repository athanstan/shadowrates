@props(['size' => '12'])

<div {{ $attributes->merge(['class' => 'flex justify-center']) }}>
    <div
        class="animate-spin rounded-full h-{{ $size }} w-{{ $size }} border-t-2 border-b-2 border-purple-500 shadow-purple-500/50">
    </div>
</div>
