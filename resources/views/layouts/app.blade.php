<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ShadowShowdown') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Exo+2:wght@400;500;600;700&family=Press+Start+2P&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Background Animation -->
    <div id="animation-container" class="fixed inset-0 z-0 overflow-hidden pointer-events-none"></div>

    <x-organisms.navbar />

    <!-- Page Content -->
    <main>
        @auth
            <!-- Alert Components -->
            <x-atoms.success-alert position="top-center" />
            <x-atoms.error-alert position="top-center" />

        @endauth

        {{ $slot }}
    </main>

    <!-- Footer -->
    <x-organisms.footer />

    @livewireScripts

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

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
        });
    </script>

</body>

</html>
