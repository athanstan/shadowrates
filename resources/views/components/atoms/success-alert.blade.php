@props([
    'id' => 'success-alert',
    'position' => 'top-right',
    'duration' => 3000,
])

<div x-data="{
    show: false,
    message: '',
    timer: null,
    init() {
        window.addEventListener('show-success', event => {
            this.message = event.detail.message;
            this.showAlert();
        });
    },
    showAlert() {
        this.show = true;
        clearTimeout(this.timer);
        this.timer = setTimeout(() => {
            this.show = false;
        }, {{ $duration }});
    }
}" id="{{ $id }}" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90" @class([
        'fixed z-50 flex items-center p-4 rounded-lg shadow-lg bg-gray-900 border border-violet-500',
        'top-4 right-4' => $position === 'top-right',
        'top-4 left-4' => $position === 'top-left',
        'bottom-4 right-4' => $position === 'bottom-right',
        'bottom-4 left-4' => $position === 'bottom-left',
        'top-4 left-1/2 transform -translate-x-1/2' => $position === 'top-center',
        'bottom-4 left-1/2 transform -translate-x-1/2' =>
            $position === 'bottom-center',
    ]) style="display: none">
    <div class="flex items-center">
        <div class="flex-shrink-0 p-1 mr-3 rounded-full bg-gradient-to-b from-violet-500 to-violet-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div>
            <p class="font-medium text-white" x-text="message">Success message here</p>
        </div>
    </div>
    <button @click="show = false" class="ml-4 text-gray-400 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>
</div>
