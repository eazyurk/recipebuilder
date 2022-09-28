const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // https://javisperez.github.io/tailwindcolorshades/?cardinal=dc3545&california=ff9800&christi=499b00&candy-corn=fbe24c&st-tropaz=00539b
                primary: {
                    '50': '#faf5ff',
                    '100': '#f3e8ff',
                    '200': '#e9d5ff',
                    '300': '#d8b4fe',
                    '400': '#c084fc',
                    '500': '#a855f7',
                    '600': '#9333ea',
                    '700': '#7e22ce',
                    '800': '#6b21a8',
                    '900': '#581c87'
                },
                secondary: {
                    '50': '#FFFFFF',
                    '100': '#F7FEF1',
                    '200': '#E3FDCA',
                    '300': '#CEFBA3',
                    '400': '#B9F97C',
                    '500': '#A4F755',
                    '600': '#87F41F',
                    '700': '#6BD20A',
                    '800': '#509C07',
                    '900': '#356705'
                },
                success: {
                    '50': '#f6faf2',
                    '100': '#edf5e6',
                    '200': '#d2e6bf',
                    '300': '#b6d799',
                    '400': '#80b94d',
                    '500': '#499b00',
                    '600': '#428c00',
                    '700': '#377400',
                    '800': '#2c5d00',
                    '900': '#244c00'
                },
                warning: {
                    '50': '#fffaf2',
                    '100': '#fff5e6',
                    '200': '#ffe5bf',
                    '300': '#ffd699',
                    '400': '#ffb74d',
                    '500': '#ff9800',
                    '600': '#e68900',
                    '700': '#bf7200',
                    '800': '#995b00',
                    '900': '#7d4a00'
                },
                danger: {
                    '50': '#fdf5f6',
                    '100': '#fcebec',
                    '200': '#f6cdd1',
                    '300': '#f1aeb5',
                    '400': '#e7727d',
                    '500': '#dc3545',
                    '600': '#c6303e',
                    '700': '#a52834',
                    '800': '#842029',
                    '900': '#6c1a22'
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
