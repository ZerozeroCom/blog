<div>
    <a href="/">商品列表</a>
    <a href="/contactUs">聯絡我們</a>
</div>
<h2>商品</h2>



<?php
//變數與運算式實作練習

$aaa = "john 是個努力錄課程的人";
$bbb = 50;
$ccc = false;
$ddd = 4.6;

var_dump($aaa);
echo("\r\n");
echo '<br>';
var_dump($bbb);
echo '<br>';
var_dump($ccc);
echo '<br>';
var_dump($ddd);
echo '<br>';

$kilogram = 10;
echo "起跳價: 70";
echo '<br>';
echo "公里數: $kilogram";
echo '<br>';
echo "最終收費: ".$kilogram*10+70;
echo '<br>';
//判斷與迴圈練習
$month = 2;

if ($month >11 || $month< 3){
    echo $month." 冬天";
} else if($month >8){
    echo $month." 秋天";
} else if($month >5){
    echo $month." 夏天";
} else {
    echo $month." 春天";
}
echo '<br>';

$sumF =0;
for($i=1; $i<=150; $i+=2)
{
    $sumF += $i;

}
echo $sumF;
echo '<br>';

//資料結構練習
$mystock = array(5,10,20,33,17);
$sum = 0;

foreach ($mystock as $value) {
    $sum += $value;
    }
echo "總共賺了 $sum 平均每張賺".$sum/5;

$sZero = array(
array("zero",1.2),
array("zero2",1),
array("zero3",0.7),
array("zerobun",2),
array("zerogood",)
);
echo '<br>';
foreach ($sZero as $key => $value) {
    if(isset($value[1])){
        echo "$value[0] 得 ".$value[1]*1000;
        echo '<br>';
    } else {
        echo "$value[0] 無績效資料";
        echo '<br>';
    }

}

$Bros = [
"john",
"john2",
"john3",
"johnbun",
"johngood"
];
$report = [
"john"=>1.2,
"john2"=>1,
"john3"=>0.7,
"johnbun"=>2,

];
echo '<br>';
foreach ($Bros as $Bro) {
    if(isset($report[$Bro])){
    echo  $report[$Bro]*1000;
    }else {
        echo " 無績效資料";
    }
    echo '<br>';
}
foreach ($Bros as $Bro => $momey) {
    if(isset($report[$momey])){

        echo $momey." 得 ".$report[$momey]*1000;
        echo '<br>';
    } else {
        echo $momey." 無績效資料";
        echo '<br>';
    }

}
print_r($Bros);
echo '<br>';
print_r($sZero);
echo '<br>';
print_r($report);
echo '<br>';
print_r(array_keys($report));
echo '<br>';
print_r(array_keys($sZero));
echo '<br>';
print_r(array_values($report));
echo '<br>';
print_r(array_values($sZero[0]));
echo '<br>';
print_r(array_column($report,'0'));
echo '<br>';
print_r(array_column($sZero,'1'));
echo '<br>';


//函式&物件練習
class Pokemon{
var $hp =100;
var $attack =30;
    function attack($hunt){
        $this->hp-=$hunt;
    }
    function evolve(){
        $hp*2;
        $attack*2;
    }
    function getHp(){
        return $this->hp;
    }

}
$pokemon =new Pokemon;
$pokemon->attack(40);
echo($pokemon->getHp());






?>

