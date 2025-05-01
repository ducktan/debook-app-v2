<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showProducts()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('pages.product', compact('products', 'categories'));
    }
    public function show($id)
    {
        $product = Product::with(['comments.user'])->findOrFail($id);
        return view('pages.productDetail', compact('product'));
    }


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

   


}
