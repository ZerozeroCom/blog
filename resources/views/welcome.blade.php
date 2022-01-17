<?php
$mystock = array(5,10,20,33,17);
$sum = 0;

foreach ($mystock as $value) {
    $sum += $value;
}
echo "總共賺了 $sum 平均每張賺 ($sum / 5) ";
?>
