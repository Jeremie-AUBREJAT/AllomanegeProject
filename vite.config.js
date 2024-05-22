import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/sliderPrice.js',
                'resources/js/carouseldetails.js',
                'resources/js/Menuburger.js',
                'resources/js/imageAdd.js',
                'resources/js/fullscreenimage.js',
                'resources/js/fullcalendar.js'],
            refresh: true,
        }),
    ],
});
