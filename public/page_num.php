<?php
function p($count)
{
    $page = $count / 20;
    echo "{$count} -> {$page} <br>\n";
}