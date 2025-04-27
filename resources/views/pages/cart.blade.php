@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Giỏ hàng')
@section('css')
    @vite(['resources/css/cart.css'])
@endsection

@section('content')

</section>
  
<main class="container my-4">
    <div class="row">
        <div class="col-lg-8">
           
            <!-- Cart Header -->
            <div class="cart-header bg-white p-3 rounded shadow-sm mb-3">
                <div class="d-flex align-items-center">
                    <div class="form-check flex-grow-1">
                        <input class="form-check-input" type="checkbox" id="selectAll" checked>
                        <label class="form-check-label fw-bold" for="selectAll">Sản phẩm</label>
                    </div>
                    <div class="text-center" style="width: 120px;">Đơn giá</div>
                    <div class="text-center" style="width: 120px;">Số lượng</div>
                    <div class="text-center" style="width: 120px;">Thành tiền</div>
                    <div class="text-center" style="width: 50px;"><i class="fas fa-trash-alt"></i></div>
                </div>
            </div>

            <!-- Cart Items -->
            <div class="cart-items bg-white rounded shadow-sm">
                <!-- Lặp qua tất cả các sản phẩm trong giỏ hàng -->
                @foreach ($cart as $product)
                    <div class="cart-item p-3 border-bottom">
                        <div class="row align-items-center">
                            <!-- Checkbox -->
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked>
                                </div>
                            </div>
        
                            <!-- Product Info -->
                            <div class="col">
                                <div class="product-info d-flex">
                                    <img src="{{ asset($product['image_url']) }}" alt="{{ $product['name'] }}" class="product-img me-3" style="width: 60px; height: 90px;">

                                    <div class="product-details">
                                        <h6 class="product-title mb-1">{{ $product['name'] }}</h6>
                                        <div class="product-author text-muted small">Tác giả: {{ $product['author'] }}</div>
                                        {{-- <div class="product-format text-muted small">Định dạng: {{ $product->format }}</div> --}}
                                    </div>
                                </div>
                            </div>
        
                            <!-- Product Price -->
                            <div class="col-md-2 text-center">
                                <div class="product-price">
                                    <span class="text-success fw-bold">{{ number_format($product['price']) }}đ</span>
                                    {{-- @if ($product->original_price)
                                        <div class="text-decoration-line-through text-muted small">{{ number_format($product->original_price) }}đ</div>
                                    @endif --}}
                                </div>
                            </div>
        
                           <!-- Quantity -->
                            <div class="col-md-2 text-center">
                                <div class="product-quantity">
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary quantity-update" data-id="{{ $product['id'] }}" data-action="decrease">-</button>
                                        <input type="text" class="form-control text-center quantity" value="{{ $product['quantity'] }}" min="1" id="quantity-{{ $product['id'] }}">
                                        <button class="btn btn-outline-secondary quantity-update" data-id="{{ $product['id'] }}" data-action="increase">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Price for this item -->
                            <div class="col-md-2 text-center text-danger fw-bold">
                                <span class="item-total" data-id="{{ $product['id'] }}">{{ number_format($product['price'] * $product['quantity']) }}đ</span>
                            </div>
                            <!-- Remove Product -->
                            <div class="col-md-1 text-center">
                                <form action="{{ route('cart.remove', $product['id']) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-link text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Continue Shopping -->
            <div class="mt-3">
                <a href="#" class="text-success"><i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm</a>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="order-summary-header bg-white p-3 rounded shadow-sm mb-3">
                <h5 class="mb-0">Tóm tắt đơn hàng</h5>
            </div>
            
            <div class="order-summary bg-white rounded shadow-sm p-3 sticky-top" style="top: 20px;">
                <div class="d-flex justify-content-between mb-2">
                    <span>Tạm tính:</span>
                    <span>680.000đ</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Giảm giá:</span>
                    <span class="text-success">-70.000đ</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Phí vận chuyển:</span>
                    <span>0đ</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Tổng cộng:</span>
                    <span class="text-danger fw-bold fs-5">610.000đ</span>
                </div>
                <button class="btn btn-danger w-100 rounded-pill py-2 mb-2">Mua hàng</button>
                <div class="text-center small text-muted">
                    Bằng cách đặt hàng, bạn đồng ý với <a href="#">Điều khoản sử dụng</a> của Debook
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
    @vite(['resources/js/cart.js'])
@endsection

