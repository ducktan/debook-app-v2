<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Sách văn học', 'slug' => 'sach-van-hoc']);
        Category::create(['name' => 'Sách khoa học', 'slug' => 'sach-khoa-hoc']);
        Category::create(['name' => 'Sách kỹ năng', 'slug' => 'sach-ky-nang']);
    }
}