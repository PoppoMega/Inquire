<?php
$t = time();
$date = new DateTime();
$dateimmu = new DateTimeImmutable();

$format = 'Y-m-d H:i:s';
echo date($format, $t), '<br>';
echo $date->format($format), '<br>';
echo $dateimmu->format($format), '<br>';

//1時間後
$t += 3600;
echo date($format, $t), '<br>';

$date->add(new DateInterval('PT1H'));
echo $date->format($format), '<br>';

$dateimmu2 = $dateimmu->add(new DateInterval('PT1H'));
echo $dateimmu->format($format), '<br>';
echo $dateimmu2->format($format), '<br>';

//一か月後(
echo "-----------------------";
$date = new DateTime("2020-1-31");
echo $date->format($format);

$date->add(new DateInterval('P1M'));
echo $date->format($format);

