import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/sliderPrice.js',
                'resources/js/Menuburger.js',
                'resources/js/imageAdd.js',
                'resources/js/fullscreenimage.js',
                'resources/js/fullcalendar.js',
                'resources/js/map.js',
                'resources/js/autocompleteaddress.js',
                'resources/js/carouselsfilter.js',
                'resources/js/cookies.js',
                'resources/js/registervalidation.js',
                'resources/js/createcarousel.js',
                'resources/js/updateUserValidation.js',
                'resources/js/updatecarousel.js',
                ],
            refresh: true,
        }),
    ],
});
