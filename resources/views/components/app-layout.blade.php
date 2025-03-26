<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShadowRates') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Exo+2:wght@400;500;600;700&family=Press+Start+2P&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .floating-element {
            position: absolute;
            pointer-events: none;
            opacity: 0.6;
            z-index: 0;
            filter: drop-shadow(0 0 8px rgba(147, 51, 234, 0.5));
            will-change: transform;
        }

        .card-shape {
            border-radius: 8px;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.3), rgba(67, 56, 202, 0.2));
            border: 1px solid rgba(147, 51, 234, 0.3);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.3);
        }

        .mana-orb {
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.4) 0%, rgba(67, 56, 202, 0.2) 70%);
            box-shadow: 0 0 10px rgba(139, 92, 246, 0.4);
        }

        .pixel-element {
            image-rendering: pixelated;
        }

        .pixel-star {
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%,
                    79% 91%, 50% 70%, 21% 91%, 32% 57%,
                    2% 35%, 39% 35%);
            background: linear-gradient(135deg, rgba(255, 215, 0, 0.5), rgba(255, 165, 0, 0.3));
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.4);
        }

        .game-icon svg {
            width: 100%;
            height: 100%;
            fill: rgba(147, 51, 234, 0.5);
            filter: drop-shadow(0 0 3px rgba(147, 51, 234, 0.8));
        }

        @keyframes twinkle {

            0%,
            100% {
                opacity: 0.2;
            }

            50% {
                opacity: 0.8;
            }
        }

        .twinkle {
            animation: twinkle 3s ease-in-out infinite;
            animation-delay: calc(var(--delay) * 1s);
        }

        @keyframes glow {

            0%,
            100% {
                filter: drop-shadow(0 0 8px rgba(147, 51, 234, 0.5));
            }

            50% {
                filter: drop-shadow(0 0 15px rgba(147, 51, 234, 0.8));
            }
        }

        .floating-element.hovered {
            animation: glow 1s ease-in-out infinite;
            opacity: 0.9 !important;
            z-index: 10 !important;
            transition: all 0.3s ease;
        }

        .cursor-trail {
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(147, 51, 234, 0.8) 0%, rgba(147, 51, 234, 0) 70%);
            pointer-events: none;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.5s ease;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <!-- Background Animation -->
    <div id="animation-container" class="fixed inset-0 z-0 overflow-hidden pointer-events-none"></div>

    <x-organisms.navbar />
    <!-- Navigation -->
    {{-- <nav class="fixed z-50 w-full bg-gray-900 border-b border-purple-900 bg-opacity-80 backdrop-blur-sm">
        <div class="container px-4 mx-auto">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="/" class="flex items-center">
                        <span class="text-xl font-bold text-purple-400">Shadow<span
                                class="text-indigo-400">Rates</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="flex items-center ml-10 space-x-4">
                        <a href="{{ route('cards.index') }}" wire:navigate
                            class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cards.index') ? 'bg-purple-800 text-white' : 'text-gray-300 hover:bg-purple-700 hover:text-white' }}">
                            Collection
                        </a>
                        <a href="{{ route('decks.create') }}" wire:navigate
                            class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                            Deck Builder
                        </a>
                    </div>
                </div>

                <!-- Login / Profile -->
                <div class="flex items-center">
                    @auth
                        <div class="relative ml-3" x-data="{ open: false }">
                            <div>
                                <button type="button" @click="open = !open" @click.away="open = false"
                                    class="relative flex text-sm cursor-pointer focus:outline-none" id="user-menu-button">
                                    <div class="absolute inset-0 transition-colors rounded-lg shadow-lg bg-gradient-to-br from-purple-500/50 to-indigo-500/50"
                                        :class="open ? 'animate-[pulse_1s_ease-in-out_infinite]' :
                                            'animate-[pulse_3s_ease-in-out_infinite]'">
                                    </div>
                                    <div class="absolute inset-[2px] bg-gray-900 rounded-lg"></div>
                                    <img class="relative object-cover w-10 h-10 p-1 rounded-lg pixel-corners"
                                        src="{{ auth()->user()->avatar }}" alt="{{ auth()->user()->name }}"
                                        style="image-rendering: pixelated;">
                                </button>
                            </div>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-gray-800 rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <a href="{{ route('users.profile', auth()->user()->slug) }}" wire:navigate
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700">Settings</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-left text-gray-300 hover:bg-gray-700">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <x-atoms.google-login-button class="neo-brutal-button pixel-corners">
                            Sign in with Google
                        </x-atoms.google-login-button>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="flex mr-2 md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        id="mobile-menu-button">
                        <span class="sr-only">Open main menu</span>
                        <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state -->
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('cards.index') }}" wire:navigate
                    class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('cards.index') ? 'bg-purple-800 text-white' : 'text-gray-300 hover:bg-purple-700 hover:text-white' }}">
                    Cards
                </a>
                <a href="#" wire:navigate
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                    Decks
                </a>
                <a href="#" wire:navigate
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                    Meta Report
                </a>
                <a href="#" wire:navigate
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-purple-700 hover:text-white">
                    Collection
                </a>
            </div>
        </div>
    </nav> --}}

    <!-- Page Content -->
    <main class="min-h-screen pt-16 pb-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-organisms.footer />

    <!-- Mobile menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Animation setup
            const container = document.getElementById('animation-container');
            const elementCount = 20; // Increased count
            const shapes = ['card-shape', 'mana-orb', 'pixel-star', 'game-icon'];
            const sizes = ['w-8 h-12', 'w-10 h-14', 'w-6 h-6', 'w-8 h-8', 'w-5 h-5', 'w-4 h-4'];
            const containerRect = container.getBoundingClientRect();

            // Game icons SVG paths
            const gameIcons = [
                '<svg viewBox="0 0 24 24"><path d="M21,6H3C1.9,6,1,6.9,1,8v8c0,1.1,0.9,2,2,2h18c1.1,0,2-0.9,2-2V8C23,6.9,22.1,6,21,6z M11,13H8v3H6v-3H3v-2h3V8h2v3h3V13z M15.5,15 c-0.83,0-1.5-0.67-1.5-1.5c0-0.83,0.67-1.5,1.5-1.5c0.83,0,1.5,0.67,1.5,1.5C17,14.33,16.33,15,15.5,15z M19.5,12c-0.83,0-1.5-0.67-1.5-1.5 c0-0.83,0.67-1.5,1.5-1.5c0.83,0,1.5,0.67,1.5,1.5C21,11.33,20.33,12,19.5,12z"/></svg>',
                '<svg viewBox="0 0 24 24"><path d="M11.99,2C6.47,2,2,6.48,2,12s4.47,10,9.99,10C17.52,22,22,17.52,22,12S17.52,2,11.99,2z M15.29,16.71L11,12.41V7h2v4.59l3.71,3.71L15.29,16.71z"/></svg>',
                '<svg viewBox="0 0 24 24"><path d="M7 6H17V8H7zM7 11H17V13H7zM7 16H17V18H7z"/></svg>',
                '<svg viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM12 3v3.05c3.39.49 6 3.39 6 6.95 0 3.56-2.61 6.47-6 6.95V23h-2v-3.05c-3.39-.49-6-3.39-6-6.95 0-3.56 2.61-6.47 6-6.95V3h2z"/></svg>'
            ];

            // Add background stars (static)
            for (let i = 0; i < 30; i++) {
                const star = document.createElement('div');
                star.classList.add('twinkle');
                star.style.position = 'absolute';
                star.style.width = '2px';
                star.style.height = '2px';
                star.style.backgroundColor = 'rgba(255, 255, 255, 0.7)';
                star.style.borderRadius = '50%';
                star.style.left = `${Math.random() * 100}%`;
                star.style.top = `${Math.random() * 100}%`;
                star.style.setProperty('--delay', Math.random() * 5);
                container.appendChild(star);
            }

            // Create floating elements
            for (let i = 0; i < elementCount; i++) {
                createFloatingElement();
            }

            // Mouse interaction setup
            let mouseX = 0;
            let mouseY = 0;
            let isMouseMoving = false;
            let mouseMovementTimeout;

            // Create cursor trail container
            const trailContainer = document.createElement('div');
            trailContainer.classList.add('cursor-trail-container');
            trailContainer.style.position = 'fixed';
            trailContainer.style.top = '0';
            trailContainer.style.left = '0';
            trailContainer.style.width = '100%';
            trailContainer.style.height = '100%';
            trailContainer.style.pointerEvents = 'none';
            trailContainer.style.zIndex = '9999';
            document.body.appendChild(trailContainer);

            // Create cursor trails
            const trails = [];
            const trailCount = 8;

            for (let i = 0; i < trailCount; i++) {
                const trail = document.createElement('div');
                trail.classList.add('cursor-trail');
                trail.style.opacity = 0;
                trailContainer.appendChild(trail);
                trails.push({
                    element: trail,
                    x: 0,
                    y: 0,
                    delay: i * 2
                });
            }

            // Mouse move event
            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
                isMouseMoving = true;

                // Make trail visible when mouse is moving
                trails.forEach(trail => {
                    trail.element.style.opacity = 0.7;
                });

                // Clear existing timeout and set a new one
                clearTimeout(mouseMovementTimeout);
                mouseMovementTimeout = setTimeout(() => {
                    isMouseMoving = false;

                    // Fade out trails when mouse stops
                    trails.forEach(trail => {
                        trail.element.style.opacity = 0;
                    });
                }, 100);

                // Repel or attract floating elements on mouse move
                const elements = document.querySelectorAll('.floating-element');
                elements.forEach(element => {
                    const rect = element.getBoundingClientRect();
                    const elementCenterX = rect.left + rect.width / 2;
                    const elementCenterY = rect.top + rect.height / 2;

                    // Calculate distance from mouse to element
                    const distanceX = mouseX - elementCenterX;
                    const distanceY = mouseY - elementCenterY;
                    const distance = Math.sqrt(distanceX * distanceX + distanceY * distanceY);

                    // Only affect elements within a certain radius
                    if (distance < 150) {
                        // Calculate repulsion force (inverse to distance)
                        const force = 0.5 * (1 - distance / 150);

                        // Add temporary speed based on repulsion
                        const x = parseFloat(element.dataset.x);
                        const y = parseFloat(element.dataset.y);

                        // Repel effect
                        element.dataset.x = x - distanceX * force * 0.05;
                        element.dataset.y = y - distanceY * force * 0.05;

                        // Add hovering effect
                        if (distance < 50) {
                            element.classList.add('hovered');
                            element.style.opacity = 0.9;
                        } else {
                            element.classList.remove('hovered');
                            element.style.opacity = 0.6;
                        }

                        updateElementPosition(element);
                    } else {
                        element.classList.remove('hovered');
                        element.style.opacity = 0.6;
                    }
                });
            });

            function createFloatingElement() {
                const element = document.createElement('div');
                const shapeIndex = Math.floor(Math.random() * shapes.length);
                const shapeClass = shapes[shapeIndex];
                const sizeClass = sizes[Math.floor(Math.random() * sizes.length)];

                element.classList.add('floating-element', shapeClass);
                element.classList.add(sizeClass);

                // Random starting position
                const x = Math.random() * containerRect.width;
                const y = Math.random() * containerRect.height;

                // Random movement parameters
                const speedX = (Math.random() - 0.5) * 0.5; // px per frame
                const speedY = (Math.random() - 0.5) * 0.5;
                const rotationSpeed = (Math.random() - 0.5) * 0.5;
                const pulseSpeed = 1 + Math.random() * 2;

                // Store movement data with the element
                element.dataset.x = x;
                element.dataset.y = y;
                element.dataset.rotation = Math.random() * 360;
                element.dataset.speedX = speedX;
                element.dataset.speedY = speedY;
                element.dataset.rotationSpeed = rotationSpeed;
                element.dataset.pulseSpeed = pulseSpeed;
                element.dataset.pulseDirection = 1;
                element.dataset.scale = 0.8 + Math.random() * 0.4;

                // Add game icon SVG if it's a game-icon element
                if (shapeClass === 'game-icon') {
                    const iconIndex = Math.floor(Math.random() * gameIcons.length);
                    element.innerHTML = gameIcons[iconIndex];
                }
                // Add pixel art for some elements
                else if (Math.random() > 0.7 && shapeClass !== 'pixel-star') {
                    const pixelArt = document.createElement('div');
                    pixelArt.classList.add('pixel-element');
                    pixelArt.style.width = '100%';
                    pixelArt.style.height = '100%';

                    // Create a simple pixel pattern for special elements
                    if (shapeClass === 'card-shape') {
                        pixelArt.style.background =
                            'linear-gradient(45deg, #9333ea22 25%, transparent 25%, transparent 75%, #9333ea22 75%), linear-gradient(45deg, #9333ea22 25%, transparent 25%, transparent 75%, #9333ea22 75%)';
                        pixelArt.style.backgroundSize = '8px 8px';
                        pixelArt.style.backgroundPosition = '0 0, 4px 4px';
                    } else {
                        pixelArt.style.background =
                            'radial-gradient(circle, rgba(139, 92, 246, 0.4) 30%, transparent 70%)';
                    }

                    element.appendChild(pixelArt);
                }

                // Set initial position
                updateElementPosition(element);

                // Add to container
                container.appendChild(element);
            }

            function updateElementPosition(element) {
                const x = parseFloat(element.dataset.x);
                const y = parseFloat(element.dataset.y);
                const rotation = parseFloat(element.dataset.rotation);
                const scale = parseFloat(element.dataset.scale);

                element.style.transform = `translate(${x}px, ${y}px) rotate(${rotation}deg) scale(${scale})`;
            }

            // Animation loop
            function animate() {
                const elements = document.querySelectorAll('.floating-element');

                // Update floating elements
                elements.forEach(element => {
                    // Update position
                    let x = parseFloat(element.dataset.x);
                    let y = parseFloat(element.dataset.y);
                    let rotation = parseFloat(element.dataset.rotation);
                    let scale = parseFloat(element.dataset.scale);
                    let pulseDirection = parseInt(element.dataset.pulseDirection);

                    const speedX = parseFloat(element.dataset.speedX);
                    const speedY = parseFloat(element.dataset.speedY);
                    const rotationSpeed = parseFloat(element.dataset.rotationSpeed);
                    const pulseSpeed = parseFloat(element.dataset.pulseSpeed) / 100;

                    x += speedX;
                    y += speedY;
                    rotation += rotationSpeed;

                    // Subtle scale pulsing effect
                    scale += pulseSpeed * pulseDirection;
                    if (scale > 1.1) {
                        pulseDirection = -1;
                    } else if (scale < 0.9) {
                        pulseDirection = 1;
                    }

                    // Boundaries check with wrapping
                    if (x < -50) x = containerRect.width + 50;
                    if (x > containerRect.width + 50) x = -50;
                    if (y < -50) y = containerRect.height + 50;
                    if (y > containerRect.height + 50) y = -50;

                    // Update element data
                    element.dataset.x = x;
                    element.dataset.y = y;
                    element.dataset.rotation = rotation;
                    element.dataset.scale = scale;
                    element.dataset.pulseDirection = pulseDirection;

                    // Apply new position
                    updateElementPosition(element);
                });

                // Update cursor trails with delay
                if (trails.length > 0) {
                    for (let i = 0; i < trails.length; i++) {
                        const trail = trails[i];

                        // Update trail position with delay
                        setTimeout(() => {
                            trail.x = mouseX;
                            trail.y = mouseY;
                            trail.element.style.transform = `translate(${trail.x}px, ${trail.y}px)`;
                        }, trail.delay);
                    }
                }

                requestAnimationFrame(animate);
            }

            // Start animation
            animate();

            // Adjust on window resize
            window.addEventListener('resize', function() {
                const newRect = container.getBoundingClientRect();
                containerRect.width = newRect.width;
                containerRect.height = newRect.height;
            });

            // Add click effect
            document.addEventListener('click', function(e) {
                // Create a burst effect
                createBurstEffect(e.clientX, e.clientY);
            });

            function createBurstEffect(x, y) {
                const burstCount = 8;
                const burstContainer = document.createElement('div');
                burstContainer.style.position = 'fixed';
                burstContainer.style.left = `${x}px`;
                burstContainer.style.top = `${y}px`;
                burstContainer.style.pointerEvents = 'none';
                burstContainer.style.zIndex = '9999';
                document.body.appendChild(burstContainer);

                // Create burst particles
                for (let i = 0; i < burstCount; i++) {
                    const particle = document.createElement('div');
                    particle.style.position = 'absolute';
                    particle.style.width = '8px';
                    particle.style.height = '8px';
                    particle.style.backgroundColor = 'rgba(147, 51, 234, 0.8)';
                    particle.style.borderRadius = '50%';
                    particle.style.transform = 'translate(-50%, -50%)';

                    // Random direction
                    const angle = (i / burstCount) * Math.PI * 2;
                    const speed = 2 + Math.random() * 3;
                    const vx = Math.cos(angle) * speed;
                    const vy = Math.sin(angle) * speed;

                    burstContainer.appendChild(particle);

                    // Animate particle
                    let step = 0;
                    const animate = () => {
                        step++;

                        // Move outward
                        const x = vx * step;
                        const y = vy * step;

                        // Fade out
                        const opacity = 1 - step / 20;

                        if (opacity <= 0) {
                            particle.remove();
                            if (burstContainer.children.length === 0) {
                                burstContainer.remove();
                            }
                            return;
                        }

                        particle.style.transform = `translate(calc(${x}px - 50%), calc(${y}px - 50%))`;
                        particle.style.opacity = opacity;

                        requestAnimationFrame(animate);
                    };

                    animate();
                }
            }
        });
    </script>

</body>

</html>
