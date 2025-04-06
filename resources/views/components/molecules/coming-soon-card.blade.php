@props(['title', 'description', 'comingSoon' => false])

<div
    class="relative p-6 overflow-hidden bg-gradient-to-b from-neutral-900 to-neutral-950 rounded-3xl transition-all duration-300 hover:shadow-[0_0_15px_rgba(168,85,247,0.4)] group">
    <div
        class="absolute top-0 right-0 w-20 h-20 transition-opacity duration-300 opacity-0 bg-gradient-to-br from-purple-500/20 to-transparent rounded-tr-3xl group-hover:opacity-100">
    </div>
    <div
        class="pointer-events-none absolute left-1/2 top-0 -ml-20 -mt-2 h-full w-full [mask-image:linear-gradient(white,transparent)]">
        <div
            class="absolute inset-0 bg-gradient-to-r [mask-image:radial-gradient(farthest-side_at_top,white,transparent)] from-zinc-900/30 to-zinc-900/30 opacity-100">
            <!-- Grid pattern would go here -->
        </div>
    </div>
    <div class="absolute top-2 right-2">
        @if ($comingSoon)
            <span
                class="inline-flex items-center px-2 py-1 text-xs font-medium text-purple-300 rounded-full bg-purple-500/20">
                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Coming Soon
            </span>
        @endif
    </div>
    <p class="relative z-20 text-base font-bold text-white">{{ $title }}</p>
    <p class="relative z-20 mt-4 text-base font-normal text-neutral-400">{{ $description }}</p>
</div>
