@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Blog')
@section('css')
    @vite(['resources/css/blog.css'])
@endsection


@section('content')

</section>
  
<section class="blog-section py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <!-- Tiêu đề Blog -->
            <div class="col-sm-9 col-12 mb-3">
                <h2 class="text-left mb-0 text-success">BLOG CỘNG ĐỒNG</h2>
            </div>
            <!-- Form thêm bài review -->
            <div class="col-sm-3 col-12">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Thêm blog  
                </button>
            </div>
        </div>
        <div class="row" id="blog-posts">
            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 col-12 mb-4 blog-post">
                    <div class="card h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                               <img src="{{ asset('storage/' . $post->image_url) }}" class="card-img-top img-fluid custom-img" alt="Book Cover">

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="{{ route('posts.show', $post->id) }}" class="card-title text-success">{{ $post->title }}</a>

                                    {{-- {{ route('blog.show', $post->id) }} --}}
                                    <p class="card-text"><strong>Ngày đăng: </strong>{{ $post->created_at->format('d/m/Y') }}</p>
                                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                    <p class="card-text"><strong>Tác giả:</strong> {{ $post->user->name ?? 'Không rõ' }}</p>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <button id="load-more" class="btn btn-primary">Xem thêm</button>
        </div>
    </div>
</section>

  

<!-- Modal -->
<div class="modal fade mymodal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="modal-title fs-5" id="exampleModalLabel">Thêm blog</a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="review-form" class="d-flex flex-wrap gap-2 align-items-end border p-3 rounded" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="flex-grow-1">
                        <label for="review-title" class="form-label">Tiêu đề:</label>
                        <input type="text" class="form-control" id="review-title" placeholder="Nhập tiêu đề" required name="title">
                    </div>
                   <div class="flex-grow-1">
                        <label for="review-author" class="form-label">Tác giả:</label>
                        <input type="text" class="form-control" id="review-author"
                            name="author" value="{{ Auth::user()->name ?? 'Không rõ'}} "
                            placeholder="Nhập tên tác giả" readonly required>
                    </div>

                    <div class="flex-grow-1">
                        <label for="review-content" class="form-label">Nội dung:</label>
                        <textarea class="form-control" id="review-content" placeholder="Nhập nội dung blog" rows="4" required name="content"></textarea>
                    </div>
                    <div class="flex-grow-1">
                        <label for="review-image" class="form-label">Ảnh:</label>
                        <input type="file" class="form-control" id="review-image" accept="image/*" required name="image">

                    </div>
                    <div>
                        <button type="submit" class="btn btn-success add__button">Thêm</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
              
            </div>
        </div>
    </div>
</div>
  
@endsection