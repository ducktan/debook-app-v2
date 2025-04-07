@extends('layouts.master', ['hideHeaderFooter' => true])

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
            <img src="./IMG/book2.jpg" alt="Avatar" class="avatar">
            <div class="author-info">
                <h3 class="author-name">Nguyễn Văn A</h3>
                <span class="post-time">2 giờ trước</span>
            </div>
        </div>

        <!-- Nội dung bài viết -->
        <div class="post-content">
            <h2 class="post-title">Một ngày đẹp trời ở Hà Nội</h2>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum consectetur neque ad sint quibusdam veniam iusto delectus eos fuga enim illo voluptas sit vel soluta tempore ipsa nihil, ratione doloremque sunt reprehenderit quia nisi impedit? Cupiditate molestias sed odit quibusdam harum fuga vitae iste iure quasi culpa facere dolore magni dicta esse doloribus delectus nihil itaque amet, consequuntur repellat officiis rerum numquam. Nisi hic, ad, fugit consequuntur similique impedit sed consequatur soluta vero magni quasi nesciunt dolor reprehenderit harum quas facere ab quaerat? Dolorem doloribus est maiores, pariatur corrupti officiis beatae perferendis incidunt possimus, iusto dolores accusamus recusandae harum omnis aperiam? Repudiandae error voluptatum autem aut iure quas est ullam, sit maxime quasi? Eligendi et quo blanditiis quidem iure laboriosam placeat molestiae ipsam nam, ducimus odio explicabo. Expedita, assumenda nisi fugiat eligendi eveniet illo dolorem facilis, doloribus itaque vel illum eos deleniti facere eum corrupti tempora iusto totam labore in.
            </p>
            <img src="./IMG/banner1.png" alt="Hình ảnh bài viết" class="post-image">
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