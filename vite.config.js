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
    base: 'https://JoseDCaballero.github.io/islandmexico/',
    resolve: {
        alias: {
            ziggy: 'vendor/tightenco/ziggy/dist',
        },
    },
    build: {
        rollupOptions: {
            external: ['ziggy'],
        },
    },
});
