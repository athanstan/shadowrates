@props(['number', 'title', 'description'])

<div class="p-4 rounded-lg glass-effect">
    <div class="flex items-center mb-2">
        <div
            class="flex items-center justify-center w-8 h-8 mr-3 bg-purple-600 rounded-full shadow-lg shadow-purple-600/30">
            {{ $number }}
        </div>
        <h4 class="font-bold text-purple-200">{{ $title }}</h4>
    </div>
    <p class="text-sm text-purple-300">{{ $description }}</p>
</div>
