<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeSubscriberMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SubscribeRequest;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Comment;


class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $ebooks = Product::where('type', 'ebook')
            ->withAvg('comments', 'rating')    // thêm trường comments_avg_rating
            ->orderByDesc('comments_avg_rating')
            ->take(8)
            ->get();
        $podcasts = Product::where('type', 'podcast')->latest()->take(6)->get();
        $blogs = Post::latest()->take(6)->get();  // lấy 6 bài blog mới nhất
        $fiveStarComments = Comment::where('rating', 5)->latest()->take(4)->get();

        return view('pages.index', compact('ebooks', 'podcasts', 'categories', 'blogs', 'fiveStarComments'));

        
    }
    public function member()
    {
        // Lấy tất cả các gói hội viên từ bảng subscriptions
        $subscriptions = Subscription::all();
        return view('pages.member', compact('subscriptions'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Gửi mail ngay lập tức mà KHÔNG lưu database
        Mail::to($request->email)->send(new WelcomeSubscriberMail());

        return back()->with('success', 'Đã gửi mail thành công!');
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->limit(10)
            ->get(['id', 'title', 'image_url']);

        return response()->json($products);
    }


   
  
}
