@extends('layouts.master', ['hideHeaderFooter' => true])

@section('title', 'Admin - Product')
@section('css')
    @vite(['resources/css/admin/productSetting.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-none d-md-block bg-white sidebar border-end p-3 min-vh-100">
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
                        <span>người dùng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./authorManagement.html">
                        <i class="bi bi-person-badge-fill text-success"></i>
                        <span>Tác giả</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" href="./productManagement.html">
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-box-seam me-2" style="color: #4285F4;"></i>QUẢN LÝ SẢN PHẨM
                </h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-lg me-2"></i>Thêm sản phẩm
                </button>
            </div>

            <!-- Filter Bar -->
            <div class="row mb-4 g-3">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control product-search" placeholder="Tìm theo tên, mã SP...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option selected>Danh mục</option>
                        <option>Sách văn học</option>
                        <option>Sách khoa học</option>
                        <option>Sách thiếu nhi</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option selected>Trạng thái</option>
                        <option>Còn hàng</option>
                        <option>Hết hàng</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100">
                        <i class="bi bi-funnel"></i> Lọc
                    </button>
                </div>
            </div>

            <!-- Products Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 product-table">
                            <thead class="table-light">
                                <tr>
                                    <th width="80">Ảnh</th>
                                    <th>Thông tin</th>
                                    <th>Danh mục</th>
                                    <th width="120">Giá</th>
                                    <th width="100">Tồn kho</th>
                                    <th width="120">Trạng thái</th>
                                    <th width="120">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="product-row">
                                    <td>
                                        <div class="product-img-wrapper">
                                            <img src="https://m.media-amazon.com/images/I/71kxa1-0mfL._AC_UF1000,1000_QL80_.jpg" 
                                                 class="product-img hover-zoom"
                                                 data-bs-toggle="tooltip" 
                                                 data-bs-title="Xem chi tiết">
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="mb-0 fw-bold">Nhà giả kim</p>
                                            <small class="text-muted d-block">SP-001 | Paulo Coelho</small>
                                            <small class="text-muted">Xuất bản: 2020</small>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary">Văn học</span></td>
                                    <td class="fw-bold text-success">89.000đ</td>
                                    <td>
                                        <div class="progress" style="height: 6px;">
                                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                                        </div>
                                        <small>65/100</small>
                                    </td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success">Đang bán</span></td>
                                    <td>
                                        <div class="d-flex action-buttons">
                                            <button class="btn-action btn-edit me-1">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn-action btn-delete me-1">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button class="btn-action btn-view">
                                                <i class="bi bi-eye"></i>
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

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm sản phẩm mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form sẽ được thêm vào đây -->
            </div>
        </div>
    </div>
</div>
  

<!-- Filters -->
<form id="filter-form">
    <div class="mb-4">
        <h6 class="text-muted mb-3">Giá</h6>
        <div class="form-check">
            <input class="form-check-input price-filter" type="radio" name="price_range" 
                   id="price_all" value="" checked>
            <label class="form-check-label" for="price_all">Tất cả</label>
        </div>
        <div class="form-check">
            <input class="form-check-input price-filter" type="radio" name="price_range" 
                   id="price1" value="under_50k">
            <label class="form-check-label" for="price1">Dưới 50.000đ</label>
        </div>
        <!-- Các option giá khác -->
    </div>
    
    <div class="mb-4">
        <h6 class="text-muted mb-3">Định dạng</h6>
        @foreach(['ebook', 'audiobook', 'podcast', 'blog'] as $format)
        <div class="form-check">
            <input class="form-check-input format-filter" type="checkbox" 
                   name="format[]" id="{{ $format }}" value="{{ $format }}">
            <label class="form-check-label" for="{{ $format }}">
                {{ ucfirst($format) }}
            </label>
        </div>
        @endforeach
    </div>
</form>

<!-- Sort -->
<select class="form-select w-auto" id="sort-select">
    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Phổ biến nhất</option>
    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá tăng dần</option>
    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá giảm dần</option>
</select>

@endsection