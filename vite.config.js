import { fileURLToPath, URL } from 'node:url'
import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament.css',
            ],
            refresh: [
                ...refreshPaths,
                'app/Http/Livewire/**',
                'app/Forms/Components/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            '@node_modules': fileURLToPath(new URL('./node_modules', import.meta.url))
        }
    }
});
