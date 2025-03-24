@props([
    'options' => [],
    'emptyOption' => 'All',
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'small' => false,
])

<select
    {{ $attributes->merge(['class' => 'w-full bg-gray-800 ' . ($small ? 'p-2 text-sm' : 'p-4') . ' border-purple-700 rounded-md shadow-inner shadow-purple-900/30 focus:border-purple-500 focus:ring focus:ring-purple-500/20 focus:ring-opacity-50 text-purple-100']) }}>
    <option value="">{{ $emptyOption }}</option>
    @foreach ($options as $option)
        <option value="{{ is_object($option) ? $option->{$optionValue} : $option }}">
            {{ is_object($option) ? $option->{$optionLabel} : $option }}
        </option>
    @endforeach
</select>
