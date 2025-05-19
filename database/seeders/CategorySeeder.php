<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Sách phát triển bản thân',
                'slug' => 'sach-phat-trien-ban-than',
                'description' => 'Những cuốn sách giúp phát triển tư duy, kỹ năng sống.',
                'image_url' => 'categories/cat1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Podcast truyền cảm hứng',
                'slug' => 'podcast-truyen-cam-hung',
                'description' => 'Các tập podcast về cuộc sống, động lực và cảm hứng.',
                'image_url' => 'categories/cat2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Sách kinh doanh & khởi nghiệp',
                'slug' => 'sach-kinh-doanh-khoi-nghiep',
                'description' => 'Tài liệu và sách dành cho người làm kinh doanh và startup.',
                'image_url' => 'categories/cat2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Podcast học tập & kỹ năng',
                'slug' => 'podcast-hoc-tap-ky-nang',
                'description' => 'Các podcast giúp nâng cao kỹ năng học và làm.',
                'image_url' => 'categories/cat3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Truyện ngắn & sách nói thư giãn',
                'slug' => 'truyen-ngan-sach-noi-thu-gian',
                'description' => 'Truyện ngắn và audio book nhẹ nhàng giúp thư giãn đầu óc.',
                'image_url' => 'categories/cat3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Nội dung độc quyền VIP',
                'slug' => 'noi-dung-doc-quyen-vip',
                'description' => 'Thư viện tài nguyên chỉ dành riêng cho thành viên VIP.',
                'image_url' => 'category/cat3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
        ]);
    }
}
