import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Your existing assets
                'resources/sass/app.scss',
                'resources/js/app.js',

                // ✅ Sneat assets (adjust paths as needed)
                'resources/sass/sneat/core.scss',
                'resources/js/sneat/core.js',
            ],
            refresh: true,
        }),
    ],
});
