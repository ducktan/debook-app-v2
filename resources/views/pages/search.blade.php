<h1>Kết quả tìm kiếm cho: "{{ $query }}"</h1>

@if($products->isEmpty())
    <p>Không có sản phẩm nào phù hợp với từ khóa bạn tìm.</p>
@else
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
<!-- Phân trang kết quả tìm kiếm -->
<div class="pagination">
    {{ $products->links() }}
</div>
