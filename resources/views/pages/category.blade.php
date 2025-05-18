@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-2">{{ $category->name }}</h1>
    <p class="text-center mb-5">{{ $category->description }}</p>

    <h3 class="mb-4">Sản phẩm thuộc danh mục này:</h3>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-light">
                    @if($product->image_url)
                        <img src="{{ asset('storage/images/products/' . $product->image_url) }}" class="card-img-top img-fluid" alt="{{ $product->name }}" style="object-fit: cover; height: 250px;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                            <span class="text-muted">Không có ảnh</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-success btn-block">Chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
