<div class="max-w-4xl mx-auto text-center">
    <h1
        class="text-5xl font-bold tracking-tight text-transparent sm:text-6xl bg-clip-text bg-gradient-to-r from-purple-400 via-fuchsia-300 to-indigo-400">
        {{ $title ?? 'ShadowShowdown Roadmap' }}</h1>

    <!-- Add pixel art decorative element -->
    <div class="flex justify-center mt-4">
        <div class="w-16 h-1 bg-purple-400"></div>
        <div class="w-2 h-1 bg-transparent"></div>
        <div class="w-8 h-1 bg-fuchsia-400"></div>
        <div class="w-2 h-1 bg-transparent"></div>
        <div class="w-16 h-1 bg-indigo-400"></div>
    </div>

    <p class="mt-6 text-xl text-gray-300">
        {{ $description ?? 'Follow our development journey as we build the ultimate Shadowverse companion app' }}
    </p>

    <!-- Playful status legend -->
    <div class="flex flex-wrap justify-center gap-4 mt-10">
        <span
            class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-400 transition-colors duration-200 rounded-full bg-green-400/10 ring-1 ring-inset ring-green-400/30 hover:bg-green-400/20">
            <span class="w-2 h-2 mr-2 bg-green-400 rounded-full"></span>
            {{ $completedLabel ?? 'Mission Complete!' }}
        </span>
        <span
            class="inline-flex items-center px-3 py-1 text-sm font-medium text-yellow-400 transition-colors duration-200 rounded-full bg-yellow-400/10 ring-1 ring-inset ring-yellow-400/30 hover:bg-yellow-400/20">
            <span class="w-2 h-2 mr-2 bg-yellow-400 rounded-full"></span>
            {{ $inProgressLabel ?? 'Working On It...' }}
        </span>
        <span
            class="inline-flex items-center px-3 py-1 text-sm font-medium text-purple-400 transition-colors duration-200 rounded-full bg-purple-400/10 ring-1 ring-inset ring-purple-400/30 hover:bg-purple-400/20">
            <span class="w-2 h-2 mr-2 bg-purple-400 rounded-full"></span>
            {{ $comingSoonLabel ?? 'On The Horizon' }}
        </span>
    </div>
</div>
