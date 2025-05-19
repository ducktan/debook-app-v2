<?php

namespace App\Exports;

use App\Models\OrderItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderItemsSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Lấy thông tin chi tiết order item, kèm order status và ngày tạo
        $items = OrderItem::select(
            'order_items.id',
            'order_items.order_id',
            'orders.status',
            'order_items.product_id',
            'order_items.price',
            'order_items.quantity',
            'orders.created_at'
        )
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->orderBy('orders.created_at', 'desc')
        ->get();

        return $items;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Order ID',
            'Trạng thái đơn',
            'Product ID',
            'Giá',
            'Số lượng',
            'Ngày tạo đơn'
        ];
    }
}
