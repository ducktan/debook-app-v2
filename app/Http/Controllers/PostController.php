<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::latest()->with('user')->get();
        return view('pages.blog', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image',
            // 'audio' => 'nullable|mimes:mp3,wav|max:10240', // 10MB
        ]);

        $imagePath = $request->file('image')?->store('images', 'public');
        $audioPath = $request->file('audio')?->store('audio', 'public');
        $user = Auth::user();
        Post::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'content' => $request->content,
            'image_url' => $imagePath,
            'audio_url' => $audioPath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo!');
    }

}
