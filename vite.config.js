import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/master.css',
                'resources/css/index.css',
            ],
            refresh: true,
        }),
    ],
});
