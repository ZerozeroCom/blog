<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\DataTable as NewDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('action',function ($model){
                $html = '<a class="btn btn-success" href="'.$model->id.'">查看</a>';
                return $html;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->orderBy(0,'desc')
                    ->parameters([
                        'pageLength' => 20,
                        'language' => config('datatables.i18n.tw')
                    ])

                    ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            new Column([
                'title' => '是否運送',
                'data' => 'is_shipped',
                'attributes' =>[
                    'data-try' => 'test data'
                ]
            ]),
            Column::make('user_id'),
            Column::make('created_at'),
            Column::make('updated_at'),
            new Column([
                'title' => '功能',
                'data' => 'action',
                'searchable' =>false,
                'orderable'=>false
            ]),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Orders_' . date('YmdHis');
    }
}
