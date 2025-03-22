@props(['rating' => 0, 'maxRating' => 5, 'id' => 'rating-' . uniqid(), 'name' => 'rating', 'disabled' => false])

<div x-data="{ rating: {{ $rating }}, hoverRating: 0, maxRating: {{ $maxRating }}, disabled: {{ $disabled ? 'true' : 'false' }} }" class="flex items-center">
    <input type="hidden" name="{{ $name }}" :value="rating" />

    <template x-for="i in maxRating">
        <button type="button" x-on:click="if (!disabled) rating = i" x-on:mouseover="if (!disabled) hoverRating = i"
            x-on:mouseleave="hoverRating = 0" :disabled="disabled"
            :class="{
                'cursor-default': disabled,
                'cursor-pointer': !disabled
            }"
            class="focus:outline-none">
            <svg class="w-5 h-5 transition-colors duration-150"
                :class="{
                    'text-yellow-400': hoverRating >= i || rating >= i,
                    'text-gray-600': hoverRating < i && rating < i
                }"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
        </button>
    </template>

    <span x-show="rating > 0" class="ml-2 text-sm font-medium text-white">
        <span x-text="rating"></span>/<span x-text="maxRating"></span>
    </span>
</div>
