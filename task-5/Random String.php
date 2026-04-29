<?php
function RouteRandomPass($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $randomStr = "";
    
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, strlen($chars) - 1);
        $randomStr .= $chars[$randomIndex];
    }
    
    return $randomStr;
}


echo RouteRandomPass(8); 
?>