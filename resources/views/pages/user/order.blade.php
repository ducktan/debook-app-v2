@extends('layouts.app')

@section('title', 'Debook - Quản lý đơn hàng')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">ĐƠN HÀNG CỦA BẠN</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">Bạn chưa có đơn hàng nào.</div>
    @else
        <div class="accordion" id="orderAccordion">
            @foreach($orders as $index => $order)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $index }}">
                        <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $index }}"
                            aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-controls="collapse{{ $index }}">
                            Đơn hàng #{{ $order->codeVNPAY }} - {{ $order->created_at->format('d/m/Y') }}
                            <span class="ms-2 badge {{ $order->status === 'completed' ? 'bg-success' : 'bg-danger' }}">
                                {{ $order->status === 'completed' ? 'Hoàn tất' : 'Thất bại' }}
                            </span>
                        </button>
                    </h2>
                    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                        aria-labelledby="heading{{ $index }}" data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            @if($order->items->isEmpty())
                                <p>Không có sản phẩm nào. Đơn hàng này có thể đã bị huỷ hoặc lỗi thanh toán.</p>
                            @else
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total = 0; @endphp
                                        @foreach($order->items as $item)
                                            @php
                                                $lineTotal = $item->price * $item->quantity;
                                                $total += $lineTotal;
                                            @endphp
                                            <tr>
                                                <td>{{ $item->product->title ?? '[Không tìm thấy sản phẩm]' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                                                <td>{{ number_format($lineTotal, 0, ',', '.') }}₫</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p class="text-end"><strong>Tổng cộng:</strong> {{ number_format($total, 0, ',', '.') }}₫</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
