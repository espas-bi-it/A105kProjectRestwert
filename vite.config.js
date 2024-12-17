import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/bootstrap-4.0.0-dist/css/bootstrap.css'
            ],
            refresh: true,
        }),
    ],
});
