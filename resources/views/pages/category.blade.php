@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $category->name }}</h1>
    <p>{{ $category->description }}</p>

    <h3>Sản phẩm thuộc danh mục này:</h3>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset($product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
