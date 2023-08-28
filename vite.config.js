import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/hotel-js/app.js',
                'resources/hotel-css/app.css',
            ],
            refresh: true,
        }),
    ],
});
