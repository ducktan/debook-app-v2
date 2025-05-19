@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - Category Management')

@section('css')
    @vite(['resources/css/admin/userSetting.css'])
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('pages.admin.sidebar') <!-- Tái sử dụng sidebar từ giao diện người dùng -->

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <!-- Header -->
            @include('pages.admin.resItem')
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-tags-fill me-2 text-success"></i>QUẢN LÝ DANH MỤC
                </h2>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus-lg me-2"></i>Thêm danh mục
                </button>
            </div>
            
            <!-- Filter Bar -->
            

            <!-- Categories Table -->
            <div class="card shadow-sm border-0 mb-5">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên danh mục</th>
                                    <th>Slug</th>
                                    <th>Mô tả</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="category-table-body">
                                @foreach ($cateItem as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            @if($category->image_url)
                                                <img src="{{ asset('storage/images/categories/' . $category->image_url) }}" alt="{{ $category->name }}" class="img-thumbnail" width="60">
                                            @else
                                                <span class="text-muted">Không có ảnh</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ Str::limit($category->description, 50) }}</td>
                                        <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-sm btn-primary me-2 editCategoryBtn"
                                                        data-id="{{ $category->id }}"
                                                        data-name="{{ $category->name }}"
                                                        data-slug="{{ $category->slug }}"
                                                        data-description="{{ $category->description }}"
                                                        data-image="{{ $category->image_url }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                               <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="delete-category-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm delete-category-btn"
                                                            data-id="{{ $category->id }}"
                                                            data-name="{{ $category->name }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                                            
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
                {{ $cateItem->links('pagination::bootstrap-5') }}
            </nav>
        </main>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data" class="modal-content" id="addCategoryForm">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Thêm danh mục mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="category_name" class="form-label">ID</label>
                    <input type="text" class="form-control" id="category_id" name="id" readonly>
                </div>
                <!-- Name -->
                <div class="mb-3">
                    <label for="category_name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="category_name" name="name" required>
                </div>
                <!-- Slug -->
                <div class="mb-3">
                    <label for="category_slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="category_slug" name="slug">
                </div>
                <!-- Description -->
                <div class="mb-3">
                    <label for="category_description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="category_description" name="description" rows="3"></textarea>
                </div>
                <!-- Image -->
                <div class="mb-3">
                    <label for="category_image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="category_image" name="image" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-success">Thêm mới</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editCategoryForm" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_category_id" name="id">
                <!-- Name -->
                <div class="mb-3">
                    <label for="edit_category_name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="edit_category_name" name="name" required>
                </div>
                <!-- Slug -->
                <div class="mb-3">
                    <label for="edit_category_slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="edit_category_slug" name="slug">
                </div>
                <!-- Description -->
                <div class="mb-3">
                    <label for="edit_category_description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="edit_category_description" name="description" rows="3"></textarea>
                </div>
                <!-- Image -->
                <div class="mb-3">
                    <label for="edit_category_image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="edit_category_image" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <img id="current_category_image" src="" alt="Hình ảnh hiện tại" class="img-thumbnail" width="100">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    @vite(['resources/js/admin/category.js'])
@endsection
