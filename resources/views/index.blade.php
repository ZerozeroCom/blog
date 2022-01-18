@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/try.css">



<h2>商品</h2>
    {{--上面為導覽列 但應該避免重複撰寫// 配合資料庫資料的表格 $products 自controller--}}
<table>
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>價格</td>
            <td></td>
        </tr>
    </thead>


    <tbody>
        @foreach ($products as $product)
            <tr>
                @if ($product->id == 1)
                    <td class="special-text">{{ $product ->title }}</td>
                @else
                    <td>{{ $product ->title }}</td>
                @endif
                <td>{{ $product ->content }}</td>
                <td style = {{ $product ->price < 200 ? 'color:red;' : ''}}>{{ $product ->price }}</td>
                <td><input class="check_product" type="button" value="確認商品數量" data-id="{{$product->id}}"></td>
                <td><input class="share_product" type="button" value="分享商品" data-id="{{$product->id}}"></td>
            </tr>
        @endforeach
    </tbody>
</table>
<form action="">
    <input type="text">
    <input type="file">
    <select>
            <option>1</option>
            <option>2</option>
    </select>
    <button>click</button>
</form>
<a href="https://www.google.com">google</a>
<img src="https://imgcdn.cna.com.tw/www/WebPhotos/1024/20220104/960x640_257159241392.jpg" alt="">
<iframe width="560" height="315" src="https://www.youtube.com/embed/DjxxZ_sEWjo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
{{--    alert('123');  確認是否有正確綁定--}}
<script>
    $('.check_product').on('click',function(){
            $.ajax({
                method: 'POST',
                url: '/products/check-product',
                data: {id: $(this).data('id')}
            })
            .done(function(response){
                if(response){
                    alert('商品數量充足')
                }else{
                    alert('商品數量不足')
                }
            })
    })

    $('.share_product').on('click',function(){
        var id = $(this).data('id');
            $.ajax({
                method: 'GET',
                url: `/products/${id}/shared-url`,
            })
            .done(function(msg){
                    alert('請複製此連結'+msg.url)
            })
    })
</script>

@endsection
