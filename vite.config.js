import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/master.css',
                'resources/css/index.css',
                'resources/css/user.css',
                'resources/css/member.css',
                'resources/css/product.css',
                'resources/css/admin/dashboard.css',
                
                'resources/js/app.js',  // File chính, nếu bạn có
                'resources/js/product.js'  // Thêm product.js vào phần input
            ],
            refresh: true,
        }),
    ],
});
