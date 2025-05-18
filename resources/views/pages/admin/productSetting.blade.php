@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - Product')
@section('css')
    @vite(['resources/css/admin/productSetting.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('pages.admin.sidebar') 

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @include('pages.admin.resItem')

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
            {{-- <div class="row mb-4 g-3">
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
            </div> --}}

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
  
@endsection