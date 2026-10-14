
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/css/valensa/app.css',
                'resources/js/valensa/app.js',
            ],
            refresh: true,
        }),
    ],
});
