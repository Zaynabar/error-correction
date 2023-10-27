<?php

function encode($text){
    $binary = '';
    $tripled = '';

    for ($i = 0; $i < strlen($text); $i++) {
        $ascii = ord($text[$i]);
        $binary .= str_pad(decbin($ascii), 8, '0', STR_PAD_LEFT);
    }

    for ($i = 0; $i < strlen($binary); $i++) {
        $tripled .= str_repeat($binary[$i], 3);
    }

    return $tripled;
}

function decode($binary){
    $decoded = '';

    for ($i = 0; $i < strlen($binary); $i += 24) {
        $triples = substr($binary, $i, 24);
        $bits = '';

        for ($j = 0; $j < strlen($triples); $j += 3) {
            $bit = intval(substr_count(substr($triples, $j, 3), '1') > 1);
            $bits .= strval($bit);
        }

        $byte = bindec($bits);
        $decoded .= chr($byte);
    }

    return $decoded;
}
