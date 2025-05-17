@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Quản trị - Đơn hàng')
@section('css')
    @vite(['resources/css/admin/orderSetting.css'])
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Thanh bên -->
        <nav class="col-md-3 col-lg-2 d-md d-md-block bg-white sidebar border-end p-3 min-vh-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <img src="{{ asset('IMG/Logo.png') }}" alt="logo" class="img-fluid mynav__logo">
                <button class="btn btn-sm d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center" href="./admin.html">
                        <i class="bi bi-speedometer2 text-primary"></i>
                        <span>Bảng điều khiển</span>
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
                    <a class="nav-link d-flex align-items-center active" href="{{ route('admin.order') }}">
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

        <!-- Nội dung chính -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">
                    <i class="bi bi-cart-check me-2" style="color: #FBBC05;"></i>QUẢN LÝ ĐƠN HÀNG
                </h2>
                <div>
                    <button class="btn btn-success me-2">
                        <i class="bi bi-file-earmark-excel me-1"></i> Xuất Excel
                    </button>
                    <a href="{{ route('admin.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i> Thêm đơn hàng
                    </a>
                </div>
            </div>

            <!-- Thanh lọc -->
            <div class="filter-bar bg-white p-3 rounded shadow-sm mb-4">
                <form action="{{ route('admin.order') }}" method="GET">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" id="trangThaiLoc" name="trang_thai">
                                <option value="">Tất cả</option>
                                <option value="cho_xac_nhan" {{ request('trang_thai') == 'cho_xac_nhan' ? 'selected' : '' }}>Chờ xác nhận</option>
                                <option value="da_xac_nhan" {{ request('trang_thai') == 'da_xac_nhan' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="dang_giao" {{ request('trang_thai') == 'dang_giao' ? 'selected' : '' }}>Đang giao</option>
                                <option value="da_giao" {{ request('trang_thai') == 'da_giao' ? 'selected' : '' }}>Đã giao</option>
                                <option value="da_huy" {{ request('trang_thai') == 'da_huy' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Từ ngày</label>
                            <input type="date" class="form-control" name="ngay_bat_dau" value="{{ request('ngay_bat_dau') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Đến ngày</label>
                            <input type="date" class="form-control" name="ngay_ket_thuc" value="{{ request('ngay_ket_thuc') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tìm kiếm</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="tim_kiem" placeholder="Mã đơn, mã VNPAY, tên KH..." value="{{ request('tim_kiem') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Thẻ tóm tắt đơn hàng -->
            @if (isset($don_hang) && $don_hang->count() > 0)
                <div class="row mb-4">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                        <div class="card stat-card p-3 shadow-sm border-left-success">
                            <div class="card-body">
                                <h6 class="text-muted">Tổng đơn</h6>
                                <h4 class="mb-0">{{ $don_hang->total() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                        <div class="card stat-card p-3 shadow-sm border-left-primary">
                            <div class="card-body">
                                <h6 class="text-muted">Chờ xác nhận</h6>
                                <h4 class="mb-0">{{ \App\Models\Order::where('status', 'cho_xac_nhan')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                        <div class="card stat-card p-3 shadow-sm border-left-secondary">
                            <div class="card-body">
                                <h6 class="text-muted">Đã xác nhận</h6>
                                <h4 class="mb-0">{{ \App\Models\Order::where('status', 'da_xac_nhan')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                        <div class="card stat-card p-3 shadow-sm border-left-info">
                            <div class="card-body">
                                <h6 class="text-muted">Đang giao</h6>
                                <h4 class="mb-0">{{ \App\Models\Order::where('status', 'dang_giao')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                        <div class="card stat-card p-3 shadow-sm border-left-warning">
                            <div class="card-body">
                                <h6 class="text-muted">Đã giao</h6>
                                <h4 class="mb-0">{{ \App\Models\Order::where('status', 'da_giao')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                        <div class="card stat-card p-3 shadow-sm border-left-success">
                            <div class="card-body">
                                <h6 class="text-muted">Đã hủy</h6>
                                <h4 class="mb-0">{{ \App\Models\Order::where('status', 'da_huy')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info">Hiện tại không có đơn hàng nào.</div>
            @endif

            <!-- Bảng đơn hàng (Máy tính) -->
            <div class="table-responsive mb-4 d-none d-md-block">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="80px">Mã đơn</th>
                            <th width="120px">Ngày đặt</th>
                            <th>Khách hàng</th>
                            <th width="150px">Sản phẩm</th>
                            <th width="120px">Tổng tiền</th>
                            <th width="100px">Mã VNPAY</th>
                            <th width="150px">Trạng thái</th>
                            <th width="150px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($don_hang) && $don_hang->count() > 0)
                            @foreach ($don_hang as $don)
                                <tr>
                                    <td>#DH{{ $don->id }}</td>
                                    <td>{{ $don->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $don->user->name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $don->user->email ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="product-img me-2">
                                            <span>{{ $don->items->count() }} sản phẩm</span>
                                        </div>
                                    </td>
                                    <td>{{ number_format($don->total, 0, ',', '.') }}đ</td>
                                    <td>{{ $don->codeVNPAY ?? 'N/A' }}</td>
                                    <td>
                                        <span class="trang-thai-don-hang trang-thai-{{ $don->status }}">
                                            {{ ucfirst(str_replace('_', ' ', $don->status)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#chiTietDonHangModal{{ $don->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary me-1 cap-nhat-trang-thai" data-id="{{ $don->id }}" data-trang-thai="da_xac_nhan">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                        <form action="{{ route('admin.don_hang.xoa', $don) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Không có đơn hàng nào.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Thẻ đơn hàng (Di động) -->
            <div class="row g-3 d-md-none">
                @if (isset($don_hang) && $don_hang->count() > 0)
                    @foreach ($don_hang as $don)
                        <div class="col-12">
                            <div class="card don-hang-card {{ $don->status }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <span class="badge bg-{{ $don->status == 'cho_xac_nhan' ? 'warning text-dark' : 'success text-white' }}">#DH{{ $don->id }}</span>
                                        <small class="text-muted">{{ $don->created_at->format('d/m/Y') }}</small>
                                    </div>
                                    <h6 class="card-title mb-1">{{ $don->user->name ?? 'N/A' }}</h6>
                                    <small class="text-muted d-block mb-2">{{ $don->user->email ?? 'N/A' }}</small>
                                    
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="product-img me-2">
                                        <div>
                                            <div class="fw-semibold">{{ $don->items->count() }} sản phẩm</div>
                                            <div class="text-success fw-bold">{{ number_format($don->total, 0, ',', '.') }}đ</div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="trang-thai-don-hang trang-thai-{{ $don->status }}">{{ ucfirst(str_replace('_', ' ', $don->status)) }}</span>
                                        <span>{{ $don->codeVNPAY ?? 'N/A' }}</span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-end gap-2">
                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#chiTietDonHangModal{{ $don->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-primary cap-nhat-trang-thai" data-id="{{ $don->id }}" data-trang-thai="da_xac_nhan">
                                            <i class="bi bi-check-circle"></i>
                                        </button>
                                        <form action="{{ route('admin.don_hang.xoa', $don) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="alert alert-info">Không có đơn hàng nào.</div>
                    </div>
                @endif
            </div>

            <!-- Phân trang -->
            @if (isset($don_hang) && $don_hang->count() > 0)
                <nav class="mt-4">
                    {{ $don_hang->links() }}
                </nav>
            @endif

            <!-- Modal chi tiết đơn hàng -->
            @if (isset($don_hang) && $don_hang->count() > 0)
                @foreach ($don_hang as $don)
                    <div class="modal fade" id="chiTietDonHangModal{{ $don->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Chi tiết đơn hàng #DH{{ $don->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <h6>Thông tin khách hàng</h6>
                                            <ul class="list-unstyled">
                                                <li><strong>Họ tên:</strong> {{ $don->user->name ?? 'N/A' }}</li>
                                                <li><strong>Email:</strong> {{ $don->user->email ?? 'N/A' }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Thông tin đơn hàng</h6>
                                            <ul class="list-unstyled">
                                                <li><strong>Ngày đặt:</strong> {{ $don->created_at->format('d/m/Y H:i') }}</li>
                                                <li><strong>Mã VNPAY:</strong> {{ $don->codeVNPAY ?? 'N/A' }}</li>
                                                <li><strong>Trạng thái:</strong> <span class="trang-thai-don-hang trang-thai-{{ $don->status }}">{{ ucfirst(str_replace('_', ' ', $don->status)) }}</span></li>
                                                <li><strong>Tổng tiền:</strong> <span class="text-success fw-bold">{{ number_format($don->total, 0, ',', '.') }}đ</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <h6>Sản phẩm đã đặt</h6>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="80px">Ảnh</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th width="100px">Đơn giá</th>
                                                    <th width="80px">Số lượng</th>
                                                    <th width="120px">Thành tiền</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($don->items as $item)
                                                    <tr>
                                                        <td>
                                                            <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="product-img">
                                                        </td>
                                                        <td>{{ $item->product_name }}</td>
                                                        <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                                        <td>{{ $item->quantity }}</td>
                                                        <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h6>Ghi chú</h6>
                                                    <p class="mb-0">Không có ghi chú</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card bg-light">
                                                <div class="card-body">
                                                    <h6>Tổng thanh toán</h6>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Tạm tính:</span>
                                                        <span>{{ number_format($don->total, 0, ',', '.') }}đ</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Phí vận chuyển:</span>
                                                        <span>0đ</span>
                                                    </div>
                                                    <div class="d-flex justify-content-between fw-bold mt-2">
                                                        <span>Tổng cộng:</span>
                                                        <span class="text-success">{{ number_format($don->total, 0, ',', '.') }}đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" class="btn btn-primary cap-nhat-trang-thai" data-id="{{ $don->id }}" data-trang-thai="da_xac_nhan">Xác nhận đơn</button>
                                    <button type="button" class="btn btn-danger cap-nhat-trang-thai" data-id="{{ $don->id }}" data-trang-thai="da_huy">Hủy đơn</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </main>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.cap-nhat-trang-thai').forEach(button => {
        button.addEventListener('click', function () {
            const donHangId = this.getAttribute('data-id');
            const trangThai = this.getAttribute('data-trang-thai');

            fetch(`/admin/don_hang/${donHangId}/trang_thai`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ trang_thai: trangThai })
            })
            .then(response => response.json())
            .then(data => {
                alert(data.thong_bao);
                location.reload();
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra khi cập nhật trạng thái.');
            });
        });
    });
});
</script>
@endsection