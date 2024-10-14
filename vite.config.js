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
        host: '0.0.0.0', // Allow access from any IP address (useful in Docker)
        port: 5173,      // The port Vite is running on
        cors: {
            origin: 'http://localhost:8000', // Adjust to match your Laravel server URL
            methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'], // Allowed methods
            allowedHeaders: ['Content-Type', 'Authorization'], // Allowed headers
        },
    },
});
