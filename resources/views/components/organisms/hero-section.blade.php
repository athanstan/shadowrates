@props([
    'title' => 'Rate, Share, and Build Shadowverse Decks',
    'subtitle' => 'Join the community to rate cards, discover top decks, and build your own strategies.',
])

<div class="relative py-20 overflow-hidden" x-data="{ cardHover: false }">
    <!-- Animated background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[#0a0a1a]"></div>
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Ccircle cx=\'50\' cy=\'50\' r=\'1\' fill=\'%23ffffff\' fill-opacity=\'0.1\'/%3E%3C/svg%3E')] opacity-60">
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900/40 via-transparent to-blue-900/30"></div>

        <!-- Floating particles -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -inset-[10%] particle-container">
                @for ($i = 0; $i < 12; $i++)
                    <div class="particle particle-{{ $i }} opacity-20 absolute rounded-full bg-purple-400">
                    </div>
                @endfor
            </div>
        </div>

        <!-- Diagonal ornaments -->
        <div class="absolute inset-y-0 left-0 w-32 overflow-hidden opacity-20">
            <div class="absolute h-full w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent left-8">
            </div>
            <div class="absolute h-full w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent left-20">
            </div>
        </div>
        <div class="absolute inset-y-0 right-0 w-32 overflow-hidden opacity-20">
            <div class="absolute h-full w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent right-8">
            </div>
            <div class="absolute h-full w-px bg-gradient-to-b from-transparent via-purple-500 to-transparent right-20">
            </div>
        </div>
    </div>

    <div class="container relative mx-auto px-4 z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <!-- Left Content - Text -->
            <div class="md:w-1/2 text-center md:text-left">
                <div
                    class="mb-4 inline-flex items-center px-4 py-1 glass-effect rounded-full border border-purple-500/30 text-purple-200 text-sm">
                    <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse mr-2"></span>
                    The Ultimate Shadowverse Companion
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    <span
                        class="bg-gradient-to-r from-purple-300 via-indigo-300 to-blue-300 bg-clip-text text-transparent">RATE,
                        BUILD, DOMINATE</span>
                </h1>
                <h2 class="text-2xl md:text-3xl font-bold text-purple-200 mb-6">Your Shadowverse Journey</h2>

                <p class="text-xl text-purple-200 mb-8 max-w-lg">
                    Discover top-rated cards, craft winning decks,
                    and connect with the community to elevate your gameplay.
                </p>

                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                    <x-atoms.google-login-button size="lg" class="neo-brutal-button pixel-corners">
                        Sign in with Google
                    </x-atoms.google-login-button>
                    <a href="#features"
                        class="pixel-corners inline-block rounded-lg border-2 border-purple-500 bg-transparent px-8 py-3 text-base font-bold text-purple-300 transition-colors hover:bg-purple-900/30">
                        EXPLORE FEATURES
                    </a>
                </div>
            </div>

            <!-- Right Content - Card Example -->
            <div class="md:w-1/2 mt-8 md:mt-0">
                <div @mouseenter="cardHover = true" @mouseleave="cardHover = false"
                    class="neo-brutal-panel space-card rounded-xl p-5 max-w-md mx-auto shadow-2xl transform transition-all duration-300 hover:scale-105"
                    :class="{ 'glow-effect': cardHover }">

                    <!-- Card header with custom frame -->
                    <div class="relative pixel-corners overflow-hidden">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-purple-400 rounded-lg opacity-75 blur">
                        </div>
                        <div class="relative flex justify-between items-start p-3 bg-gray-900 rounded-lg mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-white">Fairy Dragon</h3>
                                <p class="text-purple-400">Legendary • Forestcraft</p>
                            </div>
                            <div
                                class="bg-gradient-to-r from-green-600 to-green-700 text-white px-2 py-1 rounded text-sm font-bold">
                                4.8/5
                            </div>
                        </div>
                    </div>

                    <div
                        class="pixel-corners rounded-lg bg-gray-800 h-48 mb-4 flex items-center justify-center overflow-hidden relative">
                        <!-- Card glow effect on hover -->
                        <div class="absolute inset-0 bg-purple-500/10 opacity-0 transition-opacity duration-300"
                            :class="{ 'opacity-100': cardHover }"></div>

                        <div class="text-center text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Card Image
                        </div>
                    </div>

                    <div class="flex justify-between mb-2">
                        <div class="flex space-x-2">
                            <span
                                class="px-2 py-1 glass-effect border border-blue-700/30 rounded-lg text-xs">Meta</span>
                            <span
                                class="px-2 py-1 glass-effect border border-green-700/30 rounded-lg text-xs">Aggro</span>
                        </div>
                        <div class="text-purple-200 text-sm font-mono">
                            2 pp • 1/2
                        </div>
                    </div>

                    <p class="text-purple-300 text-sm">
                        Perfect for accelerating your early game. Strong synergy with fairy producers.
                    </p>

                    <!-- Card footer with rating stars -->
                    <div class="mt-4 flex items-center justify-between">
                        <div class="flex space-x-1">
                            @for ($i = 0; $i < 5; $i++)
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 @if ($i < 4) star-glow text-yellow-300 @else text-gray-600 @endif"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="text-xs text-purple-400">243 ratings</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .particle-container {
        animation: rotate 120s linear infinite;
    }

    .particle {
        width: 20px;
        height: 20px;
        filter: blur(8px);
    }

    .particle-0 {
        top: 20%;
        left: 10%;
        animation: float 25s ease-in-out infinite;
    }

    .particle-1 {
        top: 60%;
        left: 80%;
        animation: float 28s ease-in-out infinite;
    }

    .particle-2 {
        top: 40%;
        left: 30%;
        animation: float 30s ease-in-out infinite;
    }

    .particle-3 {
        top: 70%;
        left: 60%;
        animation: float 22s ease-in-out infinite;
    }

    .particle-4 {
        top: 30%;
        left: 85%;
        animation: float 26s ease-in-out infinite;
    }

    .particle-5 {
        top: 80%;
        left: 20%;
        animation: float 31s ease-in-out infinite;
    }

    .particle-6 {
        top: 15%;
        left: 60%;
        animation: float 24s ease-in-out infinite;
    }

    .particle-7 {
        top: 50%;
        left: 40%;
        animation: float 29s ease-in-out infinite;
    }

    .particle-8 {
        top: 25%;
        left: 70%;
        animation: float 33s ease-in-out infinite;
    }

    .particle-9 {
        top: 75%;
        left: 25%;
        animation: float 27s ease-in-out infinite;
    }

    .particle-10 {
        top: 85%;
        left: 85%;
        animation: float 32s ease-in-out infinite;
    }

    .particle-11 {
        top: 10%;
        left: 45%;
        animation: float 23s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0) translateX(0);
        }

        25% {
            transform: translateY(-30px) translateX(20px);
        }

        50% {
            transform: translateY(20px) translateX(-20px);
        }

        75% {
            transform: translateY(30px) translateX(25px);
        }
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>
