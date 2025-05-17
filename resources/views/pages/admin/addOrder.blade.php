@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Thêm Đơn Hàng')
@section('css')
    @vite(['resources/css/admin/orderSetting.css'])
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Thanh bên -->
        <nav class="col-md-3 col-lg-2 d-md d-md-block bg-white sidebar border-end p-3 min-vh-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="{{ asset('IMG/Logo.png') }}" alt="logo" class="img-fluid mynav__logo">
                <button class="btn btn-sm d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./admin.html">
                        <i class="bi bi-speedometer2 text-primary"></i>
                        <span>Bảng điều khiển</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./userManagement.html">
                        <i class="bi bi-people-fill text-warning"></i>
                        <span>Người dùng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./authorManagement.html">
                        <i class="bi bi-person-badge-fill text-success"></i>
                        <span>Tác giả</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./productManagement.html">
                        <i class="bi bi-book-half text-info"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.order') }}">
                        <i class="bi bi-cart-check text-danger"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./paymentManagement.html">
                        <i class="bi bi-credit-card text-secondary"></i>
                        <span>Thanh toán</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./contentManagement.html">
                        <i class="bi bi-file-earmark-text text-dark"></i>
                        <span>Nội dung</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Nội dung chính -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-cart-check me-2" style="color: #FBBC05;"></i>THÊM ĐƠN HÀNG
                </h2>
                <a href="{{ route('admin.order') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Quay lại
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Khách hàng</label>
                                <select class="form-select" name="user_id" required>
                                    <option value="">Chọn khách hàng</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tổng tiền</label>
                                <input type="number" class="form-control" name="total" step="0.01" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mã VNPAY</label>
                                <input type="text" class="form-control" name="codeVNPAY">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-select" name="status" required>
                                    <option value="cho_xac_nhan">Chờ xác nhận</option>
                                    <option value="da_xac_nhan">Đã xác nhận</option>
                                    <option value="dang_giao">Đang giao</option>
                                    <option value="da_giao">Đã giao</option>
                                    <option value="da_huy">Đã hủy</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <form action="{{ route('admin.create') }}" method="POST">
                                    @csrf
                                    <!-- Các trường: user_id, total, codeVNPAY, status -->
                                    <button type="submit" class="btn btn-primary">Thêm đơn hàng</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection