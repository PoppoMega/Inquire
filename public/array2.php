<?php

$awk = [1,2,3];

$awk2 = [11,22,33];

$awk3 = array_merge($awk,$awk2);
$awk4 = $awk +  $awk2;

var_dump($awk3);
var_dump($awk4);