<article
    class="grid max-w-2xl grid-cols-1 overflow-hidden transition-shadow duration-300 border shadow-lg rounded-2xl group rounded-radius md:grid-cols-8 border-outline backdrop-blur-md bg-surface-alt/80 text-on-surface dark:border-outline-dark dark:bg-surface-dark-alt/80 dark:text-on-surface-dark hover:shadow-xl backdrop-filter backdrop-blur-sm bg-white/10 dark:bg-black/10">
    <!-- image -->
    <div class="relative col-span-3 overflow-hidden">
        <img src="{{ $leader->getImage() }}"
            class="object-cover w-full transition duration-700 ease-out h-52 md:h-full group-hover:scale-105"
            alt="{{ $leader->name }}" />
        <div
            class="absolute bottom-0 right-0 px-2 py-1 m-2 text-xs font-bold text-white rounded-md bg-black/70 backdrop-filter backdrop-blur-sm">
            LEADER
        </div>
    </div>
    <!-- body -->
    <div class="flex flex-col justify-center col-span-5 p-6 backdrop-blur-sm bg-white/5 dark:bg-black/5">

        <div class="flex items-center justify-between mb-4">
            <span
                class="px-3 py-1 text-sm font-medium text-white rounded-full bg-purple-600/80 backdrop-filter backdrop-blur-sm">{{ $craft }}</span>
            <div class="flex items-center w-1/2 space-x-1.5">
                <div
                    class="w-full bg-gray-200/80 rounded-full h-2.5 dark:bg-gray-700/80 backdrop-filter backdrop-blur-sm">
                    <div class="bg-gradient-to-r from-purple-600 to-indigo-500 h-2.5 rounded-full"
                        style="width: {{ ($count / 50) * 100 }}%"></div>
                </div>
                <span class="text-xs font-medium text-blue-100">{{ $count }}/50</span>
            </div>
        </div>
        <h3 class="text-xl font-bold text-balance text-on-surface-strong lg:text-2xl dark:text-on-surface-dark-strong"
            aria-describedby="articleDescription">{{ $title }}</h3>
        <p id="articleDescription" class="max-w-lg my-4 text-sm text-pretty">
            {{ $description }}
        </p>
        <div class="flex items-center justify-between mt-auto">
            <a href="{{ $deckUrl }}" wire:navigate
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-md bg-primary/90 hover:bg-primary dark:bg-primary-dark/90 dark:hover:bg-primary-dark backdrop-filter backdrop-blur-sm">
                View Deck
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none"
                    stroke-width="2.5" aria-hidden="true" class="inline ml-2 size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
            <span class="text-xs text-gray-500 dark:text-gray-400">Last updated:
            </span>
        </div>
    </div>
</article>
