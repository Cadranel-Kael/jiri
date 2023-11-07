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
            borderWidth: {
                '2': '2px',
            },
            colors: {
                'primary': '#5754EA',
                'primary-25': '#D5D4FA',
                'primary-10': '#EEEEFD',
                'black': '#19191D',
                'black-50': '#8C8C8E',
                'black-5': '#F3F4F4',
                'warning': '#C5283D',
            },
            borderRadius: {
                'DEFAULT': '0.625rem',
            },
            spacing: {
                'col-1': '5.125rem',
                'col-2': '11.4375rem',
                'col-2-sm': '7.75',
            },
            minWidth: {
                'col-1': '5.125rem',
                'col-2': '11.4375rem',
                'col-2-sm': '9.1rem',
            },
            fontSize: {
                'logo': '40',
                'h1': '2.36875rem',
                'h2': '1.775rem',
                'h2-sm': '1rem',
            },
            fontFamily: {
                sans: 'Nunito, sans-serif',
            },
        },
    },

    plugins: [forms],
};
