import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            boxShadow: {
                'card': '0 0 20px -15px rgba(0, 0, 0, 0.2)',
                'card-blurred': '0 0 15px -10px rgba(0, 0, 0, 0.35)',
            },
            backgroundImage: {
                'site-light': "url('./images/temp-blueprint-bg.jpg)",
                'site-dark': "url('./images/temp-blueprint-bg--dark.jpg)",
            }
        },
    },

    plugins: [forms],
};
