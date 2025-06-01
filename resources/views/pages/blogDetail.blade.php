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
        <a href="{{ url ('/') }}"><i class="fa-solid fa-house"></i></a>
    </div>

    <div class="blog-post blog__item mb-5">
        <!-- Header bài viết -->
        <div class="post-header">
            <img src="{{ asset('IMG/book2.jpg') }}" alt="Avatar" class="avatar">
            <div class="author-info">
                <h3 class="author-name">{{ $post->author ?? 'Ẩn danh' }}</h3>
                <span class="post-time">{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>

        <!-- Nội dung bài viết -->
        <div class="post-content">
            <h2 class="post-title">{{ $post->title }}</h2>
            <p>{!! nl2br(e($post->content)) !!}</p>

            @if($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Hình ảnh bài viết" class="post-image">
            @endif
        </div>

        <!-- Tương tác -->
        <div class="post-actions">
            <div class="action-stats">
                <span id="like-count">{{ $post->likes }} lượt thích</span>
            </div>
            <div class="action-buttons">
                <button id="like-btn" class="action-btn" data-id="{{ $post->id }}">
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
                <button id="submit-comment" data-id="{{ $post->id }}">Gửi</button>
            </div>
            <div class="comment-list" id="comment-list">
                @foreach($post->comments as $comment)
                    <div class="comment-item">
                        <strong>{{ $comment->author }}</strong>: {{ $comment->content }}
                        <br>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
