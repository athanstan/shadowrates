@props([
    'title' => 'Have a Feature Request?',
    'description' => 'We love hearing from our community! Got a cool idea for ShadowShowdown? Let us know!',
    'buttonText' => 'Submit Your Idea',
    'buttonUrl' => '#',
])

<div class="max-w-4xl py-16 mx-auto border-t border-indigo-500/30">
    <div class="text-center">
        <h2 class="text-3xl font-bold text-white">{{ $title }}</h2>

        <!-- Pixel art decorative element -->
        <div class="flex justify-center mt-4">
            <div class="w-8 h-1 bg-indigo-400"></div>
            <div class="w-2 h-1 bg-transparent"></div>
            <div class="w-4 h-1 bg-purple-400"></div>
            <div class="w-2 h-1 bg-transparent"></div>
            <div class="w-8 h-1 bg-indigo-400"></div>
        </div>

        <p class="mt-6 text-gray-300">
            {{ $description }}
        </p>

        <div class="mt-10">
            <a href="{{ $buttonUrl }}"
                class="inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-white transition-all duration-200 transform rounded-md group shadow-glow-md bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 hover:scale-105">
                <span class="mr-2">🌟</span>
                <span>{{ $buttonText }}</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 ml-2 transition-transform duration-200 group-hover:translate-x-1" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        <!-- Playful note -->
        <p class="mt-8 text-sm text-indigo-300">
            <span class="inline-block animate-bounce">⬇️</span> Your idea could be the next feature on our
            roadmap! <span class="inline-block animate-bounce">⬇️</span>
        </p>
    </div>
</div>
