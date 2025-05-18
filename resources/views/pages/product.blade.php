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

                    <form method="" action="{{ route('products') }}">
                        <select name="sort" onchange="this.form.submit()">
                            <option value="">Sắp xếp theo</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Tên A-Z</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Tên Z-A</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="col-12 col-md-9">          

            <div class="row" id="product-list">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-lg-4 mb-4">
                        <div class="product-card card">
                            <a href="{{ route('products.show', $product->id) }}" class="product-card-link">
                                <img src="{{ asset('storage/images/products/' . $product->image_url ?? 'IMG/default.png') }}" alt="{{ $product->title }}" class="img-fluid">
                                <div class="product-info">
                                    <h3>{{ $product->title }}</h3>
                                    <p>{{Str::limit($product->description, 100) }}</p>

                                    <p class="price">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                    <p class="rating">
                                        @for ($i = 0; $i < floor($product->rating); $i++) <i class="fas fa-star"></i> @endfor
                                        @if ($product->rating - floor($product->rating) >= 0.5) <i class="fas fa-star-half-alt"></i> @endif
                                        @for ($i = ceil($product->rating); $i < 5; $i++) <i class="far fa-star"></i> @endfor
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

                <!-- Hiển thị phân trang -->
                <!-- Phân trang sử dụng Bootstrap -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <!-- Previous page -->
                        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>

                        <!-- Các trang -->
                        @for ($i = 1; $i <= $products->lastPage(); $i++)
                            <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <!-- Next page -->
                        <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            
        </div>
    </div>
</main>




            



@endsection


