<?php


namespace App\Exports;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;



class ReportExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new RevenueSheet(),
            new OrderStatusSheet(),
            new OrderItemsSheet(),
        ];
    }
}
