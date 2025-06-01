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
                    <a class="nav-link d-flex align-items-center " href="{{route('admin.index')}}">
                        <i class="fa-solid fa-inbox text-primary"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center active" href="{{route('admin.userSetting')}}">
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
                    <a class="nav-link d-flex align-items-center" href="{{route('admin.products')}}">
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
                        <a class="nav-link d-flex align-items-center" href="./contentManagement.html">
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
                        <a class="nav-link d-flex align-items-center" href="{{route('admin.productSetting')}}">
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
                <a class="btn btn-primary" href="{{route('admin.user.add')}}">
                    <i class="bi bi-plus-lg me-2"></i>Thêm người dùng
                </a>
            </div>

            <!-- Filter Bar -->
            <div class="row mb-4 g-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <form action="{{ route('admin.userSetting') }}" method="GET" class="row g-2 mb-3">
                            <div class="col-md-4">
                                <input type="text" name="keyword" class="form-control" placeholder="Tìm tên, email, họ tên..."
                                       value="{{ request('keyword') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="utype" class="form-control">
                                    <option value="">-- Tất cả loại tài khoản --</option>
                                    <option value="ADM" {{ request('utype') == 'ADM' ? 'selected' : '' }}>Quản trị (ADM)</option>
                                    <option value="USR" {{ request('utype') == 'USR' ? 'selected' : '' }}>Người dùng (USR)</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Lọc</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>

            <!-- Users Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        @if(Session::has('status'))
                            <p class="alert alert-success">{{Session::get('status')}}</p>
                        @endif
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
                                @foreach ($users as $user )
                                <tr class="user-row">
                                    <td class="user-id">{{$user->id}}</td>
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
                                                <p class="mb-0 fw-bold text-gradient">{{$user->name}}</p>
                                                <small class="text-muted email-hover">{{$user->email}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $user->utype === 'ADM' ? 'primary' : 'secondary' }} bg-opacity-10 text-{{ $user->utype === 'ADM' ? 'primary' : 'secondary' }} floating-badge">
                                            <i class="bi bi-{{ $user->utype === 'ADM' ? 'star-fill' : 'person' }} me-1"></i>
                                            {{ $user->utype === 'ADM' ? 'Admin' : 'User' }}
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
                                            <a href="{{route('admin.user.edit',['id'=>$user->id])}}">sua</a>
                                            <a href="{{ route('admin.user.delete', $user->id) }}" 
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?')" 
                                                class="btn btn-danger btn-sm">Xóa</a>
                                             
                                        </div>
                                    </td>
                                </tr>
                                <!-- Thêm các dòng khác -->
                                @endforeach 
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