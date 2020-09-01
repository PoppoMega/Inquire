<?php

$awk = [
    'a' => 1,
    'b' => 2,
    'c' => 3,
    'g' => 4,
];
$awk2 = [
    'g' => 44,
    'x' => 11,
    'y' => 22,
    'z' => 33,
];

//
$awk3 = array_merge($awk, $awk2);
$awk4 = $awk + $awk2;

//
var_dump($awk3);
var_dump($awk4);
