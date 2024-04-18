import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                    'resources/js/app.js',
                    'resources/js/sliderPrice.js',
                    'ressources/js/carouseldetails.js',
                    'ressources/js/Menuburger.js',],
            refresh: true,
        }),
    ],
});
