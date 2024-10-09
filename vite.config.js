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
    base: 'http://knight28.me/islandmexico',
    resolve: {
        alias: {
            ziggy: 'vendor/tightenco/ziggy/dist',
        },
    },
    build: {
        rollupOptions: {
            external: ['ziggy'],
        },
        outDir: 'dist',
    },
});
