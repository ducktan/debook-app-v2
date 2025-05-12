<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   public function showProducts(Request $request)
    {
        $categories = Category::all();
        $query = Product::query();

        // Kiểm tra giá trị sắp xếp từ request và áp dụng vào truy vấn
        if ($request->has('sort')) {
            $sort = $request->get('sort');

            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('publication_date', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('publication_date', 'asc');
                    break;
                case 'name_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('title', 'desc');
                    break;
            }
        }

        // Sử dụng paginate để phân trang (10 sản phẩm mỗi trang)
        $products = $query->paginate(10);

        return view('pages.product', compact('products', 'categories'));
    }




    public function show($id)
    {
        // Lấy thông tin sản phẩm cùng với các bình luận của người dùng
        $product = Product::with(['comments.user'])->findOrFail($id);

        // Lấy tất cả các đánh giá của sản phẩm
        $reviews = $product->comments;

        // Tổng số đánh giá
        $totalReviews = $reviews->count();

        // Tính điểm trung bình
        $averageRating = $reviews->avg('rating');

        // Tính tỷ lệ phần trăm cho từng mức sao (5 sao đến 1 sao)
        $ratingPercentages = [];
        for ($star = 5; $star >= 1; $star--) {
            $ratingCount = $reviews->where('rating', $star)->count();
            $ratingPercentages[$star] = $totalReviews > 0 ? ($ratingCount / $totalReviews) * 100 : 0;
        }

        // Trả về view với các dữ liệu đã tính toán
        return view('pages.productDetail', compact('product', 'reviews', 'averageRating', 'totalReviews', 'ratingPercentages'));
    }


    // Comment
    public function store(Request $request, $productId)
    {
        $request->validate([
            'content' => 'required',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        Comment::create([
            'user_id' => Auth::user()->id,
            'product_id' => $productId,
            'content' => $request->content,
            'rating' => $request->rating ?? 0,
        ]);

        return back()->with('success', 'Bình luận đã được gửi.');
    }


    // Read book
    public function read($id)
    {
        $product = Product::findOrFail($id); // Lấy sản phẩm theo ID, nếu không sẽ báo lỗi 404

        return view('pages.readBook', compact('product'));
    }

    public function listen($id)
    {
        $product = Product::withCount('comments')->findOrFail($id);

        return view('pages.playPodcast', compact('product'));
    }
   


    
   


}
