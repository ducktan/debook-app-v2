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
                          <span>{{ Auth::user()->name }}</span>
                      </a>
                  </li>
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
      <div class="col-md-9 col-lg-10 p-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="bi bi-person-plus-fill me-2"></i>Thêm Người Dùng Mới
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Thông tin cơ bản -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên hiển thị <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" 
                                       placeholder="Ví dụ: Nguyễn Văn A" 
                                       value="{{ old('name') }}" 
                                       required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Họ và tên đầy đủ</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" 
                                       placeholder="Ví dụ: Nguyễn Văn A" 
                                       value="{{ old('full_name') }}">
                                @error('full_name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                    <!-- Email và SĐT -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       placeholder="Ví dụ: example@gmail.com" 
                                       value="{{ old('email') }}" 
                                       required>
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       placeholder="Ví dụ: 0987654321" 
                                       value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                    <!-- Loại tài khoản -->
                    <div class="mb-3">
                        <label for="utype" class="form-label">Loại tài khoản <span class="text-danger">*</span></label>
                        <select class="form-select" id="utype" name="utype" required>
                            <option value="" disabled {{ !old('utype') ? 'selected' : '' }}>-- Chọn loại tài khoản --</option>
                            <option value="ADM" {{ old('utype') == 'ADM' ? 'selected' : '' }}>Quản trị viên</option>
                            <option value="USR" {{ old('utype') == 'USR' ? 'selected' : '' }}>Người dùng thường</option>
                        </select>
                        @error('utype')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Ảnh đại diện -->
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Ảnh đại diện</label>
                        <input class="form-control" type="file" id="avatar" name="avatar" accept="image/*">
                        <div class="mt-2">
                            <img id="avatarPreview" src="{{ asset('images/default-avatar.png') }}" 
                                 class="rounded-circle border" 
                                 width="100" 
                                 height="100" 
                                 alt="Preview avatar"
                                 style="object-fit: cover;">
                        </div>
                        <div class="form-text">Chỉ chấp nhận ảnh JPG, PNG hoặc GIF. Kích thước tối đa 2MB.</div>
                        @error('avatar')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
    
                    <!-- Nút submit -->
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('admin.userSetting') }}" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-x-circle me-1"></i> Hủy bỏ
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Lưu thông tin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
  </div>
</div>
@endsection

@push('scripts')
    <script>
      $(function(){
        $("#avatar").on("change", function(e) {
    const [file] = e.target.files;
    if (file) {
        $("#avatarPreview").attr('src', URL.createObjectURL(file));
    }
    });
});
    </script>
  
@endpush
