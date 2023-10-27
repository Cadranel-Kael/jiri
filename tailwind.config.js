import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                'primary': '#5754EA',
                'primary-25': '#D5D4FA',
                'black': '#19191D',
                'black-50': '#8C8C8E',
            },
            borderRadius: {
              'DEFAULT': '0.625rem',
            },
            spacing: {
              'col-1': '5.125rem',
              'col-2': '11.4375rem',
            },
            fontFamily: {
                sans: 'Nunito, sans-serif',
            },
        },
    },

    plugins: [forms],
};
