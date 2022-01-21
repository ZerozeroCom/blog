{{--推薦練習時使用的寫法 在chrome右鍵 點擊檢查 點擊選擇 點選頁面元素--}}
@extends('layouts.app')
@section('content')
<style>
.table plate *{
    background-color: blue
}
.table2 bento ~ pickle{
    background-color: red
}
    h2{
        font-size: 30px;
    }
</style>

<h3>聯絡我們</h3>


<form class ="w-50" action="">
    <div class="form-group">
        <label>請問你是: </label>
        <input name="name" type="text"><br>
        <label>請問你的消費時間:</label>
        <input name="date"type="date"><br>
        <label>你消費的商品種類:</label>
            <select name="product" id="">
                <option value="物品">物品</option>
                <option value="物品">食物</option>
            </select><br>
        <label>回饋資訊:</label>
        <input name ="text" type="text"><br>
        <button>送出</button><br>
    </div>
</form>


<div class="table">
    <plate id="fancy">
        123
    <orange class="small" />121
    </plate>
    <plate>121
    <pickle />666
    </plate>121
    <apple class="small" />33
    <plate>212
    <apple />2312
    </plate>
</div>

<div class="table2">
    <pickle> PPP</pickle>
    <bento>
        <orange class="small">ooo </orange>
    </bento>
    <pickle class="small" > ppp</pickle>
    <pickle> PPP</pickle>
    <plate>
        <pickle> PPP</pickle>
    </plate>
    <plate>
        <pickle class="small" > ppp</pickle>
    </plate>
</div>
@endsection
