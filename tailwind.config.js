import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // Enabling class-based dark mode

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Example colors for dark mode
                'dark-bg': '#1a202c', // Dark background color
                'dark-text': '#e2e8f0', // Light text color for dark mode
                'primary-dark': '#4f46e5', // Dark mode primary color
            },
        },
    },

    plugins: [forms],
};
