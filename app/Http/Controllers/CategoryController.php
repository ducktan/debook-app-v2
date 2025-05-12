<?php

// app/Http/Controllers/CategoryController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function show($slug)
    {

        // Kiểm tra nếu slug là nội dung VIP
        if ($slug === 'noi-dung-doc-quyen-vip') {
            // Kiểm tra người dùng có phải VIP không
            if (!Auth::check() || Auth::user()->utype !== 'VIP') {
                return redirect()->route('login')->with('error', 'Bạn cần là thành viên VIP để truy cập nội dung này.');
            }
        }
        // Lấy danh mục theo slug
        $category = Category::where('slug', $slug)->firstOrFail();
        
        // Lấy các sản phẩm thuộc danh mục đó
        $products = Product::where('category_id', $category->id)->get();

        // Trả về view với thông tin danh mục và các sản phẩm
        return view('pages.category', compact('category', 'products'));
    }
}
