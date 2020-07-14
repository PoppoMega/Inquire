<?php

echo date('Y-m-d H:i:s'), '<br>';
//sleep(1);
echo date('Y-m-d H:i:s'), '<br>';
echo '--------------<br>';

//
$t = time();

echo date('Y-m-d H:i:s'), '<br>';
//sleep(1);
echo date('Y-m-d H:i:s'), '<br>';

//
$date = new DateTime();
echo $date->format('Y-m-d H:i:s') , '<br>';

//
$datei = new DateTimeImmutable();
echo $datei->format('Y-m-d H:i:s') , '<br>';