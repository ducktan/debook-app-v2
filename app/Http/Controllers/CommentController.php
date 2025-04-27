<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Lấy danh sách comment của 1 sách
    public function index($bookId)
    {
        $comments = Comment::where('book_id', $bookId)->with('user')->latest()->get();
        return response()->json($comments);
    }

    // Thêm 1 comment mới
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $comment = Comment::create([
            'user_id' => auth()->id(), // yêu cầu đã đăng nhập
            'book_id' => $request->book_id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);

        return response()->json($comment, 201);
    }

    // Xóa comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Chỉ cho phép người tạo comment hoặc admin xóa
        if (auth()->id() !== $comment->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
