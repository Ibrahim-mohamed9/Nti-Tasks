<?php
$tests = array(1, "tariq", 1.5, true, 7, 's', false);

echo "<b>Using For Loop:</b><br>";
for ($i = 0; $i < count($tests); $i++) {
    if (is_bool($tests[$i])) {
        echo ($tests[$i] ? "Yes" : "NO") . "<br>";
    } else {
        echo $tests[$i] . "<br>";
    }
}

echo "<hr>";

echo "<b>Using While Loop:</b><br>";
$j = 0;
while ($j < count($tests)) {
    if (is_bool($tests[$j])) {
        echo ($tests[$j] ? "Yes" : "NO") . "<br>";
    } else {
        echo $tests[$j] . "<br>";
    }
    $j++;
}
?>