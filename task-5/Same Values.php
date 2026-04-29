<?php
$arr1 = array('a', 'b', 'c', 'd');
$arr2 = array('c', 'd', 'e', 'f');
$matches = array();

foreach ($arr1 as $val1) {
    foreach ($arr2 as $val2) {
        if ($val1 == $val2) {
            $matches[] = $val1;
        }
    }
}

echo "output: " . implode(" - ", $matches);
?>