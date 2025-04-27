<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
        $product = Product::findOrFail($id);
        return view('pages.productDetail', compact('product'));
    }

   


}
