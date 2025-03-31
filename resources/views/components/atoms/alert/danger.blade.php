@props(['errors' => [], 'position' => 'top-center'])
<div
    {{ $attributes->merge(['class' => 'p-4 text-red-100 border rounded-lg shadow-lg bg-red-900/50 border-red-800/50']) }}>
    <div class="flex">
        <div class="shrink-0">
            <svg class="w-5 h-5 text-red-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                    clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-bold text-red-100">
                {{ count($errors->all()) > 1 ? 'There were errors with your submission' : 'There was an error with your submission' }}
            </h3>
            <div class="mt-2 text-sm text-red-200">
                <ul role="list" class="pl-5 space-y-1 list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
