<?php

if (!function_exists('multiply')) {
    function multiply($a, $b)
    {
        return $a * $b;
    }
}


if (!function_exists('difference')) {
    function difference($a, $b)
    {
        return $a - $b ?? 0;
    }
}
