@props(['id', 'label' => '', 'checked' => false])

<div class="flex items-center space-x-3">
    <input {{ $attributes }} type="checkbox" id="{{ $id }}" class="sr-only peer"
        {{ $checked ? 'checked' : '' }} />
    <label for="{{ $id }}"
        class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-gray-600/50
               backdrop-blur-sm transition-colors duration-300 ease-in-out
               after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5
               after:rounded-full after:bg-white after:shadow-md after:transition-transform
               after:duration-300 after:ease-in-out hover:bg-gray-500/50
               peer-checked:bg-purple-700 peer-checked:after:translate-x-5
               peer-checked:after:bg-purple-100 peer-focus:ring-2 peer-focus:ring-purple-600/50
               peer-checked:shadow-[0_0_8px_2px_rgba(107,70,193,0.6)] peer-checked:after:shadow-[0_0_4px_2px_rgba(167,139,250,0.4)]">
        <span class="sr-only">{{ $label ?: 'Toggle' }}</span>
    </label>
    @if ($label)
        <span class="text-sm font-medium text-purple-300">{{ $label }}</span>
    @endif
</div>
