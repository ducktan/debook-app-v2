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


class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $ebooks = Product::where('type', 'ebook')->latest()->take(6)->get();
        $podcasts = Product::where('type', 'podcast')->latest()->take(6)->get();

        return view('pages.index', compact('ebooks', 'podcasts','categories'));
    }
    public function member()
    {
        return view('pages.member');
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
  
}
