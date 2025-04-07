@extends('layouts.master', ['hideHeaderFooter' => true])

@section('title', 'Admin - User Setting')
@section('css')
    @vite(['resources/css/admin/userSetting.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 bg-white sidebar border-end p-3 min-vh-100 d-none d-md-block">
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
                    <a class="nav-link d-flex align-items-center active" href="./userManagement.html">
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
                    <i class="bi bi-people-fill me-2" style="color: #FBBC05;"></i>QUẢN LÝ NGƯỜI DÙNG
                </h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="bi bi-plus-lg me-2"></i>Thêm người dùng
                </button>
            </div>

            <!-- Filter Bar -->
            <div class="row mb-4 g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                        <button class="btn btn-outline-secondary" type="button">Lọc</button>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Loại người dùng</option>
                        <option>Admin</option>
                        <option>Biên tập viên</option>
                        <option>Người dùng thường</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Trạng thái</option>
                        <option>Đang hoạt động</option>
                        <option>Đã khóa</option>
                    </select>
                </div>
            </div>

            <!-- Users Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th width="50">ID</th>
                                    <th>Thông tin</th>
                                    <th>Loại tài khoản</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th width="120">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="user-row">
                                    <td class="user-id">1001</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar-wrapper">
                                                <img src="https://i.pravatar.cc/40?img=1" 
                                                     class="rounded-circle me-2 hover-glow"
                                                     data-bs-toggle="tooltip" 
                                                     data-bs-title="Xem hồ sơ">
                                                <span class="online-status-pulse bg-success"></span>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-bold text-gradient">Nguyễn Văn A</p>
                                                <small class="text-muted email-hover">nguyenvana@email.com</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary floating-badge">
                                            <i class="bi bi-star-fill me-1"></i>Admin
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-10 text-success status-badge">
                                            <span class="status-dot"></span> Active
                                        </span>
                                    </td>
                                    <td class="join-date">15/05/2023</td>
                                    <td>
                                        <div class="d-flex action-buttons">
                                            <button class="btn-action btn-edit me-1" 
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-title="Chỉnh sửa">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action btn-delete"
                                                    data-bs-toggle="tooltip" 
                                                    data-bs-title="Xóa">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Thêm các dòng khác -->
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm người dùng mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form sẽ được thêm vào đây -->
            </div>
        </div>
    </div>
</div>
  
@endsection