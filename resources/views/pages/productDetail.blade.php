@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Chi tiêt sản phẩm')
@section('css')
    @vite(['resources/css/productDetail.css'])
@endsection

@section('content')

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row g-5">
            <!-- Product Gallery (Bên trái) -->
            <div class="col-lg-6">
                <div class="main-image mb-3">
                    <img src="{{ asset($product->image_url ?? 'IMG/default.png') }}" class="img-fluid rounded-3 shadow" alt="{{ $product->title }}">
                </div>
                <div class="thumbnail-grid row g-2">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="col-3">
                            <img src="{{ asset($product->image_url ?? 'IMG/default.png') }}" class="img-fluid rounded-2 cursor-pointer" alt="Thumbnail {{ $i + 1 }}">
                        </div>
                    @endfor
                </div>
            </div>
    
            <!-- Product Info (Bên phải) -->
            <div class="col-lg-6">
                <h1 class="mb-3">{{ $product->title }}</h1>
                <div class="book-info mb-3">
                    <div class="text-muted">Tác giả: {{ $product->author }}</div>
                    <div class="text-muted">Ngày xuất bản: {{ \Carbon\Carbon::parse($product->publication_date)->format('d/m/Y') }}</div>
                </div>
    
               <!-- Rating -->
                <div class="rating mb-3">
                    @for ($i = 0; $i < floor($averageRating); $i++)
                        <i class="fas fa-star text-warning"></i>
                    @endfor
                    @if ($averageRating - floor($averageRating) >= 0.5)
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @endif
                    @for ($i = ceil($averageRating); $i < 5; $i++)
                        <i class="far fa-star text-warning"></i>
                    @endfor
                    <span class="ms-2">({{ number_format($averageRating, 1) }}/5)</span>
                </div>

    
                <!-- Giá sản phẩm -->
                <div class="price-section mb-4">
                    <span class="h3 text-success">{{ number_format($product->price, 0, ',', '.') }}đ</span>
                    {{-- Nếu có giá gốc (ví dụ: giảm giá), có thể hiện thêm --}}
                    @if(isset($product->original_price))
                        <del class="text-muted ms-2">{{ number_format($product->original_price, 0, ',', '.') }}đ</del>
                    @endif
                </div>
    
            @if ($product->category_id == 6) 
            {{-- Tuỳ id sửa lại --}}
                <div class="mb-4 d-flex">
                   <button type="submit" class="btn btn-success btn-lg rounded-pill" style="margin-right: 16px;">
                             @if($product->type == 'ebook')
                                    <a href="{{ route('products.read', $product->id) }}">Đọc sách</a>
                            @elseif($product->type == 'podcast')
                                    <a href="{{ route('products.listen', $product->id) }}">Nghe podcast</a>
                            @endif
                    </button>                     
                </div>                
            @else

                @if ($product->price == 0)
                     @if($product->type == 'ebook')
                        <a href="{{ route('products.read', $product->id) }}" class="btn btn-success">Đọc sách</a>
                    @elseif($product->type == 'podcast')
                        <a href="{{ route('products.listen', $product->id) }}" class="btn btn-success">Nghe podcast</a>
                    @endif
                @else

                    <form id="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" class="me-3">
                            @csrf
                        <!-- Số lượng -->
                        <div class="quantity-selector mb-4">
                            <h5>Số lượng:</h5>
                            <div class="input-group w-25">
                                <button class="btn btn-outline-success" type="button" id="decreaseQty">-</button>
                                <input type="text" id="quantityInput" class="form-control text-center" value="1" readonly name="quantity">
                                <button class="btn btn-outline-success" type="button" id="increaseQty">+</button>
                            </div>
                        </div>
            
                        <!-- Thêm vào giỏ hàng + Mua ngay -->
                        <div class="mb-4 d-flex">
                            <!-- Thêm vào giỏ hàng -->
                            
                            
                                <button type="submit" class="btn btn-success btn-lg rounded-pill" style="margin-right: 16px;">
                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ hàng
                                </button>

                                <button type="submit" class="btn btn-warning btn-lg rounded-pill" style="margin-right: 16px;">
                                    Mua ngay   
                                </button>
                        
                        
                            
                        </div>
                    </form>
                @endif

            @endif
            

    
                <!-- Tóm tắt sách -->
                

                <div class="book-summary">
                    <h5 class="summary-title">Tóm tắt sách</h5>
                    
                    <!-- Nội dung rút gọn -->
                    <p id="summaryShort" class="summary-text">
                        {{ Str::limit($product->description, 200) }}
                    </p>
                
                    <!-- Nội dung đầy đủ, ẩn ban đầu -->
                    <p id="summaryFull" class="summary-text d-none">
                        {{ $product->description }}
                    </p>
                
                    <a href="javascript:void(0)" id="toggleSummary" class="read-more">
                        Đọc thêm <i class="fas fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
    
