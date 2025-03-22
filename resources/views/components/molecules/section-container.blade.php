@props([
    'title' => 'Section Title',
    'description' => 'Section description text goes here.',
    'titleFrom' => 'blue-400',
    'titleVia' => 'purple-500',
    'titleTo' => 'purple-400',
    'bgGradient' => 'from-transparent to-purple-900/10',
    'padding' => 'py-16',
])

<section class="relative {{ $padding }} bg-gradient-to-b {{ $bgGradient }}">
    <div class="container px-4 mx-auto">
        <div class="mb-8 text-center">
            <x-atoms.section-title :from="$titleFrom" :via="$titleVia" :to="$titleTo">
                {{ $title }}
            </x-atoms.section-title>
            <p class="max-w-2xl mx-auto mt-4 text-purple-200">{{ $description }}</p>
        </div>

        {{ $slot }}
    </div>
</section>
