<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Support\Str;


class PostController extends Controller
{
         // 1. Hiển thị danh sách bài viết
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->get();
        return view('pages.blog', compact('posts'));
    }

    // 2. Hiển thị chi tiết bài viết
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);

        // Tăng lượt xem nếu muốn
        $post->increment('views');

        return view('pages.blogDetail', compact('post'));
    }

    // 3. Tạo bài viết mới (AJAX hoặc submit form)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'author' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

    // Tạo slug từ title
    $slug = Str::slug($validated['title']);
    $originalSlug = $slug;
    $counter = 1;

    // Nếu slug đã tồn tại thì thêm hậu tố -1, -2, ...
    while (Post::where('slug', $slug)->exists()) {
        $slug = $originalSlug . '-' . $counter;
        $counter++;
    }

    $validated['slug'] = $slug;

    // Xử lý upload thumbnail nếu có
    if ($request->hasFile('thumbnail')) {
        $path = $request->file('thumbnail')->store('thumbnails', 'public');
        $validated['thumbnail'] = $path;
    }

    $post = Post::create($validated);

    return response()->json($post, 201);
}


    // 4. Like bài viết
    public function like($id)
    {
        $post = Post::findOrFail($id);
        $post->increment('likes');
        return response()->json(['likes' => $post->likes]);
    }

    // 5. Thêm bình luận
    public function addComment(Request $request, $id)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        $comment = new PostComment([
            'author' => $request->author,
            'content' => $request->content,
        ]);

        $post->comments()->save($comment);

        return response()->json($comment, 201);
    }

    // 6. (Tùy chọn) Xóa bình luận
    public function deleteComment($id)
    {
        $comment = PostComment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Bình luận đã bị xóa']);
    }



}
