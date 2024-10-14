import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0', 
        port: 5173,      
        cors: {
            origin: 'http://localhost:8000',
            methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'], 
            allowedHeaders: ['Content-Type', 'Authorization'], 
        },
    },
});
