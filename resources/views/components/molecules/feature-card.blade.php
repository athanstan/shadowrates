@props(['title', 'description', 'icon', 'url'])

<div class="bg-slate-800 border-2 border-slate-700 rounded-lg p-6 transition-transform hover:scale-105 shadow-retro">
    <div class="flex items-center justify-center w-12 h-12 rounded-md bg-purple-700 text-white mb-4">
        {!! $icon !!}
    </div>

    <h3 class="text-xl font-bold text-white mb-2 pixel-text">{{ $title }}</h3>

    <p class="text-gray-400 mb-4">{{ $description }}</p>

    <a href="{{ $url }}"
        class="text-blue-400 hover:text-blue-300 font-medium inline-flex items-center transition-colors">
        Get Started
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </a>
</div>
