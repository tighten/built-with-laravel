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
                    400: '#999999',
                    500: '#808080',
                    800: '#313131',
                },
                tighten: {
                    'yellow': '#ffbc00'
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                '8xl': '88rem',
            },
            opacity: {
                4: '.04',
                13: '.13',
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
