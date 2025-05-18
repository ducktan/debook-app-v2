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
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif


            <!-- Products Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 table-striped product-table">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Ảnh</th>
                                    <th>Thông tin</th>
                                    <th>Danh mục</th>
                                    <th>Giá</th>
                                    <th>Loại</th>
                                    <th>Đánh giá</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($proItems as $product)
                                    <tr class="product-row">
                                        <td class="text-center text-nowrap fw-bold">{{ $product->id }}</td>

                                        <td class="text-center">
                                            <div class="product-img-wrapper" style="width: 60px; height: 60px;">
                                                <img src="{{ asset('storage/images/products/' . $product->image_url) }}"
                                                    class="img-fluid rounded shadow-sm hover-zoom"
                                                    style="object-fit: cover; width: 100%; height: 100%;"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-title="{{ $product->title }}">
                                            </div>
                                        </td>

                                        <td>
                                            <p class="mb-0 fw-bold text-truncate" style="max-width: 200px">{{ $product->title }}</p>
                                            <small class="text-muted d-block">{{ $product->author }}</small>
                                            <small class="text-muted">Xuất bản: {{ \Carbon\Carbon::parse($product->publication_date)->format('d/m/Y') }}</small>
                                        </td>

                                        <td>
                                            <span class="badge bg-primary-subtle text-primary fw-semibold">
                                                {{ $product->category->name ?? 'Không rõ' }}
                                            </span>
                                        </td>

                                        <td class="fw-bold text-success">
                                            {{ number_format($product->price, 0, ',', '.') }} đ
                                        </td>

                                        <td>
                                            <span class="badge bg-secondary-subtle text-secondary text-capitalize">
                                                {{ $product->type }}
                                            </span>
                                        </td>

                                        <td>
                                            @php
                                                $avg = $product->average_rating ?? 0;
                                                $count = $product->comments_count ?? 0;
                                            @endphp
                                            <div class="progress" style="height: 6px;">
                                                <div class="progress-bar bg-warning" style="width: {{ $avg * 20 }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $avg }}/5 ({{ $count }} đánh giá)</small>
                                        </td>



                                        <td class="text-nowrap">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button class="btn btn-sm btn-primary me-2 editProductBtn"
                                                    data-id="{{ $product->id }}"
                                                    data-title="{{ $product->title }}"
                                                    data-author="{{ $product->author }}"
                                                    data-type="{{ $product->type }}"
                                                    data-category_id="{{ $product->category_id }}"
                                                    data-publication_date="{{ $product->publication_date }}"
                                                    data-price="{{ $product->price }}"
                                                    data-duration="{{ $product->duration }}"
                                                    data-language="{{ $product->language }}"
                                                    data-description="{{ $product->description }}"
                                                    data-image_url="{{ $product->image_url }}"
                                                    data-file_url="{{ $product->file_url }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editProductModal"
                                                >
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <form class="delete-product-form" action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                   
                                                    <button type="submit" class="btn btn-danger btn-sm delete-product-btn" data-name="{{ $product->title }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <button class="btn btn-sm btn-outline-info btn-view"
                                                        data-id="{{ $product->id }}"
                                                        data-type="{{ $product->type }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- Pagination -->
           <nav class="mt-4">
                {{ $proItems->links('pagination::bootstrap-5') }}
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
                <form id="addProductForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Tiêu đề sách</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tác giả</label>
                            <input type="text" class="form-control" name="author" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Thể loại</label>
                            <select class="form-control" name="type">
                                <option value="ebook">Ebook</option>
                                <option value="podcast">Podcast</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Danh mục</label>
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày phát hành</label>
                            <input type="date" class="form-control" name="publication_date">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Giá</label>
                            <input type="number" step="0.01" class="form-control" name="price" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Thời lượng (phút)</label>
                            <input type="number" class="form-control" name="duration">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngôn ngữ</label>
                            <select class="form-control" name="language">
                                <option value="vi">Tiếng Việt</option>
                                <option value="en">Tiếng Anh</option>
                                <option value="fr">Tiếng Pháp</option>
                                <option value="jp">Tiếng Nhật</option>
                                <option value="kr">Tiếng Hàn</option>
                                <option value="cn">Tiếng Trung</option>
                                <option value="es">Tiếng Tây Ban Nha</option>
                                <option value="de">Tiếng Đức</option>   
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">File sách (PDF, MP3...)</label>
                            <input type="file" class="form-control" name="file">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ảnh bìa</label>
                            <input type="file" class="form-control" name="image">
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- Edit --}}
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editProductForm" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_product_id" name="id">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="edit_title" class="form-label">Tiêu đề sách</label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_author" class="form-label">Tác giả</label>
                        <input type="text" class="form-control" id="edit_author" name="author" required>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_type" class="form-label">Thể loại</label>
                        <select class="form-control" id="edit_type" name="type">
                            <option value="">-- Chọn thể loại --</option>
                            <option value="ebook">Ebook</option>
                            <option value="podcast">Podcast</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_category_id" class="form-label">Danh mục</label>
                        <select class="form-control" id="edit_category_id" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_publication_date" class="form-label">Ngày phát hành</label>
                        <input type="date" class="form-control" id="edit_publication_date" name="publication_date">
                    </div>

                    <div class="col-md-6">
                        <label for="edit_price" class="form-label">Giá</label>
                        <input type="number" step="0.01" class="form-control" id="edit_price" name="price" required>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_duration" class="form-label">Thời lượng (phút)</label>
                        <input type="number" class="form-control" id="edit_duration" name="duration">
                    </div>

                    <div class="col-md-6">
                        <label for="edit_language" class="form-label">Ngôn ngữ</label>
                        <select class="form-control" id="edit_language" name="language">
                            <option value="">-- Chọn ngôn ngữ --</option>
                            <option value="vi">Tiếng Việt</option>
                            <option value="en">Tiếng Anh</option>
                            <option value="fr">Tiếng Pháp</option>
                            <option value="jp">Tiếng Nhật</option>
                            <option value="kr">Tiếng Hàn</option>
                            <option value="cn">Tiếng Trung</option>
                            <option value="es">Tiếng Tây Ban Nha</option>
                            <option value="de">Tiếng Đức</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="edit_description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_file" class="form-label">File sách (PDF, MP3...)</label>
                        <input type="file" class="form-control" id="edit_file" name="file" accept=".pdf,.mp3,.doc,.docx,.txt">
                        <small class="form-text text-muted" id="current_file_name"></small>
                    </div>

                    <div class="col-md-6">
                        <label for="edit_image" class="form-label">Ảnh bìa</label>
                        <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                        <div class="mt-2">
                            <img id="current_product_image" src="" alt="Ảnh bìa hiện tại" class="img-thumbnail" width="100" style="display:none;">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-view').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');

            if (!productId || !type) return;

            // Xác định đường dẫn theo loại
            let url = '';
            if (type === 'ebook') {
                url = `/products/${productId}/read`;
            } else if (type === 'podcast') {
                url = `/products/${productId}/listen`;
            } else {
                alert('Loại sản phẩm không hợp lệ.');
                return;
            }

            // Điều hướng
            window.location.href = url;
        });
    });
});


</script>
  
@endsection

@section('js')
    @vite(['resources/js/admin/productAd.js'])
@endsection

