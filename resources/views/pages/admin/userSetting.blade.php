@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - User Setting')
@section('css')
    @vite(['resources/css/admin/userSetting.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
         <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar border-end p-3 min-vh-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="{{ asset ('assets/img/Logo.png')}}" alt="logo" class="img-fluid mynav__logo">
                <button class="btn btn-sm d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" href="{{ route('admin.index') }}">
                        <i class="fa-solid fa-inbox text-primary"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="{{ route('admin.users.show') }}">
                        <i class="fa-solid fa-user text-warning"></i>
                        <span>Người dùng</span>
                      
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./authorManagement.html">
                        <i class="fa-solid fa-feather text-success"></i>
                        <span>Tác giả</span>
                       
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./productManagement.html">
                        <i class="fa-solid fa-gift text-info"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./orderManagement.html">
                        <i class="fa-solid fa-truck-fast text-danger"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./paymentManagement.html">
                        <i class="fa-solid fa-cart-shopping text-secondary"></i>
                        <span>Thanh toán</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./contentManagement.html">
                        <i class="fa-solid fa-font text-dark"></i>
                        <span>Nội dung</span>
                    </a>
                </li>
                @auth 
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="#">
                            <i class="fa-solid fa-user text-dark"></i>
                            <span>{{Auth::user()->name}}</span>
                        </a>
                    </li>
                    <!-- Thêm nút đăng xuất -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="border: none; background: none; color: inherit;">Đăng xuất</button>
                        </form>
                    </li>
                    
                @endauth
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
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">ID</th>
                            <th>Thông tin</th>
                            <th>Loại tài khoản</th>
                            <th>Email khách hàng</th>
                            <th>Ngày tạo</th>
                            <th width="120">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="user-row">
                                <td class="user-id">{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-wrapper">
                                            <img src="{{ $user->avatar ? asset('assets/img/avatars/' . $user->avatar) : asset('assets/img/default-avt.jpg') }}" 
                                                class="rounded-circle me-2 hover-glow"
                                                data-bs-toggle="tooltip" 
                                                title="{{ $user->full_name }}">
                                            <span class="online-status-pulse bg-success"></span>
                                        </div>
                                        <div>
                                            <p class="mb-0 fw-bold text-gradient">{{ $user->full_name }}</p>
                                            <small class="text-muted email-hover">{{ $user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $define = [
                                            'ADM' => 'Admin',
                                            'USR' => 'Khách',
                                            'VIP' => 'Khách VIP',
                                        ];
                                    @endphp
                                    <span class="badge bg-primary bg-opacity-10 text-primary floating-badge">
                                        <i class="bi bi-star-fill me-1"></i>{{ $define[$user->utype] ?? ucfirst($user->utype) }}
                                    </span>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td class="join-date">{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex action-buttons">
                                       <button class="btn btn-primary btn-action btn-edit me-1 editUserBtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-fullname="{{ $user->full_name }}"
                                                data-email="{{ $user->email }}"
                                                data-phone="{{ $user->phone }}"
                                                data-utype="{{ $user->utype }}"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        

                                        <form class="delete-user-form" data-id="{{ $user->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" data-bs-toggle="tooltip" title="Xoá">
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
    {{-- Update Modal --}}

<div class="collapse" id="collapseExample">
  <div class="card card-body">
        <form id="editUserForm" enctype="multipart/form-data" action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Chỉnh sửa người dùng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
            
                <input type="hidden" name="id" id="edit_user_id">

                
                <div class="mb-3">
                    <label for="edit_name" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="edit_name" name="name" required>
                </div>

            
                <div class="mb-3">
                    <label for="edit_full_name" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" id="edit_full_name" name="full_name" required>
                </div>

            
                <div class="mb-3">
                    <label for="edit_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="edit_email" name="email" required>
                </div>

            
                <div class="mb-3">
                    <label for="edit_phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="edit_phone" name="phone">
                </div>

            
                <div class="mb-3">
                    <label for="edit_utype" class="form-label">Loại tài khoản</label>
                    <select class="form-select" id="edit_utype" name="utype" required>
                    <option value="USR">Khách</option>
                    <option value="VIP">Khách VIP</option>
                    <option value="ADM">Admin</option>
                    </select>
                </div>

            
                <div class="mb-3">
                    <label for="edit_avatar" class="form-label">Ảnh đại diện</label>
                    <input type="file" class="form-control" id="edit_avatar" name="avatar" accept="image/*">
                </div>
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </div>
        </form>
  </div>
</div>




<!-- Phân trang -->
    @if ($users->hasPages())
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-3">
                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>

                @for ($i = 1; $i <= $users->lastPage(); $i++)
                    <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a>
                </li>
            </ul>
        </nav>
    @endif


        </main>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data" class="modal-content" id="addUserForm">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Thêm người dùng mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

            
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <!-- Utype -->
                <div class="mb-3">
                    <label for="utype" class="form-label">Loại tài khoản</label>
                    <select class="form-select" id="utype" name="utype" required>
                        <option value="">-- Chọn loại tài khoản --</option>
                        <option value="ADM">Admin</option>
                        <option value="USR">Khách</option>
                        <option value="VIP">Khách VIP</option>
                    </select>
                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </div>
        </form>
    </div>
</div>

















  
@endsection

@section('js')
    @vite(['resources/js/user.js'])
@endsection