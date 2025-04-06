<div class="relative min-h-screen py-16">
    <!-- Background elements -->
    <x-roadmap.background />

    <div class="relative px-6 mx-auto max-w-7xl lg:px-8">
        <!-- Roadmap content -->
        {{ $slot }}
    </div>
</div>

@push('styles')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0.3;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out;
            opacity: 1;
        }

        /* Blob animation */
        @keyframes blob {
            0% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0, 0) scale(1);
            }
        }

        .animate-blob-slow {
            animation: blob 25s infinite alternate;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }

        /* Stagger animations for a more pleasant flow */
        .card-glow:nth-child(1) {
            animation-delay: 0.1s;
        }

        .card-glow:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card-glow {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.2);
            transition: all 0.3s ease;
        }

        .card-glow:hover {
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.3);
            transform: translateY(-2px);
        }

        .shadow-glow-sm {
            box-shadow: 0 0 10px rgba(79, 70, 229, 0.2);
        }

        .shadow-glow-md {
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.3);
        }

        .animation-delay-1000 {
            animation-delay: 1s;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-3000 {
            animation-delay: 3s;
        }

        @keyframes pulseSlow {
            0% {
                opacity: 0.5;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 0.5;
            }
        }

        .animate-pulse-slow {
            animation: pulseSlow 8s infinite;
        }

        /* Matrix rain effect styling */
        .matrix-rain {
            position: relative;
            overflow: hidden;
        }

        /* Enhance hover effects */
        .card-glow li:hover span:last-child {
            color: white;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.4);
        }

        /* Add playful hover effects */
        @keyframes bounceIcon {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .card-glow li:hover span:first-child {
            animation: bounceIcon 0.6s ease;
        }

        @keyframes popIn {
            from {
                opacity: 0.7;
                transform: scale(0.97);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-pop-in {
            animation: popIn 0.4s ease-out forwards;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            // Matrix rain effect - simplified version
            Alpine.data('matrixRain', () => ({
                init() {
                    // Simple version without complex animations
                }
            }));
        });

        // Simple scroll animation observer
        document.addEventListener('DOMContentLoaded', () => {
            const animateOnScroll = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-pop-in');
                        observer.unobserve(entry.target);
                    }
                });
            };

            const observer = new IntersectionObserver(animateOnScroll, {
                root: null,
                threshold: 0.1,
                rootMargin: '0px'
            });

            // Observe all feature cards
            document.querySelectorAll('.card-glow').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
@endpush
