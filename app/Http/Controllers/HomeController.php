<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $ebooks = Product::where('type', 'ebook')->latest()->take(6)->get();
        $podcasts = Product::where('type', 'podcast')->latest()->take(6)->get();

        return view('pages.index', compact('ebooks', 'podcasts','categories'));
    }



    public function showPackages()
    {
        // Lấy tất cả các gói hội viên từ cơ sở dữ liệu
        $subscriptions = Subscription::all();

        // Truyền dữ liệu tới view
        return view('pages.member', compact('subscriptions'));
    }
  
}
