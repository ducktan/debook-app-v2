<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderStatusSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        $statusCounts = DB::table('orders')
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        $collection = collect();

        $collection->push(['Trạng thái đơn hàng', 'Số lượng']);

        foreach ($statusCounts as $row) {
            $collection->push([$row->status, $row->count]);
        }

        return $collection;
    }

    public function headings(): array
    {
        return [];
    }
}
