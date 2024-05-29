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
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
              primary: 'bg-red-300',
              secondary: 'bg-orange-500',
              'custom-blue-header': '#01105a',
              'custom-blue': '#3f4874',
              'custom-blue2' :'#2f396d',
              'custom-orange':'#ff8d00',
              'custom-font-blue' :'#353858',
            },
            height: {
                '64' : '4rem',
                '112': '6rem',
                '320': '20rem', // Exemple de hauteur personnalisée, vous pouvez en ajouter d'autres
                '480': '35rem',
              },
        },
    },

    plugins: [forms],
};
