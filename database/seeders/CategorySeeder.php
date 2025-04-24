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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Podcast truyền cảm hứng',
                'slug' => 'podcast-truyen-cam-hung',
                'description' => 'Các tập podcast về câu chuyện cuộc sống, động lực và cảm hứng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

