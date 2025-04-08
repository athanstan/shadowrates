const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
        './resources/css/**/*.css',
    ],

    theme: {
        extend: {
            colors: {
                'brand-primary': '#8a2be2',      // primary brand color
                'brand-primary-dark': '#4a0080', // darker shade of primary
                'brand-secondary': '#3b6fba',    // secondary brand color
                'brand-secondary-dark': '#1a4a8f', // darker shade of secondary
                craft: {
                    forest: '#4b7f52',    // forestcraft
                    sword: '#3b6fba',     // swordcraft
                    rune: '#a35bae',      // runecraft
                    dragon: '#c1432e',    // dragoncraft
                    shadow: '#53565a',    // shadowcraft
                    blood: '#8e262d',     // bloodcraft
                    haven: '#d9a93e',     // havencraft
                    portal: '#7e57c2',    // portalcraft
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'bubble-1': 'bubble 7s ease-in-out infinite',
                'bubble-2': 'bubble 5s ease-in-out 1s infinite',
                'bubble-3': 'bubble 6s ease-in-out 2s infinite',
                'ping-slow': 'ping 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            },
            keyframes: {
                bubble: {
                    '0%': { transform: 'translateY(100%)', opacity: '0' },
                    '50%': { transform: 'translateY(0)', opacity: '0.7' },
                    '100%': { transform: 'translateY(-150%)', opacity: '0' },
                },
                rise: {
                    '0%': { transform: 'translateY(100%)', opacity: '0' },
                    '50%': { transform: 'translateY(0)', opacity: '0.7' },
                    '100%': { transform: 'translateY(-100%)', opacity: '0' },
                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],

    // Support both named colors and arbitrary color values
    safelist: [
        // Pre-generate classes for all craft colors with various opacities
        'bg-craft-forest', 'bg-craft-sword', 'bg-craft-rune', 'bg-craft-dragon',
        'bg-craft-shadow', 'bg-craft-blood', 'bg-craft-haven', 'bg-craft-portal',
        'text-craft-forest', 'text-craft-sword', 'text-craft-rune', 'text-craft-dragon',
        'text-craft-shadow', 'text-craft-blood', 'text-craft-haven', 'text-craft-portal',
        'border-craft-forest', 'border-craft-sword', 'border-craft-rune', 'border-craft-dragon',
        'border-craft-shadow', 'border-craft-blood', 'border-craft-haven', 'border-craft-portal',
        // Animations
        'animate-pulse-slow', 'animate-bubble-1', 'animate-bubble-2', 'animate-bubble-3',
        'animate-ping-slow', 'delay-700', 'delay-1000', 'delay-1500',
        // Brand color gradients
        'from-brand-primary', 'to-brand-primary-dark',
        'from-brand-secondary', 'to-brand-secondary-dark',
        'bg-gradient-to-br',
        // Allow arbitrary color values
        {
            pattern: /bg-\[#([0-9a-fA-F]{6})\]/,
            variants: ['hover'],
        },
    ],
};
