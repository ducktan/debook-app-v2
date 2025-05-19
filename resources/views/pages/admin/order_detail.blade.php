<div>
    <h5>Thông tin khách hàng</h5>
    <p><strong>Khách hàng:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
    <p><strong>Mã đơn:</strong> {{ $order->codeVNPAY ?? 'DH' . str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
    <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    <hr>

    <h5>Chi tiết sản phẩm</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->title ?? 'Sản phẩm không xác định' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="text-end">Tổng tiền: <strong>{{ number_format($order->total, 0, ',', '.') }}đ</strong></h5>
</div>
