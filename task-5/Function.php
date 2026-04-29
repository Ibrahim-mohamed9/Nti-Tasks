<?php
function calcNumbers($num1, $num2) {
    $multiply = $num1 * $num2;
    $diff = $num1 - $num2;
    $divide = $num1 / $num2;
    
    echo "Multiplication Result: " . $multiply . "<br>";
    echo "Difference: " . $diff . "<br>";
    echo "Division Result: " . $divide . "<br>";
}


calcNumbers(10, 2);
?>