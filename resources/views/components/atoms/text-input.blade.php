@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'type' => 'text',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'disabled' => false,
    'error' => null,
])

<div class="mb-4">
    @if ($label)
        <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-white">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
        placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-2 bg-gray-800 border-2 ' . ($error ? 'border-red-500' : 'border-gray-700') . ' rounded-sm text-white placeholder-gray-400 focus:outline-none focus:border-purple-500 transition duration-200']) }} />

    @if ($error)
        <p class="mt-1 text-sm text-red-500">{{ $error }}</p>
    @endif
</div>
