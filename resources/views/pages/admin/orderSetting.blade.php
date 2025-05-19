@extends('layouts.app', ['hideHeaderFooter' => true])

@section('title', 'Admin - Order')

@section('css')
    @vite(['resources/css/admin/orderSetting.css'])
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
                    <i class="bi bi-cart-check me-2" style="color: #FBBC05;"></i>QUẢN LÝ ĐƠN HÀNG
                </h2>
                <div>
                    <a href="{{ route('admin.exportReport') }}" class="btn btn-primary mb-3">
                        Xuất báo cáo Excel
                    </a>

                </div>
            </div>

            <!-- Filter Bar -->
            {{-- <div class="filter-bar bg-white p-3 rounded shadow-sm mb-4">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Trạng thái</label>
                        <select class="form-select" id="statusFilter">
                            <option value="all">Tất cả</option>
                            <option value="pending">Chờ xác nhận</option>
                            <option value="confirmed">Đã xác nhận</option>
                            <option value="shipping">Đang giao</option>
                            <option value="delivered">Đã giao</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Từ ngày</label>
                        <input type="date" class="form-control" id="dateFrom">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Đến ngày</label>
                        <input type="date" class="form-control" id="dateTo">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tìm kiếm</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Mã đơn, tên KH..." id="searchInput">
                            <button class="btn btn-outline-secondary" type="button" id="searchBtn">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- Order Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-success">
                        <div class="card-body">
                            <h6 class="text-muted">Tổng đơn</h6>
                            <h4 class="mb-0">{{ $stats['total'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-primary">
                        <div class="card-body">
                            <h6 class="text-muted">Chờ xác nhận</h6>
                            <h4 class="mb-0">{{ $stats['pending'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-secondary">
                        <div class="card-body">
                            <h6 class="text-muted">Đã xác nhận</h6>
                            <h4 class="mb-0">{{ $stats['conpleted'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
              
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card stat-card p-3 shadow-sm border-left-danger">
                        <div class="card-body">
                            <h6 class="text-muted">Đã hủy</h6>
                            <h4 class="mb-0">{{ $stats['cancelled'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Orders Table (Desktop) -->
            <div class="table-responsive mb-4 d-none d-md-block">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="80px">Mã đơn</th>
                            <th width="120px">Ngày đặt</th>
                            <th>Khách hàng</th>
                            <th width="150px">Sản phẩm</th>
                            <th width="120px">Tổng tiền</th>
                            <th width="150px">Trạng thái</th>
                            <th width="150px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>#{{ $order->codeVNPAY ?? 'DH' . str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $order->user->name ?? 'N/A' }}</div>
                                    <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        
                                        <span>{{ $order->items->sum('quantity') }} sản phẩm</span>
                                    </div>
                                </td>
                                <td>{{ number_format($order->total, 0, ',', '.') }}đ</td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'completed' => 'success',
                                            
                                        ];
                                        $color = $statusColors[$order->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $color }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#orderDetailModal" data-id="{{ $order->id }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                   @if ($order->status == 'pending')
                                    <form class="complete-order-form d-inline" method="POST" action="{{ url('/admin/orders/complete/' . $order->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-primary me-1 btn-complete-order">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                    <form style="display: inline-block;" class="delete-order-form" data-id="{{ $order->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Orders Cards (Mobile) -->
            <div class="row g-3 d-md-none">
                @foreach ($orders as $order)
                    <div class="col-12">
                        <div class="card order-card status-{{ $order->status }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge 
                                        @if($order->status == 'pending') bg-warning text-dark
                                        @elseif($order->status == 'confirmed') bg-success text-white
                                        @elseif($order->status == 'shipping') bg-info text-white
                                        @elseif($order->status == 'delivered') bg-primary text-white
                                        @elseif($order->status == 'cancelled') bg-danger text-white
                                        @else bg-secondary text-white
                                        @endif
                                    ">
                                        #{{ $order->codeVNPAY ?? 'DH' . str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <small class="text-muted">{{ $order->created_at->format('d/m/Y') }}</small>
                                </div>
                                <h6 class="card-title mb-1">{{ $order->user->name ?? 'N/A' }}</h6>
                                <small class="text-muted d-block mb-2">{{ $order->user->email ?? '' }}</small>

                                <div class="d-flex align-items-center mb-3">
                                    
                                    <div>
                                        <div class="fw-semibold">{{ $order->items->sum('quantity') }} sản phẩm</div>
                                        <div class="text-success fw-bold">{{ number_format($order->total, 0, ',', '.') }}đ</div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <span class="order-status status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#orderDetailModal" data-id="{{ $order->id }}">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation">
                {{ $orders->links('pagination::bootstrap-5') }}
            </nav>
            

        </main>
    </div>
</div>

<!-- Modal chi tiết đơn hàng -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" aria-labelledby="orderDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="orderDetailModalLabel">Chi tiết đơn hàng</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
      </div>
      <div class="modal-body">
        <!-- Nội dung chi tiết sẽ load ajax hoặc blade component -->
        <div id="orderDetailContent">
            <p>Đang tải...</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
    @vite(['resources/js/admin/order.js'])
@endsection
