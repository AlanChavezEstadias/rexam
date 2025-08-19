import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            colors: {
                sonora: {
                    naranja: '#DC7F37',
                    rojo: '#B94645',
                    vino: '#9B2F3E',
                    guinda: '#410324',
                    magenta: '#960E53',
                    negro: '#000000',
                    blanco: '#FFFFFF',
                },
            },
        },
    },

    plugins: [forms],
};
