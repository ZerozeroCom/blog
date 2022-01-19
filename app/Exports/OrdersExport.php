<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class OrdersExport implements FromCollection,WithHeadings,WithColumnFormatting,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $dataCount;
    public function collection()
    {
            $orders = Order::with(['user','cart.cartItems.product'])->get();
            $orders = $orders->map(function($order){
                return [
                    $order->id,
                    $order->user->name,
                    $ab=$order->is_shipped ? '是':'否',
                    $order->cart->cartItems->sum(function($cartItem){
                    return $cartItem->product->price * $cartItem->quantity;
                }),
                Date::dateTimeToExcel($order->created_at)
                ];

            });
            $this->dataCount = $orders->count();
            return $orders;
    }

    public function headings(): array
    {
        return ['編號','購買者','是否運送','總價','建立時間'];

    }
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event){
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                for ($i=0; $i < $this ->dataCount; $i++){
                        $event->sheet->getDelegate()->getRowDimension($i)->setRowHeight(50);
                }
                $event->sheet->getDelegate()->getStyle('A1:B'.$this->dataCount)->getAlignment()->setVertical('center');
                $event->sheet->getDelegate()->getStyle('A1:A'.$this->dataCount)->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'bold' => true,
                        'italic' => true,
                        'color' => [
                            'rgb' => '00FF00'
                        ]
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => 'FF0000',
                        ],
                        'endColor' => [
                            'rgb' => '0000FF',
                        ]
                    ]
                ]);
                $event->sheet->getDelegate()->MERGEcELLS('G1:H1');
            }];
    }

}
