// Importez le module de plugin Tailwind CSS Forms
const forms = require('@tailwindcss/forms');

// Importez le module de plugin Tailwind CSS
const plugin = require('tailwindcss/plugin'); // Ajoutez cette ligne

// Importez le thème par défaut de Tailwind CSS
const defaultTheme = require('tailwindcss/defaultTheme'); // Ajoutez cette ligne

module.exports = {
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
                'custom-blue2': '#2f396d',
                'custom-orange': '#ff8d00',
                'custom-font-blue': '#353858',
                'custom-pagination': '#01105a',
            },
            height: {
                '64': '4rem',
                '112': '6rem',
                '320': '20rem',
                '480': '35rem',
            },
        },
    },

    plugins: [
        forms,
        plugin(function({ addUtilities }) {
            const newUtilities = {
              '.pagination-hidden p': {  // Cibler les balises <p> à l'intérieur de l'élément avec l'attribut role='navigation'
                display: 'none',
             
              },
            };
        
            addUtilities(newUtilities, ['responsive', 'hover']);
        }),
    ],
};
