@extends('layouts.app', ['hideHeaderFooter' => false])
@section('title', 'Debook - Ấn phẩm của tôi')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">ẤN PHẨM CỦA BẠN</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <div class="text-center text-muted">
            <i class="bi bi-emoji-frown" style="font-size: 2rem;"></i>
            <p class="mt-2">Bạn chưa mua ấn phẩm nào.</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        @if($product->image_url)
                            <img src="{{ asset($product->image_url) }}" 
                                class="card-img-top img-fluid" 
                                alt="{{ $product->title }}"
                                style="height: 180px; width: 100%; object-fit: cover; border-top-left-radius: .5rem; border-top-right-radius: .5rem;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 180px;">
                                <span class="text-muted">Không có ảnh</span>
                            </div>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                            <form action="{{ route('user.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xoá ấn phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xoá</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
