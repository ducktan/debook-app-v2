@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Debook - Blog Detail')
@section('css')
    @vite(['resources/css/blogDetail.css'])
@endsection
@section('js')
    @vite(['resources/js/blogDetail.js'])
@endsection

@section('content')

<div class="my-container">
    <div class="comeback mb-3">
        <a href="{{ url ('/')}}"><i class="fa-solid fa-house"></i></a>
    </div>

        <div class="blog-post blog__item mb-5">
            <!-- Header bài viết -->
        <div class="post-header">
        <img src="{{ asset('storage/' . ($post->image_url ?? 'images/default.jpg')) }}" alt="Ảnh đại diện" class="avatar">
        <div class="author-info">
            <h3 class="author-name">{{ $post->user->name ?? 'Không rõ' }}</h3>
            <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <!-- Nội dung bài viết -->
    <div class="post-content">
        <h2 class="post-title">{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>

        @if ($post->image_url)
            <img src="{{ asset('storage/' . $post->image_url) }}" alt="Hình ảnh bài viết" class="post-image">
        @endif
    </div>


        <!-- Tương tác -->
        <div class="post-actions">
            <div class="action-stats">
                <span id="like-count">5 lượt thích</span>
            </div>
            <div class="action-buttons">
                <button id="like-btn" class="action-btn">
                    <i class="far fa-heart"></i> Thả tim
                </button>
                <button id="comment-btn" class="action-btn">
                    <i class="far fa-comment"></i> Bình luận
                </button>
            </div>
        </div>

        <!-- Phần bình luận -->
        <div class="comments-section" id="comments-section">
            <div class="comment-input">
                <input type="text" id="comment-input" placeholder="Viết bình luận...">
                <button id="submit-comment">Gửi</button>
            </div>
            <div class="comment-list" id="comment-list">
                <!-- Bình luận sẽ được thêm bằng JS -->
            </div>
        </div>
    </div>

    

</div>
  


  
@endsection