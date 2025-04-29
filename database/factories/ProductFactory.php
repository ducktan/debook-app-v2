<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $formats = ['ebook', 'audiobook', 'podcast', 'blog'];
        
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'price' => $this->faker->randomFloat(2, 1, 1000), // Giá từ 1 đến 1000
            'image' => $this->faker->imageUrl(640, 480, 'books', true),
            'format_type' => $this->faker->randomElement($formats),
            'rating' => $this->faker->randomFloat(1, 0, 5), // Rating từ 0.0 đến 5.0
            'category_id' => $this->faker->numberBetween(1, 3), // Giả sử có 3 categories
            'sales_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}