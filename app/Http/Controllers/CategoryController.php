<?php

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        // Lấy danh mục theo slug
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // Lấy các sản phẩm thuộc danh mục đó
        $products = Product::where('category_id', $category->id)->get();

        // Trả về view với thông tin danh mục và các sản phẩm
        return view('pages.category', compact('category', 'products'));
    }
}
