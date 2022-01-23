<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDataTable;
use App\Exports\OrdersMultipleExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderDelivery;
use App\Exports\OrdersExport;

use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    //前端會傳來頁數 新增Request  無條件進位 ceil()    四捨五入 round()  無條件捨去 floor()
    //offset   SQL起始點 0為始
    /* $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders.index',['orders' => $orders]);*/
    //利用with \ Transaction優化SQL 子查詢 whereHas 是否有此關聯

/*    public function index(Request $request){
        $orderCount = Order::whereHas('orderItems')->count();
        $dataPerPage =3;
        $orderPages = ceil($orderCount / $dataPerPage );
        $currentPage = isset($request->query()['page']) ? $request->query()['page'] : 1;
        $orders = Order::orderBy('created_at', 'desc')
                        ->offset($dataPerPage *($currentPage -1))
                        ->limit($dataPerPage)
                        ->whereHas('orderItems')
                        ->get();

        return view('admin.orders.index',['orders' => $orders,
                                           'orderCount' => $orderCount,
                                            'orderPages' =>$orderPages]);
    優化前}*/

    public function index(Request $request){
        $orderCount = Order::whereHas('orderItems')->count();
        $dataPerPage =5;
        $orderPages = ceil($orderCount / $dataPerPage );
        $currentPage = isset($request->query()['page']) ? $request->query()['page'] : 1;
        $orders = Order::with('user','orderItems.product')->orderBy('created_at', 'desc')
                        ->offset($dataPerPage *($currentPage -1))
                        ->limit($dataPerPage)
                        ->whereHas('orderItems')
                        ->get();

        return view('admin.orders.index',['orders' => $orders,
                                           'orderCount' => $orderCount,
                                            'orderPages' =>$orderPages]);
    }

    public function delivery($id)
    {
        $order = Order::find($id);
            if ($order->is_shipped){
                return response(['result'=>false]);
            }else{
                $order->update(['is_shipped'=>true]);

//user已內建 Notifiable
                $order->user->notify(new OrderDelivery);
                return response(['result'=>true]);
            }

    }
    public function export(){
        return Excel::download(new OrdersExport,'orders.xlsx');

    }

    public function exportByShipped(){
        return Excel::download(new OrdersMultipleExport,'orders_by_shipped.xlsx');

    }

    public function datatable(OrdersDataTable $dataTable)
    {
        return $dataTable->render('admin.orders.datatable');
    }
}
