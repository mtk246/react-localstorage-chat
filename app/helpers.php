<?php

function randomNumber($length): string
{
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

function in_array_any($needles, $haystack)
{
   return !empty(array_intersect($needles, $haystack));
}

function middleRedactor($string, $char)
{
    $substring = substr($string, 1, strlen($string));
    $total = strlen($substring);
    $tenth = ceil($total / 10);

    // Make sure single character strings get redacted
    $length = ($total > $tenth) ? ($total - $tenth) : 1;

    return substr($string, 0, 1) . str_pad(substr($substring, $length), $total, $char, STR_PAD_LEFT);
}