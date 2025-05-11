import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/master.css',
                'resources/css/index.css',
                'resources/css/login.css',
                'resources/css/user.css',
                'resources/css/product.css',
                'resources/css/productDetail.css',
                'resources/css/readBook.css',
                'resources/css/playPodcast.css',
              
                'resources/css/cart.css',
                'resources/css/blog.css',
                'resources/css/member.css',
                'resources/css/admin/dashboard.css',

                'resources/js/productDetail.js',
                'resources/js/cart.js',
                'resources/js/search.js',
                'resources/js/filter.js',

                
                
            ],
            refresh: true,
        }),
    ],
});
