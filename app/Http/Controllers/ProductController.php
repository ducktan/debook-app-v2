<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $products = Product::withCount('reviews')
        ->priceRange($request->price_range)
        ->withFormat($request->format)
        ->minRating($request->min_rating)
        ->orderBy(
            $request->sort === 'price_asc' || $request->sort === 'price_desc' ? 'price' : 'reviews_count',
            $request->sort === 'price_asc' ? 'asc' : 'desc'
        )
        ->paginate(12)
        ->withQueryString();

    return view('pages.product', compact('products'));
}

    public function show($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        return view('pages.product_detail', compact('product'));
    }
}