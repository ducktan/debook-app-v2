<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RevenueSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Doanh thu từng tháng
        $revenueByMonth = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('orders.status', 'completed')
            ->select(
                DB::raw('MONTH(orders.created_at) as month'),
                DB::raw('SUM(order_items.price * order_items.quantity) as revenue')
            )
            ->groupBy(DB::raw('MONTH(orders.created_at)'))
            ->orderBy('month')
            ->get();

        // Tổng doanh thu
        $totalRevenue = $revenueByMonth->sum('revenue');

        $collection = collect();

        $collection->push(['Doanh thu tổng:', $totalRevenue]);

        $collection->push([]);

        $collection->push(['Tháng', 'Doanh thu']);

        foreach ($revenueByMonth as $row) {
            $collection->push([$row->month, $row->revenue]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return [];
    }
}
