<div class="absolute inset-0 overflow-hidden -z-10">
    <!-- Moving blob gradients -->
    <div
        class="absolute w-[40rem] h-[40rem] -top-20 -left-20 bg-gradient-to-br from-purple-900/30 to-transparent rounded-full blur-3xl animate-blob-slow">
    </div>
    <div
        class="absolute w-[35rem] h-[35rem] top-1/2 right-0 bg-gradient-to-bl from-indigo-900/30 to-blue-900/20 rounded-full blur-3xl animate-blob-slow animation-delay-2000">
    </div>
    <div
        class="absolute w-[30rem] h-[30rem] bottom-0 left-1/4 bg-gradient-to-tr from-fuchsia-900/30 to-transparent rounded-full blur-3xl animate-blob-slow animation-delay-4000">
    </div>

    <!-- Static gradient elements -->
    <div
        class="absolute transform -translate-x-1/2 -translate-y-1/2 rounded-full top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-purple-800/20 to-indigo-800/20 blur-3xl animate-pulse-slow">
    </div>
    <div
        class="absolute w-64 h-64 rounded-full bottom-1/3 right-1/4 bg-gradient-to-r from-fuchsia-800/20 to-blue-800/20 blur-3xl animate-pulse-slow animation-delay-2000">
    </div>

    <!-- Grid pattern overlay -->
    <svg class="absolute inset-0 -z-10 size-full stroke-white/10 [mask-image:radial-gradient(100%_100%_at_top_right,white,transparent)]"
        aria-hidden="true">
        <defs>
            <pattern id="grid-pattern" width="100" height="100" x="50%" y="-1" patternUnits="userSpaceOnUse">
                <path d="M.5 100V.5H100" fill="none" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" stroke-width="0" fill="url(#grid-pattern)" />
    </svg>

    <!-- Code matrix rain effect in the background -->
    <div class="absolute inset-0 opacity-10">
        <div x-data="{ characters: '01' }" class="w-full h-full matrix-rain"></div>
    </div>
</div>
