@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - User Setting')
@section('css')
    @vite(['resources/css/admin/userSetting.css'])
@endsection


@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('pages.admin.sidebar')
        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <!-- Header -->
            @include('pages.admin.resItem')

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
                    <form action="{{ route('admin.users.show') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" name="q" placeholder="Tìm kiếm..." value="{{ request('q') }}" id="search-input">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </form>
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
                    <tbody id="user-table-body">
                        @foreach ($users as $user)
                            <tr class="user-row">
                                <td class="user-id">{{ $user->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-wrapper">
                                            <img src="{{ $user->avatar ? asset('storage/images/avatar/' . $user->avatar) : asset('assets/img/default-avt.jpg') }}" 
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
    <nav class="mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
    </nav>


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
    @vite(['resources/js/admin/user.js'])
@endsection