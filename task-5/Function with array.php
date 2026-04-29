<?php
function sumArray($arr) {
    $sum = 0;
    foreach ($arr as $number) {
        $sum += $number; 
    }
    return $sum;
}

$myNumbers = array(10, 20, 30);
echo "Total Sum: " . sumArray($myNumbers);
?>