@extends('layouts.master', ['hideHeaderFooter' => true])

@section('title', 'Admin - Order')
@section('css')
    @vite(['resources/css/admin/orderSetting.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md d-md-block bg-white sidebar border-end p-3 min-vh-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="./IMG/Logo.png" alt="logo" class="img-fluid mynav__logo">
                <button class="btn btn-sm d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./admin.html">
                        <i class="bi bi-speedometer2 text-primary"></i>
                        <span>Dashboard</span>
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
                    <a class="nav-link d-flex align-items-center active" href="./orderManagement.html">
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

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <!-- Header -->
            <div class="responsive__item mb-5 d-block d-md-none">
                <ul class="nav d-flex">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center active" href="./admin.html">
                            <i class="bi bi-speedometer2 text-primary"></i>
                            <span>Dashboard</span>
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
                        <a class="nav-link d-flex align-items-center" href="./orderManagement.html">
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
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                
                
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-cart-check me-2" style="color: #FBBC05;"></i>QUẢN LÝ ĐƠN HÀNG
                </h2>
                <div>
                    <button class="btn btn-success me-2">
                        <i class="bi bi-file-earmark-excel me-1"></i> Xuất Excel
                    </button>
                </div>
            </div>

            <!-- Filter Bar -->
            <div class="filter-bar bg-white p-3 rounded shadow-sm mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" id="statusFilter">
                            <option value="all">Tất cả</option>
                            <option value="pending">Chờ xác nhận</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="shipping">Đang giao</option>
                            <option value="delivered">Đã giao</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Từ ngày</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Đến ngày</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tìm kiếm</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Mã đơn, tên KH...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-success">
                        <div class="card-body">
                            <h6 class="text-muted">Tổng đơn</h6>
                            <h4 class="mb-0">128</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-primary">
                        <div class="card-body">
                            <h6 class="text-muted">Chờ xác nhận</h6>
                            <h4 class="mb-0">12</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-secondary">
                        <div class="card-body">
                            <h6 class="text-muted">Đã xác nhận</h6>
                            <h4 class="mb-0">45</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-info">
                        <div class="card-body">
                            <h6 class="text-muted">Đang giao</h6>
                            <h4 class="mb-0">23</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-warning">
                        <div class="card-body">
                            <h6 class="text-muted">Đã giao</h6>
                            <h4 class="mb-0">41</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-success">
                        <div class="card-body">
                            <h6 class="text-muted">Đã hủy</h6>
                            <h4 class="mb-0">7</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Table (Desktop) -->
            <div class="table-responsive mb-4 d-none d-md-block">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="80px">Mã đơn</th>
                            <th width="120px">Ngày đặt</th>
                            <th>Khách hàng</th>
                            <th width="150px">Sản phẩm</th>
                            <th width="120px">Tổng tiền</th>
                            <th width="150px">Trạng thái</th>
                            <th width="150px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Đơn hàng 1: Chờ xác nhận -->
                        <tr>
                            <td>#DH23001</td>
                            <td>15/05/2023</td>
                            <td>
                                <div class="fw-semibold">Nguyễn Văn A</div>
                                <small class="text-muted">nguyenvana@email.com</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="product-img me-2">
                                    <span>2 sản phẩm</span>
                                </div>
                            </td>
                            <td>350.000đ</td>
                            <td>
                                <span class="order-status status-pending">Chờ xác nhận</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#orderDetailModal">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-primary me-1">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Đơn hàng 2: Đã xác nhận -->
                        <tr>
                            <td>#DH23002</td>
                            <td>18/05/2023</td>
                            <td>
                                <div class="fw-semibold">Trần Thị B</div>
                                <small class="text-muted">tranthib@email.com</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.unsplash.com/photo-1589998059171-988d887df646" class="product-img me-2">
                                    <span>1 sản phẩm</span>
                                </div>
                            </td>
                            <td>120.000đ</td>
                            <td>
                                <span class="order-status status-confirmed">Đã xác nhận</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#orderDetailModal">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-info me-1">
                                    <i class="bi bi-truck"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </td>
                        </tr>
                        
                        <!-- Đơn hàng 3: Đang giao -->
                        <tr>
                            <td>#DH23003</td>
                            <td>20/05/2023</td>
                            <td>
                                <div class="fw-semibold">Lê Văn C</div>
                                <small class="text-muted">levanc@email.com</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c" class="product-img me-2">
                                    <span>3 sản phẩm</span>
                                </div>
                            </td>
                            <td>520.000đ</td>
                            <td>
                                <span class="order-status status-shipping">Đang giao</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#orderDetailModal">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Orders Cards (Mobile) -->
            <div class="row g-3 d-md-none">
                <!-- Đơn hàng 1: Chờ xác nhận -->
                <div class="col-12">
                    <div class="card order-card pending">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-warning text-dark">#DH23001</span>
                                <small class="text-muted">15/05/2023</small>
                            </div>
                            <h6 class="card-title mb-1">Nguyễn Văn A</h6>
                            <small class="text-muted d-block mb-2">nguyenvana@email.com</small>
                            
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="product-img me-2">
                                <div>
                                    <div class="fw-semibold">2 sản phẩm</div>
                                    <div class="text-success fw-bold">350.000đ</div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="order-status status-pending">Chờ xác nhận</span>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orderDetailModal">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-primary">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Đơn hàng 2: Đã xác nhận -->
                <div class="col-12">
                    <div class="card order-card confirmed">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-success text-white">#DH23002</span>
                                <small class="text-muted">18/05/2023</small>
                            </div>
                            <h6 class="card-title mb-1">Trần Thị B</h6>
                            <small class="text-muted d-block mb-2">tranthib@email.com</small>
                            
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://images.unsplash.com/photo-1589998059171-988d887df646" class="product-img me-2">
                                <div>
                                    <div class="fw-semibold">1 sản phẩm</div>
                                    <div class="text-success fw-bold">120.000đ</div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="order-status status-confirmed">Đã xác nhận</span>
                            </div>
                            
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orderDetailModal">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-info">
                                    <i class="bi bi-truck"></i>
                                </button>
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Trước</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Tiếp</a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
</div>

<!-- Order Detail Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết đơn hàng #DH23001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Thông tin khách hàng</h6>
                        <ul class="list-unstyled">
                            <li><strong>Họ tên:</strong> Nguyễn Văn A</li>
                            <li><strong>Email:</strong> nguyenvana@email.com</li>
                            <li><strong>SĐT:</strong> 0987 654 321</li>
                            <li><strong>Địa chỉ:</strong> 123 Đường ABC, Quận 1, TP.HCM</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Thông tin đơn hàng</h6>
                        <ul class="list-unstyled">
                            <li><strong>Ngày đặt:</strong> 15/05/2023 09:30</li>
                            <li><strong>Phương thức:</strong> Chuyển khoản</li>
                            <li><strong>Trạng thái:</strong> <span class="order-status status-pending">Chờ xác nhận</span></li>
                            <li><strong>Tổng tiền:</strong> <span class="text-success fw-bold">350.000đ</span></li>
                        </ul>
                    </div>
                </div>
                
                <h6>Sản phẩm đã đặt</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="80px">Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th width="100px">Đơn giá</th>
                                <th width="80px">Số lượng</th>
                                <th width="120px">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="product-img">
                                </td>
                                <td>Sách "Đắc Nhân Tâm" (Bản đặc biệt)</td>
                                <td>120.000đ</td>
                                <td>1</td>
                                <td>120.000đ</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c" class="product-img">
                                </td>
                                <td>Sách "Nhà Giả Kim" (Tái bản 2023)</td>
                                <td>115.000đ</td>
                                <td>2</td>
                                <td>230.000đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>Ghi chú từ khách hàng</h6>
                                <p class="mb-0">Giao hàng giờ hành chính, liên hệ trước khi giao</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>Tổng thanh toán</h6>
                                <div class="d-flex justify-content-between">
                                    <span>Tạm tính:</span>
                                    <span>350.000đ</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Phí vận chuyển:</span>
                                    <span>0đ</span>
                                </div>
                                <div class="d-flex justify-content-between fw-bold mt-2">
                                    <span>Tổng cộng:</span>
                                    <span class="text-success">350.000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Xác nhận đơn</button>
                <button type="button" class="btn btn-danger">Hủy đơn</button>
            </div>
        </div>
    </div>
</div>
  
@endsection