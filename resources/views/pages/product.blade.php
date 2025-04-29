@extends('layouts.app', ['hideHeaderFooter' => false])
@php use Illuminate\Support\Facades\Storage; @endphp
@section('title', 'Debook - Danh sách sản phẩm')
@section('css')
    @vite(['resources/css/product.css'])
@endsection

@section('content')
<main class="container my-4">
    <div class="row g-4">
        <!-- Filters -->
        <aside class="col-lg-3">
            <form action="{{ route('products.index') }}" method="GET" id="filter-form">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3 filter-title"> <i class="fas fa-filter me-2"></i> Bộ lọc tìm kiếm </h5>
                        
                        <div class="mb-4">
                            <h6 class="text-muted mb-3">Giá</h6>
                            <div class="form-check">
                                <input class="form-check-input price-filter" type="radio" name="price_range" 
                                       id="price_all" value="" {{ !request('price_range') ? 'checked' : '' }}>
                                <label class="form-check-label" for="price_all">Tất cả</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input price-filter" type="radio" name="price_range" 
                                       id="price1" value="under_50k" {{ request('price_range') == 'under_50k' ? 'checked' : '' }}>
                                <label class="form-check-label" for="price1">Dưới 50.000đ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input price-filter" type="radio" name="price_range" 
                                       id="price2" value="50k_100k" {{ request('price_range') == '50k_100k' ? 'checked' : '' }}>
                                <label class="form-check-label" for="price2">50.000 - 100.000đ</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input price-filter" type="radio" name="price_range" 
                                       id="price3" value="over_100k" {{ request('price_range') == 'over_100k' ? 'checked' : '' }}>
                                <label class="form-check-label" for="price3">Trên 100.000đ</label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-muted mb-3">Định dạng</h6>
                            @foreach(['ebook' => 'Sách điện tử', 'audiobook' => 'Sách nói', 'podcast' => 'Podcast', 'blog' => 'Blog'] as $format => $label)
                            <div class="form-check">
                                <input class="form-check-input format-filter" type="checkbox" 
                                       name="format[]" id="{{ $format }}" value="{{ $format }}"
                                       {{ in_array($format, (array)request('format', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $format }}">{{ $label }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="filter-section mb-4">
                            <h6 class="text-muted mb-3">Đánh giá</h6>
                            @foreach([5 => '5 sao', 4 => '4 sao trở lên', 3 => '3 sao trở lên', 2 => '2 sao trở lên', 1 => '1 sao trở lên'] as $rating => $label)
                            <div class="form-check">
                                <input class="form-check-input rating-filter" type="radio" 
                                       name="min_rating" id="rating{{ $rating }}" value="{{ $rating }}"
                                       {{ request('min_rating') == $rating ? 'checked' : '' }}>
                                <label class="form-check-label" for="rating{{ $rating }}">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                    {{ $label }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Áp dụng bộ lọc</button>
                        @if(request()->hasAny(['price_range', 'format', 'min_rating']))
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">Xóa bộ lọc</a>
                        @endif
                    </div>
                </div>
            </form>
        </aside>

        <!-- Product List -->
        <section class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="text-muted">Hiển thị {{ $products->total() }} kết quả</div>
                <form method="GET" class="mb-0">
                    <select class="form-select w-auto" name="sort" onchange="this.form.submit()">
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến nhất</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
                    </select>
                    @foreach(request()->except('sort') as $key => $value)
                        @if(is_array($value))
                            @foreach($value as $val)
                                <input type="hidden" name="{{ $key }}[]" value="{{ $val }}">
                            @endforeach
                        @else
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endif
                    @endforeach
                </form>
            </div>

            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-card h-100">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                                <div class="card h-100">
                                <img src="{{ $product->image ? Storage::url($product->image) : asset('images/default-product.jpg') }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ Str::limit($product->name, 50) }}</h5>
                                        <p class="card-text text-muted small">{{ Str::limit($product->description, 100) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="price fw-bold text-danger mb-0">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                                            <p class="rating mb-0">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= floor($product->rating))
                                                        <i class="fas fa-star text-warning"></i>
                                                    @elseif ($i - $product->rating < 1)
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                                <small class="text-muted">({{ $product->reviews_count }})</small>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white">
                                        <button class="btn btn-primary w-100 add-to-cart" data-id="{{ $product->id }}">
                                            <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                        </button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Không tìm thấy sản phẩm nào phù hợp với bộ lọc của bạn.
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
            <nav class="mt-5">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
            </nav>
            @endif
        </section>
    </div>
</main>
@endsection

@section('scripts')
@vite(['resources/js/product.js'])
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý thêm vào giỏ hàng
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            
            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    toastr.success('Đã thêm sản phẩm vào giỏ hàng');
                    updateCartCount(data.cart_count);
                } else {
                    toastr.error(data.message);
                }
            });
        });
    });
    
    function updateCartCount(count) {
        const cartCountElements = document.querySelectorAll('.cart-count');
        cartCountElements.forEach(el => {
            el.textContent = count;
            el.classList.remove('d-none');
        });
    }
});
</script>
@endsection