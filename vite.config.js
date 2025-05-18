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
                'resources/css/blogDetail.css',
                'resources/css/member.css',
                'resources/css/admin/dashboard.css',
                'resources/css/admin/userSetting.css',
                'resources/css/admin/sidebar.css',
                'resources/css/admin/productSetting.css',

                'resources/js/productDetail.js',
                'resources/js/cart.js',
                'resources/js/search.js',
                'resources/js/filter.js',
                'resources/js/blogDetail.js',

                'resources/js/admin/user.js',
                'resources/js/admin/category.js',

                
                
            ],
            refresh: true,
        }),
    ],
});