<!-- Phần Đánh giá -->
<section class="reviews-section mt-5">
    <div class="container">
        <h2 class="mb-4">Đánh giá sản phẩm</h2>
        
       <!-- Tổng quan đánh giá -->
        <div class="review-summary row mb-5">
            <div class="col-md-4 text-center">
                <div class="average-rating mb-2">
                    <!-- Hiển thị điểm trung bình -->
                    <span class="display-4 text-warning">{{ number_format($averageRating, 1) }}</span>
                </div>
                <div class="stars mb-3">
                    <!-- Hiển thị sao dựa trên điểm trung bình -->
                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < floor($averageRating))
                            <i class="fas fa-star text-warning"></i>
                        @elseif ($i < ceil($averageRating))
                            <i class="fas fa-star-half-alt text-warning"></i>
                        @else
                            <i class="fas fa-star"></i>
                        @endif
                    @endfor
                </div>
                <p class="text-muted">Dựa trên {{ $totalReviews }} đánh giá</p>
            </div>
            <div class="col-md-8">
                <div class="rating-bars">
                    @foreach([5, 4, 3, 2, 1] as $star)
                        <div class="rating-bar mb-2">
                            <span class="me-2">{{ $star }} <i class="fas fa-star text-warning"></i></span>
                            <div class="progress" style="height: 8px;">
                                <!-- Hiển thị tỷ lệ % cho mỗi sao -->
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $ratingPercentages[$star] }}%" aria-valuenow="{{ $ratingPercentages[$star] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="ms-2">{{ number_format($ratingPercentages[$star], 1) }}%</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        
        <!-- Nút viết đánh giá -->
        <button class="btn btn-success mb-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#reviewModal">
            <i class="fas fa-pen me-2"></i>Viết đánh giá
        </button>
        
        <!-- Danh sách đánh giá -->
        
        <div class="review-list mt-5">
            @forelse($product->comments()->latest()->get() as $comment)
                <div class="review-item card mb-4">
                    <div class="card-body">
                        <div class="review-header d-flex justify-content-between mb-3">
                            <div class="user-info d-flex align-items-center">
                                <img src="{{ asset('assets/img/default-avt.jpg') }}" alt="User Avatar"
                                    class="rounded-circle me-3" width="40" height="40">
                                <div>
                                    <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="{{ $i <= $comment->rating ? 'fas' : 'far' }} fa-star text-warning"></i>
                                        @endfor
                                        <span class="ms-2 text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review-content">
                            <p class="mb-0">{{ $comment->content }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
            @endforelse
        </div>


    </div>
</section>

<!-- Modal viết đánh giá -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('comments.store', $product->id) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Viết đánh giá của bạn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <!-- Rating -->
                    <div class="mb-4">
                        <label class="form-label">Đánh giá của bạn</label>
                        <div class="rating-input">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" />
                                <label for="star{{ $i }}" title="{{ $i }} sao"><i class="fas fa-star"></i></label>
                            @endfor
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="mb-3">
                        <label for="reviewContent" class="form-label">Nội dung đánh giá</label>
                        <textarea class="form-control" id="reviewContent" name="content" rows="5" placeholder="Hãy chia sẻ cảm nhận của bạn về sản phẩm này" required></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Gửi đánh giá</button>
                </div>
            </form>
        </div>
    </div>
</div>

   

@endsection

@section('js')
    @vite(['resources/js/productDetail.js'])
@endsection