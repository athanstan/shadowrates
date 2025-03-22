@props([
    'title' => 'Ready to elevate your Shadowverse experience?',
    'description' => 'Join thousands of players using ShadowRates to track cards, build decks, and improve their game.',
    'buttonText' => 'Explore Cards',
    'buttonLink' => null,
    'buttonWireNavigate' => true,
])

<!-- CTA section -->
<section class="relative py-20 bg-gradient-to-b from-transparent to-purple-900/20">
    <div class="container px-4 mx-auto text-center">
        <div class="max-w-3xl p-8 mx-auto rounded-lg neo-brutal-panel">
            <h2 class="mb-4 text-2xl font-bold text-purple-200 md:text-3xl">{{ $title }}</h2>
            <p class="mb-6 text-purple-300">{{ $description }}</p>

            @if ($buttonLink)
                <x-atoms.neo-brutal-button href="{{ $buttonLink }}" wire:navigate>
                    {{ $buttonText }}
                </x-atoms.neo-brutal-button>
            @else
                <x-atoms.neo-brutal-button>
                    {{ $buttonText }}
                </x-atoms.neo-brutal-button>
            @endif
        </div>
    </div>
</section>

<style>
    .cyber-button {
        --button-background: rgba(123, 31, 162, 0.5);
        --button-text: white;
        --button-border: rgba(123, 31, 162, 1);
        --button-glow: rgba(123, 31, 162, 0.5);
        background: var(--button-background);
        color: var(--button-text);
        border: 2px solid var(--button-border);
        position: relative;
        transition: all 0.2s ease;
        overflow: hidden;
        font-family: 'Exo 2', sans-serif;
    }

    .cyber-button::before,
    .cyber-button::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border: 2px solid var(--button-border);
    }

    .cyber-button::before {
        top: -8px;
        left: -8px;
        border-right: none;
        border-bottom: none;
    }

    .cyber-button::after {
        bottom: -8px;
        right: -8px;
        border-left: none;
        border-top: none;
    }

    .cyber-button:hover {
        --button-background: rgba(123, 31, 162, 0.7);
        transform: translateY(-2px);
        box-shadow: 0 0 15px var(--button-glow);
    }

    .cyber-button-outline {
        --button-background: transparent;
        --button-text: rgb(203, 213, 225);
        --button-border: rgba(123, 31, 162, 0.7);
        --button-glow: rgba(123, 31, 162, 0.5);
        background: var(--button-background);
        color: var(--button-text);
        border: 2px solid var(--button-border);
        position: relative;
        transition: all 0.2s ease;
        overflow: hidden;
        font-family: 'Exo 2', sans-serif;
    }

    .cyber-button-outline::before,
    .cyber-button-outline::after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        border: 2px solid var(--button-border);
    }

    .cyber-button-outline::before {
        top: -8px;
        left: -8px;
        border-right: none;
        border-bottom: none;
    }

    .cyber-button-outline::after {
        bottom: -8px;
        right: -8px;
        border-left: none;
        border-top: none;
    }

    .cyber-button-outline:hover {
        --button-text: white;
        box-shadow: 0 0 15px var(--button-glow);
        transform: translateY(-2px);
    }

    .text-shadow-glow {
        text-shadow: 0 0 10px rgba(123, 31, 162, 0.7), 0 0 20px rgba(123, 31, 162, 0.4);
    }
</style>
