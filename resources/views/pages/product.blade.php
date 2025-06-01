@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Danh sách sản phẩm')
@section('css')
    @vite(['resources/css/product.css'])
@endsection

@section('content')
<main class="container my-4">
    <div class="row">
        <!-- Filters -->
        <div class="col-12 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3 filter-title"><i class="fas fa-filter me-2"></i> Bộ lọc tìm kiếm</h5>
        
                    <!-- Filter Form -->
                    <form id="filter-form" action="#" method="GET">
                        <!-- Price Filter -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-3">Giá</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="price[]" value="under_50000" id="price1">
                                <label class="form-check-label" for="price1">Dưới 50.000đ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="price[]" value="50000_100000" id="price2">
                                <label class="form-check-label" for="price2">50.000 - 100.000đ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="price[]" value="over_100000" id="price3">
                                <label class="form-check-label" for="price3">Trên 100.000đ</label>
                            </div>
                        </div>
        
                        <!-- Format Filter -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-3">Định dạng</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="ebook" id="ebook">
                                <label class="form-check-label" for="ebook">Sách điện tử</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="audiobook" id="audiobook">
                                <label class="form-check-label" for="audiobook">Sách nói</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="podcast" id="podcast">
                                <label class="form-check-label" for="podcast">Podcast</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="type[]" value="blog" id="blog">
                                <label class="form-check-label" for="blog">Blog</label>
                            </div>
                        </div>
        
                        <!-- Rating Filter -->
                        <div class="filter-section">
                            <h6 class="text-muted mb-3">Đánh giá</h6>
                            <ul>
                                <li><input type="radio" name="rating" value="5" id="rating5"><label for="rating5"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></label></li>
                                <li><input type="radio" name="rating" value="4" id="rating4"><label for="rating4"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i></label></li>
                                <li><input type="radio" name="rating" value="3" id="rating3"><label for="rating3"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></label></li>
                                <li><input type="radio" name="rating" value="2" id="rating2"><label for="rating2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></label></li>
                                <li><input type="radio" name="rating" value="1" id="rating1"><label for="rating1"><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></label></li>
                            </ul>
                        </div>
        
                        <!-- Submit Filter -->
                        <button type="submit" class="btn btn-primary">Áp dụng bộ lọc</button>
                    </form>
                </div>
            </div>
        </div>
        

        <!-- Product List -->
        <div class="col-12 col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="text-muted">Hiển thị 120 kết quả</div>
                <select class="form-select w-auto" id="sortSelect">
                    <option value="popularity">Phổ biến nhất</option>
                    <option value="price_asc">Giá tăng dần</option>
                    <option value="price_desc">Giá giảm dần</option>
                </select>
            </div>

            <div class="row" id="product-list">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                        <div class="product-card card">
                            <a href="{{ route('products.show', $product->id) }}" class="product-card-link">
                                <img src="{{ asset($product->image_url ?? 'IMG/default.png') }}" alt="{{ $product->title }}" class="img-fluid">
                                <div class="product-info">
                                    <h3>{{ $product->title }}</h3>
                                    <p>{{ $product->description }}</p>
                                    <p class="price">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                    <p class="rating">
                                        @for ($i = 0; $i < floor($product->rating); $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @if ($product->rating - floor($product->rating) >= 0.5)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif
                                        @for ($i = ceil($product->rating); $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <nav class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Trước</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Sau</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</main>





@endsection
