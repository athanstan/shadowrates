@props(['deck'])

<div
    {{ $attributes->merge(['class' => 'bg-slate-800 border-2 border-slate-700 rounded-lg overflow-hidden transition-transform hover:scale-105 shadow-retro']) }}>
    <div class="p-4">
        <div class="flex justify-between items-start">
            <h3 class="text-white font-bold text-lg">{{ $deck->name }}</h3>
            <span class="bg-slate-700 text-white px-2 py-1 rounded text-xs">{{ $deck->class }}</span>
        </div>

        <div class="flex items-center mt-2">
            <img src="https://via.placeholder.com/30x30" alt="User Avatar" class="w-6 h-6 rounded-full">
            <span class="text-gray-300 text-sm ml-2">{{ $deck->user->name }}</span>
        </div>

        <p class="text-gray-400 text-sm mt-2 line-clamp-2">
            {{ $deck->description ?: 'No description provided.' }}
        </p>

        <div class="flex items-center justify-between mt-3">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="text-white text-xs ml-1">{{ number_format($deck->average_rating, 1) }}</span>
            </div>
            <div class="text-gray-400 text-xs">
                {{ $deck->cards->count() }} cards
            </div>
        </div>
    </div>
</div>
