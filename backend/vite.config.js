import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import path from 'path'

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, __dirname, '')

    let basePath = '/'
    try {
        const appUrl = env.APP_URL || 'http://localhost'
        basePath = new URL(appUrl).pathname || '/'
    } catch {
        basePath = '/'
    }

    if (!basePath.endsWith('/')) {
        basePath += '/'
    }

    return {
        base: basePath,
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.js', '../src/main.js'],
                refresh: true,
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        includeAbsolute: false,
                    },
                },
            }),
        ],
        resolve: {
            alias: {
                '@': path.resolve(__dirname, '../src'),
            },
        },
    }
})
