@extends('layouts.master', ['hideHeaderFooter' => true])

@section('title', 'Admin - Payment')
@section('css')
    @vite(['resources/css/admin/paymentSetting.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block d-none bg-white sidebar border-end p-3 min-vh-100">
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
                    <a class="nav-link d-flex align-items-center" href="./orderManagement.html">
                        <i class="bi bi-cart-check text-danger"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" href="./paymentManagement.html">
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

            <!-- Header -->
            <div class="header__fix mb-4">
                <h2 class="fw-bold">
                    <i class="bi bi-credit-card me-2" style="color: #FBBC05;"></i>QUẢN LÝ THANH TOÁN
                </h2>
                <div>
                    <button class="btn btn-outline-success me-2 fix__button">
                        <i class="bi bi-download me-2"></i>Xuất Excel
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle fix__button" data-bs-toggle="dropdown">
                            <i class="bi bi-plus-lg me-2"></i>Thao tác
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Thêm giao dịch thủ công</a></li>
                            <li><a class="dropdown-item" href="#">Hoàn tiền</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Cấu hình thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4 g-4">
                <div class="col-md-3">
                    <div class="card summary-card border-start-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="text-muted">Doanh thu hôm nay</h6>
                                    <h3 class="mb-0">8.250.000đ</h3>
                                </div>
                                <i class="bi bi-currency-exchange fs-1 text-primary opacity-25"></i>
                            </div>
                            <span class="badge bg-success bg-opacity-10 text-success mt-2">
                                <i class="bi bi-arrow-up"></i> 12% so với hôm qua
                            </span>
                        </div>
                    </div>
                </div>
                <!-- Thêm các card khác -->
            </div>

            <!-- Filter Bar -->
            <div class="card shadow-sm mb-4">
                <div class="card-body py-3">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Mã giao dịch...">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option selected>Phương thức</option>
                                <option>VNPay</option>
                                <option>Momo</option>
                                <option>Tiền mặt</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option selected>Trạng thái</option>
                                <option>Thành công</option>
                                <option>Thất bại</option>
                                <option>Đang xử lý</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">
                                <i class="bi bi-funnel me-1"></i> Lọc
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payments Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 payment-table">
                            <thead class="table-light">
                                <tr>
                                    <th width="120">Mã GD</th>
                                    <th>Khách hàng</th>
                                    <th width="150">Đơn hàng</th>
                                    <th width="150">Phương thức</th>
                                    <th width="120">Số tiền</th>
                                    <th width="150">Thời gian</th>
                                    <th width="120">Trạng thái</th>
                                    <th width="100">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="payment-row">
                                    <td>
                                        <span class="badge bg-light text-dark font-monospace">PAY-2305-001</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://i.pravatar.cc/40?img=5" class="rounded-circle me-2">
                                            <div>
                                                <p class="mb-0 fw-bold">Nguyễn Văn A</p>
                                                <small class="text-muted">nguyenvana@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="text-primary">ORD-2305-001</a>
                                        <small class="d-block text-muted">3 sản phẩm</small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="/IMG/vnpaylogo.png" width="24" class="me-2">
                                            <span>VNPay</span>
                                        </div>
                                    </td>
                                    <td class="fw-bold text-success">350.000đ</td>
                                    <td>
                                        15/05/2023
                                        <small class="d-block text-muted">14:30:25</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="bi bi-check-circle me-1"></i> Thành công
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentDetailModal">
                                            Chi tiết
                                        </button>
                                    </td>
                                </tr>
                                <!-- Thêm các giao dịch khác -->
                            </tbody>
                        </table>
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
                    <li class="page-item">
                        <a class="page-link" href="#">Sau</a>
                    </li>
                </ul>
            </nav>
        </main>
    </div>
</div>

<!-- Payment Detail Modal -->
<div class="modal fade" id="paymentDetailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết giao dịch #PAY-2305-001</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Thông tin giao dịch</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="40%">Mã giao dịch:</th>
                                        <td>PAY-2305-001</td>
                                    </tr>
                                    <tr>
                                        <th>Phương thức:</th>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                                <img src="/IMG/vnpaylogo.png" width="16" class="me-1">
                                                VNPay
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số tiền:</th>
                                        <td class="fw-bold text-success">350.000đ</td>
                                    </tr>
                                    <tr>
                                        <th>Phí giao dịch:</th>
                                        <td class="text-muted">3.500đ</td>
                                    </tr>
                                    <tr>
                                        <th>Thời gian:</th>
                                        <td>15/05/2023 14:30:25</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Thông tin đơn hàng</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="40%">Mã đơn hàng:</th>
                                        <td><a href="#" class="text-primary">ORD-2305-001</a></td>
                                    </tr>
                                    <tr>
                                        <th>Khách hàng:</th>
                                        <td>Nguyễn Văn A (nguyenvana@email.com)</td>
                                    </tr>
                                    <tr>
                                        <th>Sản phẩm:</th>
                                        <td>3 sản phẩm</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền:</th>
                                        <td class="fw-bold">350.000đ</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger">Hoàn tiền</button>
                <button type="button" class="btn btn-primary">In hóa đơn</button>
            </div>
        </div>
    </div>
</div>
  
@endsection