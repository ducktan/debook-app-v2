@extends('layouts.app', ['hideHeaderFooter' => false])

@section('title', 'Debook - Giỏ hàng')

@section('css')
    @vite(['resources/css/cart.css'])
@endsection

@section('content')
<main class="container my-4">
    <div class="row">
        <!-- Cart Items Section -->
        <div class="col-lg-8">
            <!-- Cart Header -->
            <div class="cart-header bg-white p-3 rounded shadow-sm mb-3">
                <div class="d-flex align-items-center">
                    <div class="form-check flex-grow-1">
                        <input class="form-check-input" type="checkbox" id="selectAll" checked>
                        <label class="form-check-label fw-bold" for="selectAll">Sản phẩm</label>
                    </div>
                    <div class="text-center" style="width: 120px;">Đơn giá (đ)</div>
                    <div class="text-center" style="width: 120px;">Số lượng</div>
                    <div class="text-center" style="width: 120px;">Thành tiền (đ)</div>
                    <div class="text-center" style="width: 50px;"><i class="fas fa-trash-alt"></i></div>
                </div>
            </div>

            <!-- Cart Items -->
            <div class="cart-items bg-white rounded shadow-sm">
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
                                    </div>
                                </div>
                            </div>
        
                            <!-- Product Price -->
                            <div class="col-md-2 text-center">
                                <div class="product-price">
                                    <span 
                                        class="text-success fw-bold product-price" 
                                        data-id="{{ $product['id'] }}" 
                                        data-price="{{ $product['price'] }}"
                                    >
                                        {{ $product['price'] }}
                                    </span>
                                </div>
                            </div>
                            
        
                            <!-- Quantity -->
                            <div class="col-md-2 text-center">
                                <div class="product-quantity">
                                    <div class="input-group input-group-sm">
                                        <button class="btn btn-outline-secondary quantity-update" data-id="{{ $product['id'] }}" data-action="decrease">-</button>
                                        <input type="text" class="form-control text-center quantity" value="{{ $product['quantity'] }}" min="1" id="quantity-{{ $product['id'] }}" readonly>
                                        <button class="btn btn-outline-secondary quantity-update" data-id="{{ $product['id'] }}" data-action="increase">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Price for this item -->
                            <div class="col-md-2 text-center text-danger fw-bold">
                                <span class="item-total" data-id="{{ $product['id'] }}">
                                 {{ $product['price'] * $product['quantity'] }}
                                </span>
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

            <!-- Continue Shopping Link -->
            <div class="mt-3">
                <a href="#" class="text-success"><i class="fas fa-arrow-left me-2"></i>Tiếp tục mua sắm</a>
            </div>
        </div>

        <!-- Order Summary Section -->
        <div class="col-lg-4">
            <div class="order-summary-header bg-white p-3 rounded shadow-sm mb-3">
                <h5 class="mb-0">Tóm tắt đơn hàng</h5>
            </div>
            
            <div class="order-summary bg-white rounded shadow-sm p-3 sticky-top" style="top: 20px;">
                <div class="d-flex justify-content-between mb-2 total__price">
                    <span>Tạm tính (đ):</span>
                    <span>{{number_format($totalPrice)}}đ</span>
                </div>
                {{-- <div class="d-flex justify-content-between mb-2">
                    <span>Giảm giá:</span>
                    <span class="text-success">-70.000đ</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Phí vận chuyển:</span>
                    <span>0đ</span>
                </div> --}}
                <hr>
                <div class="d-flex justify-content-between mb-3">
                    <span class="fw-bold">Tổng cộng:</span>
                    <span class="text-danger fw-bold fs-5 "id="total__prices">{{number_format($totalPrice)}}đ</span>
                </div>
            
                <form action="{{ route('payment')}}" method="POST">
                    @csrf
                    <input type="hidden" name="amount" value="{{ $totalPrice }}">
                    <input type="submit" value="Thanh toán VNPAY" class="btn btn-danger w-100 rounded-pill py-2 mb-2" name="redirect">
                </form>
                
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
