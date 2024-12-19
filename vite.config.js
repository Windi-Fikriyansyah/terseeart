import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    optimizeDeps: {
        include: ['vue', 'vue-router','@popperjs/core','bootstrap'], // Explicitly include Vue for optimization
    },
    server: {
        watch: {
            usePolling: true, // Sometimes file watching issues are resolved by using polling
        },
    },
    resolve: {
        alias: {
            '@': '/resources/js',  // Add this line to configure the alias for @
        },
    },
});
