<?php

$date_string = 'January 21st, 2020';

$format = 'Y-m-d';
/*1-1
echo date('Y/m/d',strtotime($date_string));
*/

//1-2
/*
$dateimmu = new DateTimeImmutable($date_string);



echo $dateimmu->format($format);
*/