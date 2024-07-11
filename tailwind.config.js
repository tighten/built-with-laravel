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
            colors: {
                bgrey: {
                    '040': '#f5f5f5',
                    100: '#e5e5e5',
                    200: '#cccccc',
                    400: '#999999',
                    500: '#808080',
                    700: '#4c4c4c',
                    800: '#313131',
                },
                tighten: {
                    'yellow': '#ffbc00'
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                mono: ['"Pitch Sans"', ...defaultTheme.fontFamily.mono],
            },
            maxWidth: {
                '8xl': '88rem',
            },
            opacity: {
                4: '.04',
                8: '.08',
                13: '.13',
                75: '.75',
            },
            scale: {
                '115': '1.15',
            },
            width: {
                '128': '32rem',
                '144': '36rem',
            }
        },
    },

    plugins: [forms],
};
