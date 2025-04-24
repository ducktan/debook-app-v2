<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            [
                'title' => 'Đắc Nhân Tâm',
                'description' => 'Cuốn sách kinh điển về nghệ thuật giao tiếp và thuyết phục.',
                'author' => 'Dale Carnegie',
                'type' => 'ebook',
                'category_id' => 1, // nhớ đảm bảo Category ID khớp
                'publication_date' => '2020-01-01',
                'price' => 45000,
                'file_url' => 'ebooks/dac-nhan-tam.pdf',
                'image_url' => 'images/dac-nhan-tam.jpg',
                'duration' => null,
                'language' => 'Tiếng Việt',
                'rating' => 4.8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Thức dậy cùng sự biết ơn',
                'description' => 'Podcast chia sẻ thói quen tích cực để khởi đầu ngày mới.',
                'author' => 'Mai Thanh',
                'type' => 'podcast',
                'category_id' => 2,
                'publication_date' => '2024-02-15',
                'price' => 0,
                'file_url' => 'podcasts/biet-on.mp3',
                'image_url' => 'images/biet-on.jpg',
                'duration' => 1800,
                'language' => 'Tiếng Việt',
                'rating' => 4.6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
