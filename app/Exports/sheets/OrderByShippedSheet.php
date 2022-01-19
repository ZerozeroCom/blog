<?php

namespace App\Exports\sheets;

use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class OrderByShippedSheet implements FromCollection,WithHeadings,WithTitle
{
    public $isShipped;
    public function __construct($isShipped)
    {
            $this->isShipped = $isShipped;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data =Order::all();
        return Order::where('is_shipped', $this->isShipped)->get();
    }

    public function headings(): array
    {
        return Schema::getColumnListing('orders');

    }
    public function title(): string
    {
        return $this->isShipped ? '已運送':'尚未運送';
    }
}
