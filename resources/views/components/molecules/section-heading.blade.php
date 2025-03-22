@props(['title', 'subtitle' => null, 'actionText' => null, 'actionUrl' => null])

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 pb-2 border-b-2 border-gray-700">
    <div>
        <h2 class="text-2xl font-bold text-white pixel-text">{{ $title }}</h2>
        @if ($subtitle)
            <p class="mt-1 text-gray-400 text-sm">{{ $subtitle }}</p>
        @endif
    </div>

    @if ($actionText && $actionUrl)
        <a href="{{ $actionUrl }}"
            class="mt-2 sm:mt-0 text-blue-400 hover:text-blue-300 text-sm font-medium flex items-center transition-colors">
            {{ $actionText }}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    @endif
</div>
