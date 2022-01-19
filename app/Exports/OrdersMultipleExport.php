<?php

namespace App\Exports;

use App\Exports\sheets\OrderByShippedSheet;
use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class OrdersMultipleExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function sheets(): array
    {
        $sheets = [];

        foreach ([true, false] as $isShipped){
            $sheets[] = new OrderByShippedSheet($isShipped);
        }

        return $sheets;
    }
}
