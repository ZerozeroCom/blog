{{--監控每一步的語法@php
    use Illuminate\Support\Facades\DB;
@endphp
{{DB::enableQueryLog()}}

{{dd(DB::getQueryLog())}}
--}}
@extends('layouts.admin_app')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">後臺訂單列表</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
<div class="row">
    <span>訂單總數:{{ $orderCount}} </span>
    <a href="/admin/orders/excel/export">匯出訂單excel</a>
    <a href="/admin/orders/excel/export-by-shipped">匯出分類訂單excel</a>
    <table class="table">
    <thead>
        <tr>
            <td>購買時間</td>
            <td>購買者</td>
            <td>商品清單</td>
            <td>訂單總額</td>
            <td>是否運送</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{$order ->created_at}}</td>
            {{--order Models 內有user方法取得user--}}
            <td>{{$order ->user->name}}</td>
            <td>
                @foreach ($order->orderItems as $orderItem)
                    {{$orderItem->product->title }} &nbsp;
                @endforeach
            </td>
            <td>{{ isset($order->orderItems) ? $order->orderItems->sum('price') : 0}}</td>
            <td>{{$order->is_shipped}}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <div>
        @for ($i = 1; $i <= $orderPages; $i++)
            <a href="/admin/orders?page={{ $i }}">第{{$i}}頁</a> &nbsp;
        @endfor
    </div>
</div>
@endsection
